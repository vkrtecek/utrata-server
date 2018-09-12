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
}
