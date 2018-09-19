<?php

namespace App\Http\Controllers;

use App\Model\Exception\AuthenticationException;
use App\Model\Exception\BadParameterException;
use App\Model\Exception\NotFoundException;
use App\Model\Service\ICurrencyService;
use App\Model\Service\IMemberService;
use App\Model\Service\ITranslationService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CurrencyController extends AbstractController
{
	/** @var ICurrencyService */
	protected $currencyService;

    /**
     * CurrencyController constructor.
     * @param IMemberService $memberService
     * @param ITranslationService $translationService
     * @param ICurrencyService $currencyService
     */
	public function __construct(IMemberService $memberService, ITranslationService $translationService, ICurrencyService $currencyService) {
		parent::__construct($memberService, $translationService);
		$this->currencyService = $currencyService;
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
			$currencies = $this->currencyService->getCurrencies();
			$formatted = $this->currencyService->formatEntities($currencies);
		} catch (NotFoundException $ex) {
		    $message = $this->trans->getTranslation($ex->getMessage(), $this->member->getLanguage()->getCode(), $ex->getDefault())->getValue();
			return Response::create(['error' => $ex->bind($message)], Response::HTTP_NO_CONTENT);
		}
		return Response::create($formatted, Response::HTTP_OK);
	}
}
