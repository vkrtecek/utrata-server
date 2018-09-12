<?php

namespace App\Http\Controllers;

use App\Model\Service\ICheckStateService;
use App\Model\Service\IMemberService;
use App\Model\Service\ITranslationService;

class CheckStateController extends AbstractController
{
	/** @var ICheckStateService */
	private $checkStateService;

    /**
     * CheckStateController constructor.
     * @param IMemberService $memberService
     * @param ITranslationService $translationService
     * @param ICheckStateService $checkStateService
     */
	public function __construct(IMemberService $memberService, ITranslationService $translationService, ICheckStateService $checkStateService) {
		parent::__construct($memberService, $translationService);
		$this->checkStateService= $checkStateService;
	}
}
