<?php

namespace App\Http\Controllers;

use App\Model\Exception\AuthenticationException;
use App\Model\Exception\BadParameterException;
use App\Model\Exception\NotFoundException;
use App\Model\Service\ILanguageService;
use App\Model\Service\IMemberService;
use App\Model\Service\ITranslationService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LanguageController extends AbstractController
{
	/** @var ILanguageService */
	protected $languageService;

    /**
     * LanguageController constructor.
     * @param IMemberService $memberService
     * @param ITranslationService $translationService
     * @param ILanguageService $languageService
     */
	public function __construct(IMemberService $memberService, ITranslationService $translationService, ILanguageService $languageService) {
		parent::__construct($memberService, $translationService);
		$this->languageService = $languageService;
	}


	/**
     * @param Request $req
	 * @return Response
     * @throws AuthenticationException
     * @throws NotFoundException
     * @throws BadParameterException
	 */
	public function gets(Request $req) {
	    $this->assumeLogged($req);
		try {
			$languages = $this->languageService->getLanguages();
			$formatted = $this->languageService->formatEntites($languages);
		} catch (NotFoundException $ex) {
            $message = $this->trans->getTranslation($ex->getMessage(), $this->member->getLanguage()->getCode(), $ex->getDefault())->getValue();
			return Response::create(['error' => $ex->bind($message)], Response::HTTP_NO_CONTENT);
		}
		return Response::create($formatted, Response::HTTP_OK);
	}
}
