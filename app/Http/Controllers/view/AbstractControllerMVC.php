<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 1. 7. 2018
 * Time: 0:28
 */

namespace App\Http\Controllers;


use App\Model\Entity\Member;
use App\Model\Exception\AuthenticationMVCException;
use App\Model\Service\IMemberService;
use Illuminate\Support\Facades\Auth;

abstract class AbstractControllerMVC extends Controller
{
	/** @var IMemberService */
	protected $memberService;
	/** @var Member */
	protected $member;

	/**
	 * AbstractControllerMVC constructor.
	 * @param IMemberService $memberService
	 */
	public function __construct(IMemberService $memberService) {
		$this->memberService = $memberService;
	}

	/**
	 * @throws AuthenticationMVCException
	 */
	protected function assumeLogged() {
		if (!Auth::user())
			throw new AuthenticationMVCException('Not logged in');
		$this->member = Auth::user();
	}

	/**
	 * @return Member|NULL
	 */
	protected function loggedMember() {
		$this->member = Auth::user();
		return $this->member;
	}
}