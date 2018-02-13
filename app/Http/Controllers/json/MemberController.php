<?php

namespace App\Http\Controllers;

use App\Model\Exception\AlreadyExistException;
use App\Model\Exception\AuthenticationException;
use App\Model\Exception\BadParameterException;
use App\Model\Exception\NotFoundException;
use App\Model\Exception\SecurityException;
use App\Model\Service\IMemberService;
use App\Model\Service\MemberService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

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
	public function get(Request $req) {
		$this->assumeLogged($req);
		$member = $this->loggedUser($req);
		$formatted = $this->memberService->format($member);
		return Response::create($formatted, Response::HTTP_OK);
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


	/**
	 * @param Request $req
	 * @return Response
	 */
	public function interactWithFacebook(Request $req) {
		$data = $req->get('data');

		if (!isset($data['login']) || !$data['login'])
			return Response::create(['error' => 'login id missing'], Response::HTTP_BAD_REQUEST);
		try {
			$member = $this->memberService->interactWithFacebook($data);
			return Response::create([
				'token' => $member->getToken(),
				'currencyCode' => $member->getCurrency()->getValue(),
				'languageCode' => $member->getLanguage()->getCode(),
				'firstName' => $member->getFirstName(),
				'lastName' => $member->getLastName(),
				'login' => $member->getLogin(),
				'lastLogin' => $member->getAccess()->format('Y-m-d H:i:s'),
			], Response::HTTP_OK);
		} catch (BadParameterException $e) {
			return Response::create(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
		} catch (NotFoundException $e) {
			return Response::create(['error' => $e->getMessage()], Response::HTTP_NOT_FOUND);
		} catch (BadRequestHttpException $e) {
			return Response::create(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
		} catch (AlreadyExistException $e) {
			return Response::create(['error' => $e->getMessage()], Response::HTTP_CONFLICT);
		}
	}


	/**
	 * @param Request $req
	 * @return Response
	 */
	public function update(Request $req) {
		$this->assumeLogged($req);
		$member = $this->loggedUser($req);
		$updated = $req->get('member');
		if (!$updated)
			return Response::create(['error' => 'No member specified'], Response::HTTP_BAD_REQUEST);
		if ($member->getId() != $updated['id'])
			return Response::create(['error' => 'Can modify olny yourself'], Response::HTTP_FORBIDDEN);

		try {
			$mem = $this->memberService->updateMember($member->getLogin(), $updated);
			$formatted = $this->memberService->format($mem);
		} catch (NotFoundException $e) {
			return Response::create(['error' => $e->getMessage()], Response::HTTP_NOT_FOUND);
		} catch (BadRequestHttpException $e) {
			return Response::create(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
		} catch (BadParameterException $e) {
			return Response::create(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
		} catch (AlreadyExistException $e) {
			return Response::create(['error' => $e->getMessage()], Response::HTTP_CONFLICT);
		} catch (AuthenticationException $e) {
			return Response::create(['error' => $e->getMessage()], Response::HTTP_UNAUTHORIZED);
		}
		return Response::create($formatted, Response::HTTP_ACCEPTED);
	}
}
