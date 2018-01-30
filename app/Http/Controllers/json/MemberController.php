<?php

namespace App\Http\Controllers;

use App\Model\Entity\File;
use App\Model\Exception\SecurityException;
use App\Model\Service\IMemberService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MemberController extends AbstractController
{
	/**
	 * @var IMemberService
	 */
	protected $memberService;

	/**
	 * MemberController constructor.
	 * @param IMemberService $memberService
	 */
	public function __construct(IMemberService $memberService) {
		parent::__construct($memberService);
		$this->memberService = $memberService;
	}

	/**
	 * @param Request $req
	 * @return Response
	 */
	public function login(Request $req) {
		$login = $req->get('login');
		$password = $req->get('password');
		$facebook = $req->get('facebook');

		if (!isset($login))
			return Response::create(['error' => 'Missing login'], Response::HTTP_BAD_REQUEST);
		if (!isset($password) && (!isset($facebook) || $facebook == 'true'))
			return Response::create(['error' => 'Missing password'], Response::HTTP_BAD_REQUEST);

		try {
			if (isset($facebook) && $facebook == 'true')
				$member = $this->memberService->loginByFacebook($login);
			else
				$member = $this->memberService->login($login, $password);
			return Response::create([
				'token' => $member->getToken(),
				'currencyCode' => $member->getCurrency()->getValue(),
				'languageCode' => $member->getLanguage()->getCode(),
				'firstName' => $member->getFirstName(),
				'lastName' => $member->getLastName(),
				'login' => $member->getLogin(),
				'lastLogin' => $member->getAccess()->format('Y-m-d H:i:s'),
			], Response::HTTP_OK);
		} catch (SecurityException $ex) {
			return Response::create(['error' => $ex->getMessage()], Response::HTTP_UNAUTHORIZED);
		}
	}

	/**
	 * @param Request $req
	 * @return Response
	 */
	public function logout(Request $req) {
		$this->assumeLogged($req);

		try {
			$member = $this->loggedUser($req);
			$this->memberService->logout($member);
		} catch (\Exception $ex) {
			return Response::create(['error' => $ex->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
		}
		return Response::create([], Response::HTTP_OK);
	}
}
