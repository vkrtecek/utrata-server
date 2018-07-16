<?php

/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 30. 6. 2018
 * Time: 23:41
 */
namespace App\Http\Controllers;

use App\Model\Exception\NotFoundException;
use App\Model\Service\ICurrencyService;
use App\Model\Service\ILanguageService;
use App\Model\Service\IMemberService;
use App\Model\Service\IPurposeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MemberControllerMVC extends AbstractControllerMVC
{
	const MIN_PASSWD_LENGTH = 4;

	/** @var ICurrencyService */
	protected $currencyService;
	/** @var ILanguageService */
	protected $languageService;
	/** @var IPurposeService */
	protected $purposeService;

	/**
	 * MemberControllerMVC constructor.
	 * @param IMemberService $memberService
	 * @param ICurrencyService $currencyService
	 * @param ILanguageService $languageService
	 * @param IPurposeService $purposeService
	 */
	public function __construct(IMemberService $memberService, ICurrencyService $currencyService, ILanguageService $languageService, IPurposeService $purposeService) {
		parent::__construct($memberService);
		$this->currencyService = $currencyService;
		$this->languageService = $languageService;
		$this->purposeService = $purposeService;
	}

	public function get(Request $request) {
		$this->assumeLogged();
	}

	public function checkLoginExistence() {

	}

	public function checkEmailExistence() {

	}

	public function create() {

	}

	public function update(Request $request) {
		$this->assumeLogged();
		$ignore = ['login', 'me'];
		if (!$request->get('changePassword')) {
			$ignore[] = 'password';
			$ignore[] = 'oldPassword';
		}
		$this->validator($request->all(), $ignore)->validate();
		try {
			$this->memberService->updateMember($request->get('login'), $request->all());
		} catch (\Exception $ex) {
			$member = Auth::user();
			$currencies = $this->currencyService->getCurrencies();
			$languages = $this->languageService->getLanguages();
			$purposes = $this->purposeService->getLanguagePurposes($member->getLanguage()->getCode());
			return view('pages.settings')->with('warning', $ex->getMessage())
				->with('member', $member)
				->with('currencies', $currencies)
				->with('languages', $languages)
				->with('notes', $purposes)
				->with('warning', $ex->getMessage())
				->with('changePassword', $request->get('changePassword'));
		}
		if ($request->get('languageCode')) {
			$newLanguage = $this->languageService->getLanguage($request->get('languageCode'));
			App::setLocale($newLanguage->getLocale());
//			app()->setLocale($newLanguage->getLocale());
			dump($newLanguage->getLocale());
		}
		return redirect(route('get.member.settings'));
	}

	public function interactWithFacebook() {

	}

	public function settings() {
		$this->assumeLogged();
		$member = Auth::user();
		$currencies = $this->currencyService->getCurrencies();
		$languages = $this->languageService->getLanguages();
		try {
			$purposes = $this->purposeService->getLanguagePurposes($member->getLanguage()->getCode());
		} catch (NotFoundException $e) {
			$purposes = [];
		}
		return view('pages.settings')
			->with('member', $member)
			->with('currencies', $currencies)
			->with('languages', $languages)
			->with('notes', $purposes)
			->with('changePassword', FALSE);
	}



	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @param array $ignore
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	protected function validator(array $data, array $ignore = NULL) {
		$expected = [
			'firstName' => 'required|string|min:2|max:191',
			'lastName' => 'required|string|min:2|max:191',
			'login' => 'bail|required|string|min:4|unique',
			'me' => 'bail|required|string|email|max:191|unique',
			'password' => 'bail|required|string|min:' . self::MIN_PASSWD_LENGTH . '|confirmed',
			'oldPassword' => 'required|string|oldPassword:' . Auth::user()->getPassword(),
		];
		if ($ignore) {
			foreach ($ignore as $param)
				unset($expected[$param]);
		}

		return Validator::make($data, $expected);
	}
}