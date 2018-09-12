<?php

namespace App\Http\Controllers;

use App\Model\Exception\AuthenticationException;
use App\Model\Exception\BadParameterException;
use App\Model\Exception\BadRequestException;
use App\Model\Exception\IntegrityException;
use App\Model\Exception\NotFoundException;
use App\Model\Service\IMemberService;
use App\Model\Service\ITranslationService;
use App\Model\Service\IWalletService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class WalletController extends AbstractController
{
	/**
	 * @var IWalletService
	 */
	protected $walletService;

    /**
     * WalletController constructor.
     * @param IMemberService $memberService
     * @param ITranslationService $translationService
     * @param IWalletService $walletService
     */
	public function __construct(IMemberService $memberService, ITranslationService $translationService, IWalletService $walletService) {
		parent::__construct($memberService, $translationService);
		$this->walletService = $walletService;
	}

    /**
     * @param Request $req
     * @return Response
     * @throws AuthenticationException
     * @throws NotFoundException
     * @throws BadParameterException
     */
	public function getUserWallets(Request $req) {
		$this->assumeLogged($req);

		$login = $this->member->getLogin();
		try {
			$wallets = $this->walletService->getWallets($login);
			$wallets = $this->walletService->formatEntities($wallets);
		} catch (NotFoundException $ex) {
            $message = $this->trans->getTranslation($ex->getMessage(), $this->member->getLanguage()->getCode(), $ex->getDefault());
			return Response::create(['error' => $ex->bind($message)], Response::HTTP_NO_CONTENT);
		}

		return Response::create($wallets, Response::HTTP_OK);
	}

	/**
	 * @param Request $req
	 * @param int $walletId
	 * @return Response
     * @throws AuthenticationException
     * @throws NotFoundException
     * @throws BadParameterException
	 */
	public function get(Request $req, $walletId) {
		$this->assumeLogged($req);
		try {
			$wallet = $this->walletService->getWallet($walletId, $this->member);
			$formatted = $this->walletService->format($wallet);
		} catch (NotFoundException $ex) {
            $message = $this->trans->getTranslation($ex->getMessage(), $this->member->getLanguage()->getCode(), $ex->getDefault());
			return Response::create(['error' => $ex->bind($message)], Response::HTTP_NO_CONTENT);
		} catch (BadParameterException $ex) {
            $message = $this->trans->getTranslation($ex->getMessage(), $this->member->getLanguage()->getCode(), $ex->getDefault());
			return Response::create(['error' => $ex->bind($message)], Response::HTTP_BAD_REQUEST);
		} catch (AuthenticationException $ex) {
            $message = $this->trans->getTranslation($ex->getMessage(), $this->member->getLanguage()->getCode(), $ex->getDefault());
			return Response::create(['error' => $ex->bind($message)], Response::HTTP_FORBIDDEN);
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
	public function create(Request $req) {
		$this->assumeLogged($req);
		$name = $req->get('name');

		try {
            $wallet = $this->walletService->createWallet($this->member, $name);
        } catch (BadParameterException $ex) {
            $message = $this->trans->getTranslation($ex->getMessage(), $this->member->getLanguage()->getCode(), $ex->getDefault());
            return Response::create(['error' => $ex->bind($message)], Response::HTTP_BAD_REQUEST);
        }
		return Response::create($wallet->getId(), Response::HTTP_CREATED);
	}


	/**
	 * @param Request $req
	 * @param int $id
	 * @return Response
     * @throws AuthenticationException
     * @throws NotFoundException
     * @throws BadParameterException
	 */
	public function update(Request $req, $id) {
		$this->assumeLogged($req);
		$name = $req->get('name');

		try {
			$wallet = $this->walletService->updateWallet($this->member, $id, $name);
			$wallet = $this->walletService->format($wallet);
		} catch (NotFoundException $ex) {
            $message = $this->trans->getTranslation($ex->getMessage(), $this->member->getLanguage()->getCode(), $ex->getDefault());
			return Response::create(['error' => $ex->bind($message)], Response::HTTP_NOT_FOUND);
		} catch (BadParameterException $ex) {
            $message = $this->trans->getTranslation($ex->getMessage(), $this->member->getLanguage()->getCode(), $ex->getDefault());
			return Response::create(['error' => $ex->bind($message)], Response::HTTP_BAD_REQUEST);
		} catch (BadRequestException $ex) {
            $message = $this->trans->getTranslation($ex->getMessage(), $this->member->getLanguage()->getCode(), $ex->getDefault());
			return Response::create(['error' => $ex->bind($message)], Response::HTTP_BAD_REQUEST);
		} catch (AuthenticationException $ex) {
            $message = $this->trans->getTranslation($ex->getMessage(), $this->member->getLanguage()->getCode(), $ex->getDefault());
			return Response::create(['error' => $ex->bind($message)], Response::HTTP_FORBIDDEN);
		}
		return Response::create($wallet, Response::HTTP_ACCEPTED);
	}

	/**
	 * @param Request $req
	 * @param int $id
	 * @return Response
     * @throws AuthenticationException
     * @throws NotFoundException
     * @throws BadParameterException
	 */
	public function delete(Request $req, $id) {
		$this->assumeLogged($req);
		try {
			$retID = $this->walletService->deleteWallet($id, $this->member);
		} catch (NotFoundException $ex) {
            $message = $this->trans->getTranslation($ex->getMessage(), $this->member->getLanguage()->getCode(), $ex->getDefault());
			return Response::create(['error' => $ex->bind($message)], Response::HTTP_NO_CONTENT);
		} catch (BadParameterException $ex) {
            $message = $this->trans->getTranslation($ex->getMessage(), $this->member->getLanguage()->getCode(), $ex->getDefault());
			return Response::create(['error' => $ex->bind($message)], Response::HTTP_BAD_REQUEST);
		} catch (IntegrityException $ex) {
            $message = $this->trans->getTranslation($ex->getMessage(), $this->member->getLanguage()->getCode(), $ex->getDefault());
			return Response::create(['error' => $ex->bind($message)], Response::HTTP_FORBIDDEN);
		} catch (AuthenticationException $ex) {
            $message = $this->trans->getTranslation($ex->getMessage(), $this->member->getLanguage()->getCode(), $ex->getDefault());
			return Response::create(['error' => $ex->bind($message)], Response::HTTP_FORBIDDEN);
		}
		return Response::create($retID, Response::HTTP_OK);
	}


	/**
	 * @param Request $req
	 * @param int $walletId
	 * @return Response
     * @throws AuthenticationException
     * @throws NotFoundException
     * @throws BadParameterException
	 */
	public function updateCheckState(Request $req, $walletId) {
		$this->assumeLogged($req);
		$type = $req->get('type');
		$value = $req->get('value');
		if (!strlen($walletId) || !strlen($type) || !strlen($value))
			return Response::create(['error' => 'missing id, type or value'], Response::HTTP_BAD_REQUEST);

		try {
			$formatted = $this->walletService->updateCheckState($this->member, $walletId, $type, $value);
		} catch (NotFoundException $ex) {
            $message = $this->trans->getTranslation($ex->getMessage(), $this->member->getLanguage()->getCode(), $ex->getDefault());
			return Response::create(['error' => $ex->bind($message)], Response::HTTP_NO_CONTENT);
		} catch (BadParameterException $ex) {
            $message = $this->trans->getTranslation($ex->getMessage(), $this->member->getLanguage()->getCode(), $ex->getDefault());
			return Response::create(['error' => $ex->bind($message)], Response::HTTP_BAD_REQUEST);
		} catch (AuthenticationException $ex) {
            $message = $this->trans->getTranslation($ex->getMessage(), $this->member->getLanguage()->getCode(), $ex->getDefault());
			return Response::create(['error' => $ex->bind($message)], Response::HTTP_FORBIDDEN);
		}
		return Response::create($formatted, Response::HTTP_ACCEPTED);
	}

	/**
	 * @param int $price
	 * @return string
	 */
	public static function getClassForPrice($price) {
		if ($price < 0)
			return "red";
		else if ($price == 0)
			return "violet";
		else
			return "black";
	}
}
