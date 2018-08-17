<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 7. 7. 2018
 * Time: 18:47
 */

namespace App\Http\Controllers;


use App\Model\Exception\AlreadyExistException;
use App\Model\Exception\AuthenticationException;
use App\Model\Exception\AuthenticationMVCException;
use App\Model\Exception\BadParameterException;
use App\Model\Exception\NotFoundException;
use App\Model\Help\DateFormatter;
use App\Model\Service\ICurrencyService;
use App\Model\Service\IItemService;
use App\Model\Service\IMemberService;
use App\Model\Service\IPurposeService;
use App\Model\Service\ITranslationService;
use App\Model\Service\IWalletService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class ItemControllerMVC extends AbstractControllerMVC
{
	/** @var IItemService */
	protected $itemService;
	/** @var ICurrencyService */
	protected $currencyService;
	/** @var IPurposeService */
	protected $purposeService;
	/** @var IWalletService */
	protected $walletService;
	/** @var ITranslationService */
	protected $translationService;
	/** @var DateFormatter */
	protected $dateFormatter;

	/**
	 * ItemControllerMVC constructor.
	 * @param IMemberService $memberService
	 * @param IItemService $itemService
	 * @param ICurrencyService $currencyService
	 * @param IPurposeService $purposeService
	 * @param IWalletService $walletService
	 * @param ITranslationService $translationService
	 * @param DateFormatter $dateFormatter
	 */
	public function __construct(IMemberService $memberService,
								IItemService $itemService,
								ICurrencyService $currencyService,
								IPurposeService $purposeService,
								IWalletService $walletService,
								ITranslationService $translationService,
								DateFormatter $dateFormatter
	) {
		parent::__construct($memberService);
		$this->itemService = $itemService;
		$this->currencyService = $currencyService;
		$this->purposeService = $purposeService;
		$this->walletService = $walletService;
		$this->translationService = $translationService;
		$this->dateFormatter = $dateFormatter;
	}

	/**
	 * @param int $id
	 * @return Response
	 * @throws \App\Model\Exception\AuthenticationMVCException
	 */
	public function getHTML($id) {
		$this->assumeLogged();
		$member = $this->loggedMember();
		try {
			$item = $this->itemService->getItem($id);
		} catch (\Exception $ex) {
			return Response::create(['error' => $ex->getMessage()], Response::HTTP_BAD_REQUEST);
		}
		$item = $this->itemService->format($item, $member);
		$item = $this->makeHTML($item);
		return Response::create($item)->header('Content-Type', 'text/html');
	}

	/**
	 * @param Request $request
	 * @param int $walletId
	 * @return Response
	 * @throws AuthenticationMVCException
	 */
	public function getWalletItems(Request $request, $walletId) {
		$this->assumeLogged();
		$member = $this->loggedMember();
		try {
			$items = $this->itemService->getWalletItems($walletId, $member, $request->get('state'), $request->get('month'), $request->get('notes'), $request->get('year'), $request->get('pattern'), $request->get('orderBy'), $request->get('orderHow'), $request->get('limit'));
		} catch (\Exception $ex) {
			return Response::create(['error' => $ex->getMessage()], Response::HTTP_BAD_REQUEST);
		}
		$items = $this->itemService->formatEntities($items, $member);
		$response = $this->makeHTMLs($items, $request->get('state'));
		return Response::create($response)->header('Content-Type', 'text/html');
	}

	/**
	 * @param int $walletId
	 * @return View
	 * @throws NotFoundException
	 * @throws BadParameterException
	 * @throws AuthenticationException
	 */
	public function wantAdd($walletId) {
		$this->assumeLogged();
		$wallet = $this->walletService->getWallet($walletId, $this->member);
		$wallet = $this->walletService->format($wallet, $this->member);
		return view('pages.addItem')
			->with('wallet', $wallet);
	}

	/**
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 * @throws AuthenticationException
	 * @throws AuthenticationMVCException
	 * @throws BadParameterException
	 * @throws NotFoundException
	 * @throws \App\Model\Exception\UnderEntityNotFoundException
	 */
	public function create(Request $request) {
		$this->assumeLogged();
		try {
			$this->itemService->createItem($this->member, $request->all());
		} catch (\Exception $e) {
			$wallet = $this->walletService->getWallet($request->get('walletId'), $this->member);
			$wallet = $this->walletService->format($wallet, $this->member);
			return view('pages.addItem')
				->with('wallet', $wallet)
				->with('message', $e->getMessage());
		}
		return redirect(route('get.wallet', ['id' => $request->get('walletId')]));
	}

	/**
	 * @param int $id
	 * @return View
	 * @throws AuthenticationMVCException
	 * @throws \App\Model\Exception\BadParameterException
	 * @throws \App\Model\Exception\NotFoundException
	 * @throws \App\Model\Exception\UnderEntityNotFoundException
	 */
	public function wantUpdate($id) {
		$this->assumeLogged();
		$member = $this->loggedMember();
		$item = $this->itemService->getItem($id);
		$item = $this->itemService->format($item, $member);
		$currencies = $this->currencyService->getCurrencies();
		$currencies = $this->currencyService->formatEntities($currencies);
		$purposes = $this->purposeService->getUserPurposes($member);
		$purposes = $this->purposeService->formatEntities($purposes, $member);
		$wallets = $this->walletService->getWallets($member->getLogin());
		$wallets = $this->walletService->formatEntities($wallets);
		return view('pages.updateItem')
			->with('item', $item)
			->with('currencies', $currencies)
			->with('notes', $purposes)
			->with('wallets', $wallets);
	}

	/**
	 * @param Request $request
	 * @return Response
	 * @throws AuthenticationMVCException
	 */
	public function update(Request $request) {
		$this->assumeLogged();
		$member = $this->loggedMember();
		$data = $request->all();
		try {
			$item = $this->itemService->updateItem($member, $request->get('id'), $data);
			$item = $this->itemService->format($item, $member);
		} catch (\Exception $ex) {
			return Response::create(['error' => $ex->getMessage()], Response::HTTP_BAD_REQUEST);
		}
		//return redirect(route('get.wallet', ['id' => $request->get('wallet')]));
		return Response::create($item, Response::HTTP_ACCEPTED);
	}

	/**
	 * @param int $id
	 * @throws AuthenticationMVCException
	 * @throws \App\Model\Exception\AuthenticationException
	 * @throws \App\Model\Exception\BadParameterException
	 * @throws \App\Model\Exception\NotFoundException
	 */
	public function check($id) {
		$this->assumeLogged();
		$member = $this->loggedMember();
		$this->itemService->checkItem($member, $id);
	}

	/**
	 * @param int $id
	 * @throws AuthenticationMVCException
	 * @throws \App\Model\Exception\BadParameterException
	 * @throws \App\Model\Exception\IntegrityException
	 * @throws \App\Model\Exception\NotFoundException
	 */
	public function delete($id) {
		$this->assumeLogged();
		$member = $this->loggedMember();
		$this->itemService->deleteItem($member, $id);
	}


	/**
	 * @param array $items
	 * @param int $state
	 * @return string
	 */
	private function makeHTMLs($items, $state) {
		return view('jquery.items')->with('items', $items)->with('state', $state);
	}

	/**
	 * @param array $item
	 * @return string
	 */
	private function makeHTML($item) {
		return view('jquery.item')->with('item', $item);
	}
}
