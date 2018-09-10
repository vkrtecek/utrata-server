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
use App\Model\Exception\AuthenticationMVCException;
use App\Model\Exception\BadParameterException;
use App\Model\Exception\NotFoundException;
use App\Model\Exception\UnderEntityNotFoundException;
use App\Model\Filter\ItemFilter;
use App\Model\Help\DateFormatter;
use App\Model\Service\IItemService;
use App\Model\Service\IMemberService;
use App\Model\Service\IPurposeService;
use App\Model\Service\IWalletService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class WalletControllerMVC extends AbstractControllerMVC
{
	const MAX_ITEMS = 25;

	/** @var IWalletService */
	protected $walletService;
	/** @var IItemService */
	protected $itemService;
	/** @var IPurposeService */
	protected $purposeService;

	/**
	 * WalletControllerMVC constructor.
	 * @param IMemberService $memberService
	 * @param IWalletService $walletService
	 * @param IItemService $itemService
	 * @param IPurposeService $purposeService
	 */
	public function __construct(IMemberService $memberService, IWalletService $walletService, IItemService $itemService, IPurposeService $purposeService) {
		parent::__construct($memberService);
		$this->walletService = $walletService;
		$this->itemService = $itemService;
		$this->purposeService = $purposeService;
	}

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 * @throws BadParameterException
	 * @throws \App\Model\Exception\AuthenticationMVCException
	 * @throws \App\Model\Exception\NotFoundException
	 */
	public function getUserWallets() {
		$this->assumeLogged();
		$wallets = $this->walletService->getWallets($this->member->getLogin());
		try {
			$wallets = $this->walletService->formatEntities($wallets);
		} catch (UnderEntityNotFoundException $e) {
			// TODO
		}
		return view('pages.home')
			->with('wallets', $wallets);
	}

	/**
	 * @param int $id
	 * @return View|Redirect
	 * @throws AuthenticationException
	 * @throws BadParameterException
	 * @throws UnderEntityNotFoundException
	 * @throws \App\Model\Exception\AuthenticationMVCException
	 * @throws \App\Model\Exception\NotFoundException
	 */
	public function get($id) {
		$this->assumeLogged();
		try {
			$wallet = $this->walletService->getWallet($id, $this->member);
		} catch (AuthenticationException $ex) {
			return redirect(route('get.wallets'));
		}
		$wallet = $this->walletService->format($wallet);
		$items = $this->itemService->getWalletItems($id, $this->member);
		$items = $this->itemService->formatEntities($items, $this->member);
		$notes = $this->purposeService->getUserPurposes($this->member);
		$notes = $this->purposeService->formatEntities($notes, $this->member);
		return view('pages.wallet')
			->with('wallet', $wallet)
			->with('months', DateFormatter::$months) //id, code, value
			->with('notes', $notes) //id, value
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
     * @throws AuthenticationMVCException
	 */
	public function create(Request $request) {
	    $this->assumeLogged();
		try {
			$wallet = $this->walletService->createWallet($this->member, $request->get('name'));
		} catch (BadParameterException $ex) {
			return view('pages.addWallet')->with('warning', $ex->getMessage());
		}
		return redirect(route('get.wallet', ['id' => $wallet->getId()]));
	}

	/**
	 * @param $id
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 * @throws AuthenticationException
	 * @throws BadParameterException
	 * @throws UnderEntityNotFoundException
	 * @throws \App\Model\Exception\NotFoundException
	 */
	public function wantUpdate($id) {
        $this->assumeLogged();
		$wallet = $this->walletService->getWallet($id, $this->member);
		$wallet = $this->walletService->format($wallet);
		return view('pages.updateWallet')->with('wallet', $wallet);
	}

	/**
	 * @param Request $request
	 * @param $id
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
	 * @throws AuthenticationException
	 * @throws BadParameterException
	 * @throws UnderEntityNotFoundException
	 * @throws \App\Model\Exception\NotFoundException
	 */
	public function update(Request $request, $id) {
        $this->assumeLogged();
		try {
			$this->walletService->updateWallet($this->member, $id, $request->get('name'));
		} catch (BadParameterException $ex) {
			$wallet = $this->walletService->getWallet($id, $this->member);
			$wallet = $this->walletService->format($wallet);
			return view('pages.updateWallet')
				->with('wallet', $wallet)
				->with('warning', $ex->getMessage());
		}
		return redirect(route('get.wallets'));
	}

	/**
	 * @param $id
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 * @throws AuthenticationException
	 * @throws BadParameterException
	 * @throws \App\Model\Exception\IntegrityException
	 * @throws \App\Model\Exception\NotFoundException
	 */
	public function delete($id) {
        $this->assumeLogged();
		$this->walletService->deleteWallet($id, $this->member);
		return redirect(route('get.wallets'));
	}

    /**
     * @param int $walletId
     * @return View
     * @throws AuthenticationException
     * @throws AuthenticationMVCException
     * @throws BadParameterException
     * @throws UnderEntityNotFoundException
     * @throws NotFoundException
     */
    public function incomes($walletId) {
        $this->assumeLogged();
        try {
            $wallet = $this->walletService->getWallet($walletId, $this->member);
        } catch (AuthenticationException $ex) {
            return redirect(route('get.wallets'));
        }
        $filter = (new ItemFilter())->setState(ItemState::INCOMES);

        $wallet = $this->walletService->format($wallet);
        $items = $this->itemService->getWalletItems($walletId, $this->member, $filter);
        $items = $this->itemService->formatEntities($items, $this->member);
        $notes = $this->purposeService->getUserPurposes($this->member);
        $notes = $this->purposeService->formatEntities($notes, $this->member);
        return view('pages.incomes')
            ->with('wallet', $wallet)
            ->with('months', DateFormatter::$months) //id, code, value
            ->with('notes', $notes) //id, value
            ->with('items', $items)
            ->with('state', ItemState::INCOMES);
    }

    /**
     * @param int $walletId
     * @return View
     * @throws AuthenticationException
     * @throws AuthenticationMVCException
     * @throws BadParameterException
     * @throws UnderEntityNotFoundException
     * @throws NotFoundException
     */
    public function archive($walletId) {
        $this->assumeLogged();
        try {
            $wallet = $this->walletService->getWallet($walletId, $this->member);
        } catch (AuthenticationException $ex) {
            return redirect(route('get.wallets'));
        }
        $filter = (new ItemFilter())->setState(ItemState::CHECKED);

        $wallet = $this->walletService->format($wallet);
        $items = $this->itemService->getWalletItems($walletId, $this->member, $filter);
        $items = $this->itemService->formatEntities($items, $this->member);
        $notes = $this->purposeService->getUserPurposes($this->member);
        $notes = $this->purposeService->formatEntities($notes, $this->member);
        return view('pages.archive')
            ->with('wallet', $wallet)
            ->with('months', DateFormatter::$months) //id, code, value
            ->with('notes', $notes) //id, value
            ->with('items', $items)
            ->with('state', ItemState::CHECKED);
    }
}
