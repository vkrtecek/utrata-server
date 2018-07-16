<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 1. 7. 2018
 * Time: 23:47
 */

namespace App\Http\Controllers;


use App\Model\Enum\ItemState;
use App\Model\Exception\AuthenticationException;
use App\Model\Exception\BadParameterException;
use App\Model\Service\IItemService;
use App\Model\Service\IMemberService;
use App\Model\Service\IWalletService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class WalletControllerMVC extends AbstractControllerMVC
{
	const MAX_ITEMS = 25;

	/** @var IWalletService */
	protected $walletService;
	/** @var IItemService */
	protected $itemService;

	/**
	 * WalletControllerMVC constructor.
	 * @param IMemberService $memberService
	 * @param IWalletService $walletService
	 * @param IItemService $itemService
	 */
	public function __construct(IMemberService $memberService, IWalletService $walletService, IItemService $itemService) {
		parent::__construct($memberService);
		$this->walletService = $walletService;
		$this->itemService = $itemService;
	}

	/**
	 * @return View
	 */
	public function getUserWallets() {
		$this->assumeLogged();
		$member = Auth::user();
		$wallets = $this->walletService->getWallets($member->getLogin());
		$wallets = $this->walletService->formatEntities($wallets);
		return view('pages.home')
			->with('wallets', $wallets);
	}

	/**
	 * @param int $id
	 * @return View|Redirect
	 */
	public function get($id) {
		$this->assumeLogged();
		$member = $this->loggedMember();
		try {
			$wallet = $this->walletService->getWallet($id, $member);
		} catch (AuthenticationException $ex) {
			return redirect(route('get.wallets'));
		}
		$wallet = $this->walletService->format($wallet);
		$items = $this->itemService->getWalletItems($id, $member);
		$items = $this->itemService->formatEntities($items, $member);
		return view('pages.wallet')
			->with('wallet', $wallet)
			->with('months', []) //id, code, value
			->with('notes', []) //id, value
			->with('items', $items)
			->with('state', ItemState::UNCHECKED);
	}

	/**
	 * @return View
	 */
	public function wantCreate() {
		return view('pages.addWallet');
	}

	/**
	 * @param Request $request
	 * @return Redirect|View
	 */
	public function create(Request $request) {
		try {
			$wallet = $this->walletService->createWallet(Auth::user(), $request->get('name'));
		} catch (BadParameterException $ex) {
			return view('pages.addWallet')->with('warning', $ex->getMessage());
		}
		return redirect(route('get.wallet', ['id' => $wallet->getId()]));
	}

	public function wantUpdate($id) {
		$wallet = $this->walletService->getWallet($id, Auth::user());
		$wallet = $this->walletService->format($wallet);
		return view('pages.updateWallet')->with('wallet', $wallet);
	}

	public function update(Request $request, $id) {
		try {
			$this->walletService->updateWallet(Auth::user(), $id, $request->get('name'));
		} catch (BadParameterException $ex) {
			$wallet = $this->walletService->getWallet($id, Auth::user());
			$wallet = $this->walletService->format($wallet);
			return view('pages.updateWallet')
				->with('wallet', $wallet)
				->with('warning', $ex->getMessage());
		}
		return redirect(route('get.wallets'));
	}

	public function delete($id) {
		$this->walletService->deleteWallet($id, Auth::user());
		return redirect(route('get.wallets'));
	}
}