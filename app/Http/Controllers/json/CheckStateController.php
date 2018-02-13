<?php

namespace App\Http\Controllers;

use App\Model\Service\ICheckStateService;
use App\Model\Service\IMemberService;

class CheckStateController extends AbstractController
{
	/** @var ICheckStateService */
	private $checkStateService;

	/**
	 * CheckStateController constructor.
	 * @param IMemberService $memberService
	 * @param ICheckStateService $checkStateService
	 */
	public function __construct(IMemberService $memberService, ICheckStateService $checkStateService) {
		parent::__construct($memberService);
		$this->checkStateService= $checkStateService;
	}
}
