<?php

namespace App\Http\Controllers;

use App\Model\Exception\BadParameterException;
use App\Model\Exception\NotFoundException;
use App\Model\Service\ITranslationService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TranslationController extends Controller
{
	/**
	 * @var ITranslationService
	 */
	protected $translationService;

	/**
	 * TranslationController constructor.
	 * @param ITranslationService $translationService
	 */
	public function __construct(ITranslationService $translationService) {
		$this->translationService = $translationService;
	}


	/**
	 * @param Request $request
	 * @return Response
	 */
	public function gets(Request $request) {
		try {
			$languageCode = $request->get('language');
			$translations = $this->translationService->getTranslationsByLanguage($languageCode);
			$translations = $this->translationService->formatEntites($translations);
		} catch (NotFoundException $ex) {
			return Response::create(['error' => $ex->getMessage()], Response::HTTP_NOT_FOUND);
		} catch (BadParameterException $ex) {
			return Response::create(['error' => $ex->getMessage()], Response::HTTP_BAD_REQUEST);
		}

		return Response::create($translations, Response::HTTP_OK);
	}
}
