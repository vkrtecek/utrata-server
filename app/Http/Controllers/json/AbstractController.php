<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 28. 1. 2018
 * Time: 1:10
 */

namespace App\Http\Controllers;

use App\Model\Entity\Member;
use App\Model\Exception\AuthenticationException;
use App\Model\Exception\NotFoundException;
use App\Model\Service\IMemberService;
use App\Model\Service\ITranslationService;
use Illuminate\Http\Request;

abstract class AbstractController extends Controller
{
	/** @var IMemberService */
	protected $memberService;
	/** @var ITranslationService */
	protected $trans;
	/** @var Member */
	protected $member;

    /**
     * AbstractController constructor.
     * @param IMemberService $memberService
     * @param ITranslationService $translationService
     */
	public function __construct(IMemberService $memberService, ITranslationService $translationService) {
		$this->memberService = $memberService;
		$this->trans = $translationService;
	}

	/**
	 * @param Request $req
	 * @throws AuthenticationException
	 */
	protected function assumeLogged(Request $req) {
        $this->member = $this->loggedUser($req);
		if ($this->member->getExpiration() < new \DateTime())
			throw new AuthenticationException("The token expirated");
	}

	/**
	 * @param Request $req
	 * @throws AuthenticationException
	 */
	protected function assumeAdmin(Request $req) {
		$this->assumeLogged($req);
		if (!$this->member->isAdmin())
			throw new AuthenticationException('Not admin');
	}

	/**
	 * @param Request $req
	 * @return Member
	 * @throws AuthenticationException
	 */
	private function loggedUser(Request $req) {
		$token = $this->getToken($req);
		try {
            return $this->memberService->getByToken($token);
        } catch (NotFoundException $ex) {
            throw (new AuthenticationException($ex->getMessage(), $ex->getDefault()))->setBind($ex->getBinds());
        }
	}

	/**
	 * @param Request $req
	 * @return string
	 * @throws AuthenticationException
	 */
	private function getToken(Request $req) {
		$token = $req->header('Authorization');

		/* testing section */
		if (!$token || $token == "")
			$token = $req->get('token');
		/* end of testing section */

		if (!$token || $token == "")
			throw new AuthenticationException('no-code', 'Token not found');

		return $token;
	}
}
