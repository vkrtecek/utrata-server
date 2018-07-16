<?php

namespace App\Http\Controllers;

use App\Model\Exception\NotFoundException;
use App\Model\Service\ILanguageService;
use App\Model\Service\IMemberService;
use Illuminate\Http\Response;

class LanguageController extends AbstractController
{
	/** @var ILanguageService */
	protected $languageService;

	/**
	 * LanguageController constructor.
	 * @param IMemberService $memberService
	 * @param ILanguageService $languageService
	 */
	public function __construct(IMemberService $memberService, ILanguageService $languageService) {
		parent::__construct($memberService);
		$this->languageService = $languageService;
	}


	/**
	 * @return Response
	 */
	public function gets() {
		try {
			$languages = $this->languageService->getLanguages();
			$formatted = $this->languageService->formatEntites($languages);
		} catch (NotFoundException $e) {
			return Response::create(['error' => $e->getMessage()], Response::HTTP_NO_CONTENT);
		}
		return Response::create($formatted, Response::HTTP_OK);
	}
}
