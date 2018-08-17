<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 6. 7. 2018
 * Time: 20:44
 */

namespace App\Http\Controllers;


use App\Model\Exception\AlreadyExistException;
use App\Model\Exception\AuthenticationException;
use App\Model\Service\IMemberPurposeService;
use App\Model\Service\IMemberService;
use App\Model\Service\IPurposeService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class MemberPurposeControllerMVC extends AbstractControllerMVC
{
	/** @var IMemberPurposeService */
	protected $memberPurposeService;

	/** @var IPurposeService */
	protected $purposeService;

	/**
	 * MemberPurposeControllerMVC constructor.
	 * @param IMemberService $memberService
	 * @param IMemberPurposeService $memberPurposeService
	 * @param IPurposeService $purposeService
	 */
	public function __construct(IMemberService $memberService, IMemberPurposeService $memberPurposeService, IPurposeService $purposeService) {
		parent::__construct($memberService);
		$this->memberPurposeService = $memberPurposeService;
		$this->purposeService = $purposeService;
	}

	/**
	 * @param Request $request
	 * @return Response
	 * @throws \App\Model\Exception\BadParameterException
	 * @throws \App\Model\Exception\NotFoundException
	 * @throws AuthenticationException
	 */
	public function create(Request $request) {
		$this->assumeLogged();
		$purpose = $this->purposeService->getPurpose($request->get('purpose'));
		try {
			$ret = $this->memberPurposeService->create($this->member, $purpose);
		} catch (AlreadyExistException $e) {
			return Response::create(['error' => $e->getMessage(), Response::HTTP_CONFLICT]);
		}
		return Response::create([
			'success' => true,
			'created' => $ret,
		], Response::HTTP_OK);
	}

	/**
	 * @param Request $request
	 * @return Response
	 * @throws \App\Model\Exception\BadParameterException
	 * @throws \App\Model\Exception\NotFoundException
	 * @throws AuthenticationException
	 */
	public function delete(Request $request) {
		$this->assumeLogged();
		try {
			$purpose = $this->purposeService->getPurpose($request->get('purpose'));
			$this->memberPurposeService->delete($this->member, $purpose);
		} catch (BadRequestHttpException $e) {
			return Response::create(['error' => $e->getMessage()]);
		}
		return Response::create(['success' => true]);
	}
}