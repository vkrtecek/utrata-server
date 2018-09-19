<?php

namespace App\Http\Controllers;

use App\Model\Exception\AlreadyExistException;
use App\Model\Exception\AuthenticationException;
use App\Model\Exception\BadParameterException;
use App\Model\Exception\IntegrityException;
use App\Model\Exception\NotFoundException;
use App\Model\Service\IMemberService;
use App\Model\Service\IPurposeService;
use App\Model\Service\ITranslationService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PurposeController extends AbstractController
{

	/** @var IPurposeService */
	protected $purposeService;


    /**
     * PurposeController constructor.
     * @param IMemberService $memberService
     * @param ITranslationService $translationService
     * @param IPurposeService $purposeService
     */
	public function __construct(IMemberService $memberService, ITranslationService $translationService, IPurposeService $purposeService) {
		parent::__construct($memberService, $translationService);
		$this->purposeService = $purposeService;
	}


	/**
	 * @param Request $req
	 * @return Response
     * @throws AuthenticationException
     * @throws NotFoundException
     * @throws BadParameterException
	 */
	protected function getUserPurposes(Request $req) {
		$this->assumeLogged($req);
		try {
			$purposes = $this->purposeService->getUserPurposes($this->member);
			$purposes = $this->purposeService->formatEntities($purposes, $this->member);
		} catch (NotFoundException $ex) {
            $message = $this->trans->getTranslation($ex->getMessage(), $this->member->getLanguage()->getCode(), $ex->getDefault())->getValue();
			return Response::create(['error' => $ex->bind($message)], Response::HTTP_NOT_FOUND);
		}
		return Response::create(["purposes" => $purposes], Response::HTTP_OK);
	}


	/**
	 * @param Request $req
	 * @param string $languageCode
	 * @return Response
     * @throws AuthenticationException
     * @throws NotFoundException
     * @throws BadParameterException
	 */
	public function getLanguagePurposes(Request $req, $languageCode) {
		$this->assumeLogged($req);
		try {
			$purposes = $this->purposeService->getUserLanguagePurposes($this->member, $languageCode);
			$formatted = $this->purposeService->formatEntities($purposes, $this->member);
		} catch (NotFoundException $ex) {
            $message = $this->trans->getTranslation($ex->getMessage(), $this->member->getLanguage()->getCode(), $ex->getDefault())->getValue();
			return Response::create(['error' => $ex->bind($message)], Response::HTTP_NOT_FOUND);
		} catch (BadParameterException $ex) {
            $message = $this->trans->getTranslation($ex->getMessage(), $this->member->getLanguage()->getCode(), $ex->getDefault())->getValue();
            return Response::create(['error' => $ex->bind($message)], Response::HTTP_BAD_REQUEST);
        }
		return Response::create(['purposes' => $formatted], Response::HTTP_OK);
	}

	/**
	 * @param Request $req
	 * @return Response
     * @throws AuthenticationException
	 */
	public function getPurposesCreatedByUser(Request $req) {
		$this->assumeLogged($req);
		$purposes = $this->purposeService->getPurposesCreatedByUser($this->member);
		$formatted = $this->purposeService->formatEntities($purposes, $this->member);
		return Response::create(['purposes' => $formatted], Response::HTTP_OK);
	}


	/**
	 * @param Request $req
	 * @return Response
     * @throws AuthenticationException
     * @throws NotFoundException
     * @throws BadParameterException
	 */
	public function create(Request$req) {
		$this->assumeLogged($req);
		$note = $req->get('note');
		if (!$note)
			return Response::create(['error' => 'Note missing'], Response::HTTP_BAD_REQUEST);

		try {
			$purpose = $this->purposeService->createPurpose($this->member, $note);
			$formatted = $this->purposeService->format($purpose, $this->member);
		} catch (BadParameterException $ex) {
            $message = $this->trans->getTranslation($ex->getMessage(), $this->member->getLanguage()->getCode(), $ex->getDefault())->getValue();
            return Response::create(['error' => $ex->bind($message)], Response::HTTP_BAD_REQUEST);
        } catch (NotFoundException $ex) {
            $message = $this->trans->getTranslation($ex->getMessage(), $this->member->getLanguage()->getCode(), $ex->getDefault())->getValue();
            return Response::create(['error' => $ex->bind($message)], Response::HTTP_NOT_FOUND);
        } catch (AlreadyExistException $ex) {
            $message = $this->trans->getTranslation($ex->getMessage(), $this->member->getLanguage()->getCode(), $ex->getDefault())->getValue();
			return Response::create([
				'error' => $ex->bind($message),
				'code' => $ex->getReason(),
			], Response::HTTP_CONFLICT);
		}
		return Response::create($formatted, Response::HTTP_CREATED);
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
			$retId = $this->purposeService->deletePurpose($id, $this->member);
		} catch (NotFoundException $ex) {
            $message = $this->trans->getTranslation($ex->getMessage(), $this->member->getLanguage()->getCode(), $ex->getDefault())->getValue();
			return Response::create(['error' => $ex->bind($message)], Response::HTTP_NOT_FOUND);
		} catch (BadParameterException $ex) {
            $message = $this->trans->getTranslation($ex->getMessage(), $this->member->getLanguage()->getCode(), $ex->getDefault())->getValue();
			return Response::create(['error' => $ex->bind($message)], Response::HTTP_BAD_REQUEST);
		} catch (IntegrityException $ex) {
            $message = $this->trans->getTranslation($ex->getMessage(), $this->member->getLanguage()->getCode(), $ex->getDefault())->getValue();
		    return Response::create(['error' => $ex->bind($message)], Response::HTTP_METHOD_NOT_ALLOWED);
        }
		return Response::create($retId, Response::HTTP_OK);
	}
}
