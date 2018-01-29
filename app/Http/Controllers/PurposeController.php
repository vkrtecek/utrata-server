<?php

namespace App\Http\Controllers;

use App\Model\Exception\NotFoundException;
use App\Model\Service\IMemberService;
use App\Model\Service\IPurposeService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
}
