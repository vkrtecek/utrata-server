<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 29. 1. 2018
 * Time: 4:45
 */

namespace App\Http\Controllers;

use App\Model\Exception\AuthenticationException;
use App\Model\Exception\BadParameterException;
use App\Model\Exception\EOFException;
use App\Model\Exception\FileParseException;
use App\Model\Exception\NotFoundException;
use App\Model\Service\IFileService;
use App\Model\Service\IMemberService;
use App\Model\Service\ITranslationService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FileController extends AbstractController
{
	/** @var IFileService */
	protected $fileService;

    /**
     * FileController constructor.
     * @param IMemberService $memberService
     * @param ITranslationService $translationService
     * @param IFileService $fileService
     */
	public function __construct(IMemberService $memberService, ITranslationService $translationService, IFileService $fileService) {
		parent::__construct($memberService, $translationService);
		$this->fileService = $fileService;
	}


	/**
	 * @param Request $req
	 * @return Response
     * @throws AuthenticationException
	 */
	public function backup(Request $req) {
		$this->assumeLogged($req);
        $file = $this->fileService->getBackup($this->member);
		return Response::create(['content' => $file], Response::HTTP_OK);
	}



	/**
	 * @param Request $req
	 * @return Response
     * @throws AuthenticationException
     * @throws NotFoundException
     * @throws BadParameterException
	 */
	public function store(Request $req) {
		$this->assumeLogged($req);
		$content = $req->get('data');
		try {
			$bool = $this->fileService->storeBackup($this->member, $content);
		} catch (FileParseException $ex) {
            $message = $this->trans->getTranslation($ex->getMessage(), $this->member->getLanguage()->getCode(), $ex->getDefault());
			return Response::create(['error' => $ex->bind($message)], Response::HTTP_EXPECTATION_FAILED);
		} catch (EOFException $ex) {
            $message = $this->trans->getTranslation($ex->getMessage(), $this->member->getLanguage()->getCode(), $ex->getDefault());
			return Response::create(['error' => $ex->bind($message)], Response::HTTP_CONFLICT);
		}
		return Response::create(['success' => $bool], Response::HTTP_OK);
	}

}
