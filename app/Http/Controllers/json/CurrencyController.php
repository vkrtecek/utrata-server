<?php

namespace App\Http\Controllers;

use App\Model\Exception\NotFoundException;
use App\Model\Service\CurrencyService;
use App\Model\Service\ICurrencyService;
use App\Model\Service\IMemberService;
use Illuminate\Http\Response;

class CurrencyController extends AbstractController
{
	/** @var ICurrencyService */
	protected $currencyService;

	/**
	 * ItemController constructor.
	 * @param IMemberService $memberService
	 * @param ICurrencyService $currencyService
	 */
	public function __construct(IMemberService $memberService, ICurrencyService $currencyService) {
		parent::__construct($memberService);
		$this->currencyService = $currencyService;
	}

	public function gets() {
		try {
			$currencies = $this->currencyService->getCurrencies();
			$formatted = CurrencyService::formatEntites($currencies);
		} catch (NotFoundException $e) {
			return Response::create(['error' => $e->getMessage()], Response::HTTP_NO_CONTENT);
		}
		return Response::create($formatted, Response::HTTP_OK);
	}
}
