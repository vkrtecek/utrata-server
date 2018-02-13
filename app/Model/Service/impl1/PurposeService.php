<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 28. 1. 2018
 * Time: 21:16
 */

namespace App\Model\Service;


use App\Model\Dao\IPurposeDAO;
use App\Model\Entity\Member;
use App\Model\Entity\Purpose;
use App\Model\Exception\AlreadyExistException;
use App\Model\Exception\BadParameterException;
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

	/**
	 * @return Purpose[]
	 * @throws NotFoundException
	 */
	public function getPurposes() {}

	/**
	 * @param string $code language code
	 * @return Purpose[]
	 * @throws NotFoundException
	 */
	public function getLanguagePurposes($code) {
		$language = $this->languageService->getLanguage($code);
		$purposes = $this->purposeDao->findByColumn('LanguageCode', $language->getCode());
		if ($purposes == NULL || count($purposes) == 0)
			throw new NotFoundException('PurposeService: No purpose found.');
		return $purposes;
	}

	/**
	 * @param string $languageCode
	 * @return Purpose[]
	 * @throws NotFoundException
	 * @throws BadParameterException
	 */
	public function getLanguageBasePurposes($languageCode) {
		//only for test existence of language
		$this->languageService->getLanguage($languageCode);
		$purposes = $this->purposeDao->findByColumn('LanguageCode', $languageCode);
		$ret = [];
		foreach ($purposes as $purpose)
			if ($purpose->isBase())
				$ret[] = $purpose;
		return $ret;
	}

	/**
	 * @param Member $member
	 * @return Purpose[]
	 * @throws NotFoundException
	 */
	public function getUserPurposes(Member $member) {
		return $member->getPurposes();
	}

	/**
	 * @param int $id
	 * @return Purpose
	 * @throws BadParameterException
	 * @throws NotFoundException
	 */
	public function getPurpose($id) {
		if (!ctype_digit(trim($id)) || (int)$id < 1)
			throw new BadParameterException('PurposeService: Not integer or smaller than 1');
		$purpose = $this->purposeDao->findOne($id);
		if (!$purpose)
			throw new NotFoundException('PurposeService: No Purpose found.');
		return $purpose;
	}

	/**
	 * @param Member $member
	 * @param $data
	 * @return Purpose
	 * @throws BadRequestHttpException
	 * @throws AlreadyExistException
	 */
	public function createPurpose(Member $member, $data) {
		if (!isset($data['name']))
			throw new BadRequestHttpException('Name of note missing');
		$code = $this->codeFromValue($data['name']);

		$withSameCode = $this->purposeDao->findByColumn('code', $code);
		foreach ($withSameCode as $note) {
			if ($note->isBase() || ($note->getCreator() && $note->getCreator()->getId() == $member->getId())) {
				throw new AlreadyExistException('Note with this code already exists');
			}
		}

		$purpose = new Purpose();
		$purpose->setBase(FALSE);
		$purpose->setCreator($member);
		$purpose->setLanguage($member->getLanguage());
		$purpose->setValue($data['name']);
		$purpose->setCode($code);
		$purpose = $this->purposeDao->create($purpose);

		$this->memberPurposeService->create($member, $purpose);
		return $purpose;
	}

	/**
	 * @param int $id
	 * @param $data
	 * @return Purpose
	 * @throws NotFoundException
	 * @throws BadRequestHttpException
	 * @throws BadParameterException
	 */
	public function updatePurpose($id, $data) {}

	/**
	 * @param int $id
	 * @return int
	 * @throws NotFoundException
	 * @throws BadParameterException
	 * @throws IntegrityException
	 */
	public function deletePurpose($id) {}

	/**
	 * @param Purpose $purpose
	 * @return array
	 */
	public function format(Purpose $purpose) {
		$ret = [];

		$ret['id'] = $purpose->getId();
		$ret['code'] = $purpose->getCode();
		$ret['value'] = $purpose->getValue();

		return $ret;
	}

	/**
	 * @param Purpose[] $purposes
	 * @return array
	 */
	public function formatEntities($purposes) {
		$ret = [];
		foreach($purposes as $purpose)
			$ret[] = self::format($purpose);
		return $ret;
	}


	/**
	 * @param string $val
	 * @return string
	 */
	private function codeFromValue($val) {
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