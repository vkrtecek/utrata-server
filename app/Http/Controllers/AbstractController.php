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
use Illuminate\Http\Request;

abstract class AbstractController extends Controller
{
	/**
	 * @var IMemberService
	 */
	protected $memberService;

	/**
	 * AbstractController constructor.
	 * @param IMemberService $memberService
	 */
	public function __construct(IMemberService $memberService) {
		$this->memberService = $memberService;
	}

	/**
	 * @param Request $req
	 * @throws AuthenticationException
	 */
	protected function assumeLogged(Request $req) {
		try {
			$member = $this->loggedUser($req);
		} catch (NotFoundException $ex) {
			throw new AuthenticationException("Bad token: " . $ex->getMessage());
		}

		if ($member->getExpiration() < new \DateTime())
			throw new AuthenticationException("The token expirated");
	}

	/**
	 * @return Member
	 * @throws NotFoundException
	 */
	protected function loggedUser(Request $req) {
		$token = $this->getToken($req);
		return $this->memberService->getByToken($token);
	}

	/**
	 * @param Request $req
	 * @return string
	 * @throws NotFoundException
	 */
	private function getToken(Request $req) {
		/*
		$exploded = explode('; ', $req->header('cookie'));
		$headers = [];
		foreach ($exploded as $header) {
			list($key, $value) = explode('=', $header);
			$headers[$key] = $value;
		}
		$token = $headers['token'];
		*/
		$token = $req->get('token');
		if (!$token || $token == "")
			$token = json_decode($req->getContent(), true)['token'];
		if (!$token || $token == "")
			throw new NotFoundException('Token not found');

		return $token;
	}
}