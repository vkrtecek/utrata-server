<?php

namespace App\Http\Controllers;

use App\Model\Exception\AlreadyExistException;
use App\Model\Exception\NotFoundException;
use App\Model\Service\IMemberService;
use App\Model\Service\IPurposeService;
use App\Model\Service\PurposeService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class PurposeController extends AbstractController
{

	/**
	 * @var IPurposeService
	 */
	protected $purposeService;


	/**
	 * PurposeController constructor.
	 * @param IMemberService $memberService
	 * @param IPurposeService $purposeService
	 */
	public function __construct(IMemberService $memberService, IPurposeService $purposeService) {
		parent::__construct($memberService);
		$this->purposeService = $purposeService;
	}


	/**
	 * @param Request $req
	 * @return Response
	 */
	protected function getUserPurposes(Request $req) {
		$this->assumeLogged($req);

		$login = $req->get('login');
		try {
			$purposes = $this->purposeService->getUserPurposes($login);
			$purposes = $this->purposeService->formatEntites($purposes);
		} catch (NotFoundException $ex) {
			return Response::create(['error' => $ex->getMessage()], Response::HTTP_NOT_FOUND);
		}

		return Response::create(["purposes" => $purposes], Response::HTTP_OK);
	}


	/**
	 * @param string $languageCode
	 * @return Response
	 */
	public function getLanguagePurposes($languageCode) {
		try {
			$purposes = $this->purposeService->getLanguagePurposes($languageCode);
			$formatted = PurposeService::formatEntites($purposes);
		} catch (NotFoundException $e) {
			return Response::create(['error' => $e->getMessage()], Response::HTTP_NOT_FOUND);
		}
		return Response::create(['purposes' => $formatted], Response::HTTP_OK);
	}


	/**
	 * @param Request $req
	 * @return Response
	 */
	public function create(Request$req) {
		$this->assumeLogged($req);
		$note = $req->get('note');
		if (!$note)
			return Response::create(['error' => 'Note missing'], Response::HTTP_BAD_REQUEST);

		$member = $this->loggedUser($req);
		try {
			$purpose = $this->purposeService->createPurpose($member, $note);
			$formatted = PurposeService::format($purpose);
		} catch (BadRequestHttpException $e) {
			return Response::create(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
		} catch (AlreadyExistException $e) {
			return Response::create(['error' => $e->getMessage()], Response::HTTP_CONFLICT);
		}
		return Response::create($formatted, Response::HTTP_CREATED);
	}
}
