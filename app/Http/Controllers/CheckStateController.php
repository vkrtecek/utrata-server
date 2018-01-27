<?php

namespace App\Http\Controllers;

use App\Model\Exception\BadParameterException;
use App\Model\Exception\IntegrityException;
use App\Model\Exception\NotFoundException;
use App\Model\Service\ICheckStateService;
use App\Model\Service\IMemberService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class CheckStateController extends Controller
{
	/**
	 * @var ICheckStateService
	 */
	protected $checkStateService;

	/**
	 * CheckStateResource constructor.
	 * @param ICheckStateService $checkStateService
	 * @param IMemberService $memberService
	 */
	public function __construct(ICheckStateService $checkStateService, IMemberService $memberService) {
		//parent::__construct($memberService);
		$this->checkStateService = $checkStateService;
	}

	/**
	 * @return Response
	 */
	public function getCheckStates() {
		try {
			$checkStates = $this->checkStateService->getCheckStates();
			$checkStates = $this->checkStateService->formatEntites($checkStates);
		} catch (NotFoundException $ex) {
			return Response::create(['error' => $ex->getMessage()], Response::HTTP_NOT_FOUND);
		}

		return Response::create($checkStates, Response::HTTP_OK);
	}

	/**
	 * @return Response
	 */
	public function getCheckState(Request $request) {
		$id = $request->get('checkStateId');
		if ($id == NULL)
			return Response::create(['error' => 'checkStateId not specified'], Response::HTTP_BAD_REQUEST);
		try {
			$checkState = $this->checkStateService->getCheckState($id);
			$checkState = $this->checkStateService->format($checkState);
		} catch (NotFoundException $ex) {
			return Response::create(['error' => $ex->getMessage()], Response::HTTP_NOT_FOUND);
		} catch (BadParameterException $ex) {
			return Response::create(['error' => $ex->getMessage()], Response::HTTP_BAD_REQUEST);
		}

		return Response::create(['checkState' => $checkState], Response::HTTP_OK);
	}

	/**
	 * @return Response
	 */
	public function createCheckState(Request $request) {
		$data = json_decode($request->getContent(), true);
		try {
			$checkState = $this->checkStateService->createCheckState($data);
			$checkState = $this->checkStateService->format($checkState);
		} catch (BadRequestHttpException $ex) {
			return Response::create(['error' => $ex->getMessage()], Response::HTTP_BAD_REQUEST);
		}

		return Response::create(['checkState' => $checkState], Response::HTTP_CREATED);
	}

	/**
	 * @return Response
	 */
	public function updateCheckState(Request $request) {
		$data = json_decode($request->getContent(), true);
		if ( !isset($data['id']) )
			return Response::create(['error' => 'Identifier "id" not specified.'], Response::HTTP_BAD_REQUEST);
		$id = $data['id'];

		try {
			$checkState = $this->checkStateService->updateCheckState($id, $data);
			$checkState = $this->checkStateService->format($checkState);
		} catch (BadParameterException $ex) {
			return Response::create(['error' => $ex->getMessage()], Response::HTTP_BAD_REQUEST);
		} catch (NotFoundException $ex) {
			return Response::create(['error' => $ex->getMessage()], Response::HTTP_NOT_FOUND);
		} catch (BadRequestHttpException $ex) {
			return Response::create(['error' => $ex->getMessage()], Response::HTTP_BAD_REQUEST);
		}

		return Response::create(['checkState' => $checkState], Response::HTTP_OK);
	}

	/**
	 * @return Response
	 */
	public function deleteCheckState(Request $request) {
		$data = json_decode($request->getContent(), true);
		if (!isset($data['id']))
			return Response::create(['error' => 'Identifier "id" not specified.'], Response::HTTP_BAD_REQUEST);
		$id = $data['id'];

		try {
			$resId = $this->checkStateService->deleteCheckState($id);
		} catch (BadParameterException $ex) {
			return Response::create(['error' => $ex->getMessage()], Response::HTTP_BAD_REQUEST);
		} catch (NotFoundException $ex) {
			return Response::create(['error' => $ex->getMessage()], Response::HTTP_NOT_FOUND);
		} catch (IntegrityException $ex) {
			return Response::create(['error' => $ex->getMessage()], Response::HTTP_FORBIDDEN);
		}

		return Response::create(['succes' => $resId], Response::HTTP_OK);
	}
}
