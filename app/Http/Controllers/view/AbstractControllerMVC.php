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
use App\Model\Service\ITranslationService;
use Illuminate\Support\Facades\Auth;

abstract class AbstractControllerMVC extends Controller
{
	/** @var IMemberService */
	protected $memberService;
	/** @var ITranslationService */
	protected $trans;
	/** @var Member */
	protected $member;

    /**
     * AbstractControllerMVC constructor.
     * @param IMemberService $memberService
     * @param ITranslationService $translationService
     */
	public function __construct(IMemberService $memberService, ITranslationService $translationService) {
		$this->memberService = $memberService;
		$this->member = $this->loggedMember();
		$this->trans = $translationService;
	}

	/**
	 * @throws AuthenticationMVCException
	 */
	protected function assumeLogged() {
		if (!Auth::user())
			throw (new AuthenticationMVCException('Exception.NotLogged', 'Not logged in'));
		$this->member = Auth::user();
	}

	/**
	 * @return Member|NULL
	 */
	protected function loggedMember() {
		return Auth::user();
	}
}
