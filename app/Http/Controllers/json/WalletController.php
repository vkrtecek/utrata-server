<?php

namespace App\Http\Controllers;

use App\Model\Exception\AuthenticationException;
use App\Model\Exception\BadParameterException;
use App\Model\Exception\IntegrityException;
use App\Model\Exception\NotFoundException;
use App\Model\Exception\UnderEntityNotFoundException;
use App\Model\Service\IMemberService;
use App\Model\Service\IWalletService;
use App\Model\Service\MemberService;
use App\Model\Service\WalletService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class WalletController extends AbstractController
{
	/**
	 * @var IWalletService
	 */
	protected $walletService;

	/**
	 * WalletController constructor.
	 * @param IMemberService $memberService
	 * @param IWalletService $walletService
	 */
	public function __construct(IMemberService $memberService, IWalletService $walletService) {
		parent::__construct($memberService);
		$this->walletService = $walletService;
	}

	public function getUserWallets(Request $req) {
		$this->assumeLogged($req);

		$login = $req->get('login');
		try {
			$wallets = $this->walletService->getWallets($login);
			$wallets = $this->walletService->formatEntities($wallets);
		} catch (BadParameterException $ex) {
			return Response::create(['error' => $ex->getMessage()], Response::HTTP_BAD_REQUEST);
		} catch (NotFoundException $ex) {
			return Response::create(['error' => $ex->getMessage()], Response::HTTP_NO_CONTENT);
		} catch (UnderEntityNotFoundException $ex) {
			return Response::create(['error' => $ex->getMessage()], Response::HTTP_NOT_FOUND);
		}

		return Response::create($wallets, Response::HTTP_OK);
	}

	/**
	 * @param Request $req
	 * @return Response
	 */
	public function get(Request $req) {
		$this->assumeLogged($req);
		$walletId = $req->get('id');
		try {
			$member = $this->loggedUser($req);
			$wallet = $this->walletService->getWallet($walletId, $member);
			$formatted = $this->walletService->format($wallet);
		} catch (NotFoundException $ex) {
			return Response::create(['error' => $ex->getMessage()], Response::HTTP_NO_CONTENT);
		} catch (BadParameterException $ex) {
			return Response::create(['error' => $ex->getMessage()], Response::HTTP_BAD_REQUEST);
		} catch (AuthenticationException $ex) {
			return Response::create(['error' => $ex->getMessage()], Response::HTTP_FORBIDDEN);
		} catch (UnderEntityNotFoundException $ex) {
			return Response::create(['error' => $ex->getMessage()], Response::HTTP_NOT_FOUND);
		}

		return Response::create($formatted, Response::HTTP_OK);
	}


	/**
	 * @param Request $req
	 * @return Response
	 */
	public function create(Request $req) {
		$this->assumeLogged($req);
		$member = $this->loggedUser($req);
		$name = $req->get('name');

		$wallet = $this->walletService->createWallet($member, $name);
		return Response::create($wallet->getId(), Response::HTTP_CREATED);
	}


	/**
	 * @param Request $req
	 * @param int $id
	 * @return Response
	 */
	public function update(Request $req, $id) {
		$this->assumeLogged($req);
		$member = $this->loggedUser($req);
		$name = $req->get('name');

		try {
			$wallet = $this->walletService->updateWallet($member, $id, $name);
			$wallet = $this->walletService->format($wallet);
		} catch (NotFoundException $ex) {
			return Response::create(['error' => $ex->getMessage()], Response::HTTP_NOT_FOUND);
		} catch (BadParameterException $ex) {
			return Response::create(['error' => $ex->getMessage()], Response::HTTP_BAD_REQUEST);
		} catch (BadRequestHttpException $ex) {
			return Response::create(['error' => $ex->getMessage()], Response::HTTP_BAD_REQUEST);
		} catch (AuthenticationException $ex) {
			return Response::create(['error' => $ex->getMessage()], Response::HTTP_FORBIDDEN);
		} catch (UnderEntityNotFoundException $ex) {
			return Response::create(['error' => $ex->getMessage()], Response::HTTP_NOT_FOUND);
		}
		return Response::create($wallet, Response::HTTP_OK);
	}

	/**
	 * @param Request $req
	 * @param int $id
	 * @return Response
	 */
	public function delete(Request $req, $id) {
		$this->assumeLogged($req);
		$member = $this->loggedUser($req);
		try {
			$retID = $this->walletService->deleteWallet($id, $member);
		} catch (NotFoundException $ex) {
			return Response::create(['error' => $ex->getMessage()], Response::HTTP_NO_CONTENT);
		} catch (BadParameterException $ex) {
			return Response::create(['error' => $ex->getMessage()], Response::HTTP_BAD_REQUEST);
		} catch (IntegrityException $ex) {
			return Response::create(['error' => $ex->getMessage()], Response::HTTP_FORBIDDEN);
		} catch (AuthenticationException $ex) {
			return Response::create(['error' => $ex->getMessage()], Response::HTTP_FORBIDDEN);
		}
		return Response::create($retID, Response::HTTP_OK);
	}




	public function updateCheckState(Request $req) {
		$this->assumeLogged($req);
		$member = $this->loggedUser($req);
		$walletId = $req->get('id');
		$type = $req->get('type');
		$value = $req->get('value');
		if (!$walletId || !$type || !$value)
			return Response::create(['error' => 'missing id, type or value'], Response::HTTP_BAD_REQUEST);

		try {
			$formatted = $this->walletService->updateCheckState($member, $walletId, $type, $value);
		} catch (NotFoundException $ex) {
			return Response::create(['error' => $ex->getMessage()], Response::HTTP_NO_CONTENT);
		} catch (BadParameterException $ex) {
			return Response::create(['error' => $ex->getMessage()], Response::HTTP_BAD_REQUEST);
		} catch (AuthenticationException $ex) {
			return Response::create(['error' => $ex->getMessage()], Response::HTTP_FORBIDDEN);
		}
		return Response::create($formatted, Response::HTTP_ACCEPTED);
	}
}
