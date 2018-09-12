<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 28. 1. 2018
 * Time: 21:16
 */

namespace App\Model\Service;


use App\Model\Dao\IPurposeDAO;
use App\Model\Entity\Item;
use App\Model\Entity\Member;
use App\Model\Entity\Purpose;
use App\Model\Exception\AlreadyExistException;
use App\Model\Exception\BadParameterException;
use App\Model\Exception\BadRequestException;
use App\Model\Exception\IntegrityException;
use App\Model\Exception\NotFoundException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class PurposeService implements IPurposeService
{

	/** @var IPurposeDAO */
	protected $purposeDao;

	/** @var ILanguageService */
	protected $languageService;

	/** @var IMemberPurposeService */
	protected $memberPurposeService;


	/**
	 * PurposeService constructor.
	 * @param IPurposeDAO $purposeDAO
	 * @param ILanguageService $languageService
	 * @param IMemberPurposeService $memberPurposeService
	 */
	public function __construct(IPurposeDAO $purposeDAO, ILanguageService $languageService, IMemberPurposeService $memberPurposeService) {
		$this->purposeDao = $purposeDAO;
		$this->languageService = $languageService;
		$this->memberPurposeService = $memberPurposeService;
	}

	/** @inheritdoc */
	public function getPurposes(): array {}


    /** @inheritdoc */
    public function getLanguagePurposes(string $code): array {
		$language = $this->languageService->getLanguage($code);
		$purposes = $this->purposeDao->findByColumn('LanguageCode', $language->getCode());
		if ($purposes == NULL || count($purposes) == 0)
			throw (new NotFoundException('Exception.NotFound', 'No :entity found.'))->setBind(['entity' => 'Purpose']);
		$ret = [];
		foreach ($purposes as $purpose)
			$ret[] = $purpose;
		return $ret;
	}


    /** @inheritdoc */
    public function getLanguageBasePurposes(string $languageCode): array {
		//only for test existence of language
		$this->languageService->getLanguage($languageCode);
		$purposes = $this->purposeDao->findByColumn('LanguageCode', $languageCode);
		$ret = [];
		foreach ($purposes as $purpose)
			if ($purpose->isBase())
				$ret[] = $purpose;
		return $ret;
	}


    /** @inheritdoc */
    public function getUserLanguagePurposes(Member $member, string $languageCode): array {
		$purposes = $this->getLanguagePurposes($languageCode);
		$ret = [];
		foreach ($purposes as $key => $purpose) {
			if (!$purpose->isBase() && ($purpose->getCreator() === NULL || $purpose->getCreator()->getId() != $member->getId()))
				unset($purposes[$key]);
			else
				$ret[] = $purpose;
		}
		return $ret;
	}


    /** @inheritdoc */
    public function getUserPurposes(Member $member): array {
		$memberPurposes = $this->memberPurposeService->getMemberPurposes($member);
		if ($memberPurposes === NULL)
			throw (new NotFoundException('Exception.NotFound', 'No :entity found.'))->setBind(['entity' => 'Purposes']);
		$purposes = [];
		foreach ($memberPurposes as $memberPurpose)
			$purposes[] = $memberPurpose->getPurpose();
		return $purposes;
	}


    /** @inheritdoc */
    public function getPurposesCreatedByUser(Member $member): array {
		return $this->purposeDao->findByColumn('CreatorID', $member->getId());
	}


    /** @inheritdoc */
    public function getPurpose(int $id): Purpose {
		if ($id < 1)
			throw new BadParameterException('Exception.BadParameter.SmallerThan1', 'Identifier smaller than 1');
		$purpose = $this->purposeDao->findOne($id);
		if (!$purpose)
			throw (new NotFoundException('Exception.NotFound', 'No :entity found.'))->setBind(['entity' => 'Purpose']);
		return $purpose;
	}


    /** @inheritdoc */
    public function createPurpose(Member $member, array $data): Purpose {
		if (!isset($data['name']))
			throw (new BadRequestException('Exception.Parameter.Missing', ':parameter missing'))->setBind(['parameter' => 'Name of note']);
		$code = $this->codeFromValue($data['name']);

		$withSameCode = $this->purposeDao->findByColumn('code', $code);
		foreach ($withSameCode as $note) {
			//note with same code exists (basic or user's)
			if ($note->isBase() || ($note->getCreator() && $note->getCreator()->getId() == $member->getId())) {
				throw (new AlreadyExistException('Exception.AlreadyExists', ':entity with this :parameter already exists'))->setReason($code)->setBind(['entity' => 'Note', 'parameter' => 'code']);
			}
		}
		if (isset($data['language']) && $data['language']) {
			$language = $this->languageService->getLanguage($data['language']);
		} else {
			$language = $member->getLanguage();
		}

		$purpose = new Purpose();
		$purpose->setBase(FALSE);
		$purpose->setCreator($member);
		$purpose->setLanguage($language);
		$purpose->setValue($data['name']);
		$purpose->setCode($code);
		$purpose = $this->purposeDao->create($purpose);

		$this->memberPurposeService->create($member, $purpose);
		return $purpose;
	}


    /** @inheritdoc */
    public function updatePurpose(int $id, array $data): Purpose {}


    /** @inheritdoc */
    public function deletePurpose(int $id, Member $member) {
		if (!ctype_digit(trim($id)) || (int)$id < 1)
			throw new BadParameterException('Exception.BadParameter.SmallerThan1', 'Identifier smaller than 1');
		$purpose = $this->purposeDao->findOne($id);
		if (!$purpose)
			throw (new NotFoundException('Exception.NotFound', 'No :entity found.'))->setBind(['entity' => 'Note']);
		if ($purpose->isBase())
			throw (new IntegrityException('Exception.CannotRemove', 'Cannot remove this :entity'))->setBind(['entity' => 'note']);

		$mp = $this->memberPurposeService->getMemberPurpose($member, $purpose);
		if ($mp !== NULL) {
			$this->memberPurposeService->delete($member, $purpose);
		}
		$this->purposeDao->delete($purpose);
		return $id;
	}


    /** @inheritdoc */
    public function format(Purpose $purpose, Member $member): array {
		return [
			'id' => $purpose->getId(),
			'code' => $purpose->getCode(),
			'value' => $purpose->getValue(),
			'deletable' => !$purpose->isBase() && count($this->itemsForPurpose($purpose)) == 0 && $purpose->getCreator() && $purpose->getCreator()->getId() == $member->getId(),
			'unselectable' => count($this->itemsForPurpose($purpose)) == 0,
		];
	}


    /** @inheritdoc */
    public function formatEntities(array $purposes, Member $member): array {
		if (!$purposes)
			return [];
		$ret = [];
		foreach($purposes as $purpose)
			$ret[] = self::format($purpose, $member);
		return $ret;
	}

	/**
	 * @param Purpose $purpose
	 * @return Item[]
	 */
	private function itemsForPurpose(Purpose $purpose): array {
		return  $this->purposeDao->findItems($purpose);
	}


	/**
	 * @param string $val
	 * @return string
	 */
	private function codeFromValue(string $val): string {
		$table = array(
			'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
			'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O',
			'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss',
			'Š'=>'S', 'Ž'=>'Z', 'C'=>'C', 'Ě'=>'E', 'Č'=>'C', 'Ř'=>'R', 'Ů'=>'U', 'Ň'=>'N', 'Ď'=>'D', 'Ť'=>'T',
			'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e',
			'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o',
			'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'þ'=>'b', 'ů'=>'u',
			'ÿ'=>'y', 'R'=>'R', 'r'=>'r', "'"=>'-', '"'=>'-', ' '=>'-', 'š'=>'s', 'ž'=>'z', 'č'=>'c', 'ě'=>'e',
			'ř'=>'r', 'ň'=>'n', 'ď'=>'d', 'ť'=>'t'
		);
		return strtolower(strtr($val, $table));
	}
}
