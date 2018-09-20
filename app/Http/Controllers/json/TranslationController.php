<?php

namespace App\Http\Controllers;

use App\Model\Exception\AuthenticationException;
use App\Model\Exception\BadParameterException;
use App\Model\Exception\NotFoundException;
use App\Model\Service\IMemberService;
use App\Model\Service\ITranslationService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TranslationController extends AbstractController
{
    /**
     * TranslationController constructor.
     * @param IMemberService $memberService
     * @param ITranslationService $translationService
     */
	public function __construct(IMemberService $memberService, ITranslationService $translationService) {
	    parent::__construct($memberService, $translationService);
	}


	/**
	 * @param Request $request
	 * @return Response
     * @throws AuthenticationException
     * @throws NotFoundException
     * @throws BadParameterException
	 */
	public function gets(Request $request) {
        $languageCode = $request->get('language');
	    if (!$languageCode)
	        return Response::create(['error' => 'Empty language'], Response::HTTP_BAD_REQUEST);
		try {
			$translations = $this->trans->getTranslationsByLanguage($languageCode);
			$translations = $this->trans->formatEntities($translations);
		} catch (NotFoundException $ex) {
			return Response::create(['error' => $ex->bind($ex->getDefault())], Response::HTTP_NOT_FOUND);
		} catch (BadParameterException $ex) {
			return Response::create(['error' => $ex->bind($ex->getDefault())], Response::HTTP_BAD_REQUEST);
		}

		return Response::create($translations, Response::HTTP_OK);
	}
}
