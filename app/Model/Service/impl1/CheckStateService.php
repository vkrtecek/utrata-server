<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 27. 1. 2018
 * Time: 17:49
 */

namespace App\Model\Service;


use App\Model\Dao\ICheckStateDAO;
use App\Model\Entity\CheckState;
use App\Model\Exception\BadParameterException;
use App\Model\Exception\IntegrityException;
use App\Model\Exception\NotFoundException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class CheckStateService implements ICheckStateService
{
	/** @var ICheckStateDAO */
	protected $checkSateDao;

	/** @var IMemberService */
	protected $memberService;

	/**
	 * CheckStateService constructor.
	 * @param ICheckStateDAO $checkStateDAO
	 * @param IMemberService $memberService
	 */
	public function __construct(ICheckStateDAO  $checkStateDAO, IMemberService $memberService) {
		$this->checkSateDao = $checkStateDAO;
		$this->memberService = $memberService;
	}

	/**
	 * @return CheckState[]
	 * @throws NotFoundException
	 */
	public function getCheckStates() {}

	/**
	 * @param int $id
	 * @return CheckState
	 * @throws NotFoundException
	 * @throws BadParameterException
	 */
	public function getCheckState($id) {
		if (!ctype_digit($id) || $id < 1)
			throw new BadParameterException('Not INTEGER or smaller that 1');
		$checkState = $this->checkSateDao->findOne($id);
		if (!$checkState)
			throw new NotFoundException('No CheckState found');
		return $checkState;
	}

	/**
	 * @param $data
	 * @return CheckState
	 * @throws BadRequestHttpException
	 */
	public function createCheckState($data) {}

	/**
	 * @param int $id
	 * @param $data
	 * @return CheckState
	 * @throws NotFoundException
	 * @throws BadParameterException
	 * @throws BadRequestHttpException
	 */
	public function updateCheckState($id, $data) {}

	/**
	 * @param int $id
	 * @return int
	 * @throws NotFoundException
	 * @throws BadParameterException
	 * @throws IntegrityException
	 */
	public function deleteCheckState($id) {}

	/**
	 * @param CheckState $checkState
	 * @return array
	 */
	public function format(CheckState $checkState) {}

	/**
	 * @param CheckState[] $checkStates
	 * @return array
	 */
	public function formatEntites($checkStates) {}
}