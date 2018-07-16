<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 6. 7. 2018
 * Time: 20:44
 */

namespace App\Http\Controllers;


use App\Model\Service\IMemberPurposeService;
use App\Model\Service\IMemberService;
use App\Model\Service\IPurposeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
	 * Creates MemberPurpose
	 * @param Request $request
	 */
	public function create(Request $request) {
		$member = $this->memberService->getMember($request->get('user'));
		$purpose = $this->purposeService->getPurpose($request->get('purpose'));
		$this->memberPurposeService->create($member, $purpose);
	}

	/**
	 * Deletes MemberPurpose
	 * @param Request $request
	 */
	public function delete(Request $request) {
		$member = $this->memberService->getMember($request->get('user'));
		$purpose = $this->purposeService->getPurpose($request->get('purpose'));
		$this->memberPurposeService->delete($member, $purpose);
	}
}