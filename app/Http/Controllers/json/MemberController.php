<?php

namespace App\Http\Controllers;

use App\Model\Exception\AlreadyExistException;
use App\Model\Exception\AuthenticationException;
use App\Model\Exception\BadParameterException;
use App\Model\Exception\BadRequestException;
use App\Model\Exception\NotFoundException;
use App\Model\Exception\SecurityException;
use App\Model\Service\IMemberService;
use App\Model\Service\ITranslationService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MemberController extends AbstractController
{
    /**
     * MemberController constructor.
     * @param IMemberService $memberService
     * @param ITranslationService $translationService
     */
	public function __construct(IMemberService $memberService, ITranslationService $translationService) {
		parent::__construct($memberService, $translationService);
	}


	/**
	 * @param Request $req
	 * @return Response
     * @throws AuthenticationException
	 */
	public function get(Request $req) {
		$this->assumeLogged($req);
		$formatted = $this->memberService->format($this->member);
		return Response::create($formatted, Response::HTTP_OK);
	}




	/**
     * @param Request $req
	 * @param string $login
	 * @return Response
     * @throws AuthenticationException
	 */
	public function checkLoginExistence(Request $req, $login) {
        $this->assumeLogged($req);
		try {
			$this->memberService->getMember($login);
			return Response::create([TRUE], Response::HTTP_OK);
		} catch (NotFoundException $ex) {
			return Response::create([FALSE], Response::HTTP_OK);
		}
	}


	/**
     * @param Request $req
	 * @param string $mail
	 * @return Response
     * @throws AuthenticationException
	 */
	public function checkEmailExistence(Request $req, $mail) {
        $this->assumeLogged($req);
		try {
			$this->memberService->getMemberByColumn('myMail', $mail);
			return Response::create([TRUE], Response::HTTP_OK);
		} catch (NotFoundException $ex) {
			return Response::create([FALSE], Response::HTTP_OK);
		} catch (BadParameterException $ex) {
            return Response::create([FALSE], Response::HTTP_OK);
        }
	}



	/**
	 * @param Request $req
	 * @return Response
     * @throws NotFoundException
     * @throws BadParameterException
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
			return Response::create(['error' => $ex->bind($ex->getDefault())], Response::HTTP_UNAUTHORIZED);
		}
	}

	/**
	 * @param Request $req
	 * @return Response
     * @throws AuthenticationException
	 */
	public function logout(Request $req) {
		$this->assumeLogged($req);
        $this->memberService->logout($this->member);
		return Response::create([], Response::HTTP_OK);
	}


	/**
	 * @param Request $req
	 * @return Response
     * @throws AuthenticationException
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
		} catch (BadParameterException $ex) {
			return Response::create(['error' => $ex->bind($ex->getDefault())], Response::HTTP_BAD_REQUEST);
		} catch (NotFoundException $ex) {
			return Response::create(['error' => $ex->bind($ex->getDefault())], Response::HTTP_NOT_FOUND);
		} catch (BadRequestException $ex) {
			return Response::create(['error' => $ex->bind($ex->getDefault())], Response::HTTP_BAD_REQUEST);
		} catch (AlreadyExistException $ex) {
			return Response::create(['error' => $ex->bind($ex->getDefault())], Response::HTTP_CONFLICT);
		}
	}

    /**
     * register
     * @param Request $req
     * @return Response
     * @throws AuthenticationException
     */
	public function create(Request $req) {
		$data = $req->get('data');
		if (!$data)
		    return Response::create(['error' => 'Empty data'], Response::HTTP_BAD_REQUEST);

		try {
			$member = $this->memberService->createMember($data);
			$formatted = $this->memberService->format($member);
		} catch (AlreadyExistException $ex) {
			return Response::create(['error' => $ex->bind($ex->getDefault())], Response::HTTP_CONFLICT);
		} catch (BadRequestException $ex) {
            return Response::create(['error' => $ex->bind($ex->getDefault())], Response::HTTP_BAD_REQUEST);
        } catch (NotFoundException $ex) {
            return Response::create(['error' => $ex->bind($ex->getDefault())], Response::HTTP_NO_CONTENT);
        } catch (BadParameterException $ex) {
			return Response::create(['error' => $ex->bind($ex->getDefault())], Response::HTTP_BAD_REQUEST);
		}

		return Response::create($formatted, Response::HTTP_OK);
	}


	/**
	 * @param Request $req
	 * @return Response
     * @throws AuthenticationException
     * @throws NotFoundException
     * @throws BadParameterException
	 */
	public function update(Request $req) {
		$this->assumeLogged($req);
		$updated = $req->get('member');
		if (!$updated)
			return Response::create(['error' => 'No member specified'], Response::HTTP_BAD_REQUEST);
		if ($this->member->getId() != $updated['id'])
			return Response::create(['error' => 'Can modify only yourself'], Response::HTTP_FORBIDDEN);

		try {
			$mem = $this->memberService->updateMember($this->member->getLogin(), $updated);
			$formatted = $this->memberService->format($mem);
		} catch (NotFoundException $ex) {
            $message = $this->trans->getTranslation($ex->getMessage(), $this->member->getLanguage()->getCode(), $ex->getDefault())->getValue();
			return Response::create(['error' => $ex->bind($message)], Response::HTTP_NOT_FOUND);
		} catch (BadRequestException $ex) {
            $message = $this->trans->getTranslation($ex->getMessage(), $this->member->getLanguage()->getCode(), $ex->getDefault())->getValue();
			return Response::create(['error' => $ex->bind($message)], Response::HTTP_BAD_REQUEST);
		} catch (BadParameterException $ex) {
            $message = $this->trans->getTranslation($ex->getMessage(), $this->member->getLanguage()->getCode(), $ex->getDefault())->getValue();
			return Response::create(['error' => $ex->bind($message)], Response::HTTP_BAD_REQUEST);
		} catch (AlreadyExistException $ex) {
            $message = $this->trans->getTranslation($ex->getMessage(), $this->member->getLanguage()->getCode(), $ex->getDefault())->getValue();
			return Response::create(['error' => $ex->bind($message)], Response::HTTP_CONFLICT);
		} catch (AuthenticationException $ex) {
            $message = $this->trans->getTranslation($ex->getMessage(), $this->member->getLanguage()->getCode(), $ex->getDefault())->getValue();
			return Response::create(['error' => $ex->bind($message)], Response::HTTP_UNAUTHORIZED);
		}
		return Response::create($formatted, Response::HTTP_ACCEPTED);
	}
}
