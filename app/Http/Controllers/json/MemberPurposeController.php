<?php

namespace App\Http\Controllers;

use App\Model\Exception\NotFoundException;
use App\Model\Service\IMemberPurposeService;
use App\Model\Service\IMemberService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MemberPurposeController extends AbstractController {
	
	/** @var IMemberPurposeService */
	private $memberPurposeService;

	/**
	 * MemberPurposeController constructor.
	 * @param IMemberService $memberService
	 * @param IMemberPurposeService $memberPurposeService
	 */
	public function __construct(IMemberService $memberService, IMemberPurposeService $memberPurposeService) {
		parent::__construct($memberService);
		$this->memberPurposeService = $memberPurposeService;
	}

	/**
	 * @param Request $req
	 * @return Response
	 */
	public function changePurposes(Request $req) {
		$this->assumeLogged($req);
		$member = $this->loggedUser($req);
		$purposes = $req->get('notes');
		try {
			$this->memberPurposeService->setMemberPurposes($member, $purposes);
		} catch (NotFoundException $e) {
			return Response::create(['error' => $e->getMessage()], Response::HTTP_NOT_FOUND);
		}

		return Response::create([], Response::HTTP_OK);
	}
}