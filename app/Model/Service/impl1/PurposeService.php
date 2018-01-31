<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 28. 1. 2018
 * Time: 21:16
 */

namespace App\Model\Service;


use App\Model\Dao\IPurposeDAO;
use App\Model\Entity\Purpose;
use App\Model\Exception\BadParameterException;
use App\Model\Exception\IntegrityException;
use App\Model\Exception\NotFoundException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class PurposeService implements IPurposeService
{

	/** @var IPurposeDAO */
	protected $purposeDao;

	/** @var IMemberService */
	protected $memberService;

	/** @var ILanguageService */
	protected $languageService;


	/**
	 * PurposeService constructor.
	 * @param IPurposeDAO $purposeDAO
	 * @param IMemberService $memberService
	 * @param ILanguageService $languageService
	 */
	public function __construct(IPurposeDAO $purposeDAO, IMemberService $memberService, ILanguageService $languageService) {
		$this->purposeDao = $purposeDAO;
		$this->memberService = $memberService;
		$this->languageService = $languageService;
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
		$purposes = $this->purposeDao->findByColumn('language', $language);
		if ($purposes == NULL)
			throw new NotFoundException('PurposeService: No purpose found.');
		return $purposes;
	}

	/**
	 * @param string $login
	 * @return Purpose[]
	 * @throws NotFoundException
	 */
	public function getUserPurposes($login) {
		$member = $this->memberService->getMember($login);
		$purposes = [];
		foreach ($member->getMemberPurposes() as $memberPurpose)
			$purposes[] = $memberPurpose->getPurpose();
		return $purposes;
	}

	/**
	 * @param int $id
	 * @return Purpose
	 * @throws BadParameterException
	 * @throws NotFoundException
	 */
	public function getPurpose($id) {
		if ((string)((int)$id) != $id || (int)$id < 1)
			throw new BadParameterException('Not integer or smaller than 1');
		$purpose = $this->purposeDao->findOne($id);
		if (!$purpose)
			throw new NotFoundException('No Purpose found.');
		return $purpose;
	}

	/**
	 * @param $data
	 * @return Purpose
	 * @throws BadRequestHttpException
	 */
	public function createPurpose($data) {}

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
	public static function format(Purpose $purpose) {
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
	public static function formatEntites($purposes) {
		$ret = [];
		foreach($purposes as $purpose)
			$ret[] = self::format($purpose);
		return $ret;
	}
}