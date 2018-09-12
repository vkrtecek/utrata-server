<?php

namespace App\Http\Controllers;

use App\Model\Service\IMemberPurposeService;
use App\Model\Service\IMemberService;
use App\Model\Service\ITranslationService;

class MemberPurposeController extends AbstractController {
	
	/** @var IMemberPurposeService */
	private $memberPurposeService;

    /**
     * MemberPurposeController constructor.
     * @param IMemberService $memberService
     * @param ITranslationService $translationService
     * @param IMemberPurposeService $memberPurposeService
     */
	public function __construct(IMemberService $memberService, ITranslationService $translationService, IMemberPurposeService $memberPurposeService) {
		parent::__construct($memberService, $translationService);
		$this->memberPurposeService = $memberPurposeService;
	}
}
