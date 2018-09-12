<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 1. 7. 2018
 * Time: 23:47
 */

namespace App\Http\Controllers;


use App\Model\Enum\ItemState;
use App\Model\Exception\ApplicationException;
use App\Model\Exception\AuthenticationException;
use App\Model\Exception\AuthenticationMVCException;
use App\Model\Exception\BadParameterException;
use App\Model\Exception\BadRequestException;
use App\Model\Exception\IntegrityException;
use App\Model\Exception\NotFoundException;
use App\Model\Exception\UnderEntityNotFoundException;
use App\Model\Filter\ItemFilter;
use App\Model\Help\DateFormatter;
use App\Model\Service\IItemService;
use App\Model\Service\IMemberService;
use App\Model\Service\IPurposeService;
use App\Model\Service\ITranslationService;
use App\Model\Service\IWalletService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Khill\Lavacharts\Lavacharts;

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
     * @param ITranslationService $translationService
     * @param IWalletService $walletService
     * @param IItemService $itemService
     * @param IPurposeService $purposeService
     */
	public function __construct(IMemberService $memberService, ITranslationService $translationService, IWalletService $walletService, IItemService $itemService, IPurposeService $purposeService) {
		parent::__construct($memberService, $translationService);
		$this->walletService = $walletService;
		$this->itemService = $itemService;
		$this->purposeService = $purposeService;
	}

	/**
	 * @return View
	 * @throws AuthenticationMVCException
	 * @throws NotFoundException
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
	 * @throws AuthenticationMVCException
	 * @throws NotFoundException
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
	 * @param Request $request
	 * @return Redirect|View
     * @throws AuthenticationMVCException
     * @throws NotFoundException
     * @throws BadParameterException
	 */
	public function create(Request $request) {
	    $this->assumeLogged();

	    //only form to create
	    if ($request->get('name') === null) {
            return view('pages.addWallet');
        }

		try {
			$wallet = $this->walletService->createWallet($this->member, $request->get('name'));
		} catch (BadParameterException $ex) {
            $message = $this->trans->get($ex->getMessage(), $ex->getDefault());
			return view('pages.addWallet')->with('warning', $ex->bind($message));
		}
		return redirect(route('get.wallet', ['id' => $wallet->getId()]));
	}

	/**
	 * @param Request $request
	 * @param int $id
	 * @return Redirect|View
	 * @throws AuthenticationException
	 * @throws BadParameterException
	 * @throws UnderEntityNotFoundException
	 * @throws NotFoundException
     * @throws BadRequestException
	 */
	public function update(Request $request, $id) {
        $this->assumeLogged();
        $wallet = $this->walletService->getWallet($id, $this->member);
        $wallet = $this->walletService->format($wallet);

        //only form to update
        if ($request->get('name') === null) {
            return view('pages.updateWallet')
                ->with('wallet', $wallet);
        }

		try {
			$this->walletService->updateWallet($this->member, $id, $request->get('name'));
		} catch (BadParameterException $ex) {
            $message = $this->trans->get($ex->getMessage(), $ex->getDefault());
			return view('pages.updateWallet')
				->with('wallet', $wallet)
				->with('warning', $ex->bind($message));
		}
		return redirect(route('get.wallets'));
	}

	/**
	 * @param int $id
	 * @return Redirect
	 * @throws AuthenticationException
	 * @throws BadParameterException
	 * @throws IntegrityException
	 * @throws NotFoundException
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

    /**
     * @param Request $request
     * @param int $id of wallet
     * @return Response
     * @throws AuthenticationException
     * @throws NotFoundException
     * @throws BadParameterException
     */
    public function updateCheckState(Request $request, $id) {
        $this->assumeLogged();
        $type = $request->get('type');
        $value = str_replace(',', '.', $request->get('value'));

        if (empty($type) || empty($value))
            return Response::create('Empty type or value', Response::HTTP_BAD_REQUEST);

        try {
            $this->walletService->updateCheckState($this->member, $id, $type, $value);
        } catch (ApplicationException $ex) {
            $message = $this->trans->get($ex->getMessage(), $ex->getDefault());
            return Response::create($ex->bind($message), Response::HTTP_BAD_REQUEST);
        }
        return Response::create('ok');
    }

    /**
     * @param @param int $id of wallet
     * @return Response
     * @throws AuthenticationException
     * @throws BadParameterException
     * @throws NotFoundException
     */
    public function checkStateStatus($id) {
        $this->assumeLogged();
        $wallet = $this->walletService->getWallet($id, $this->member);
        $wallet = $this->walletService->format($wallet);

        $response = view('jquery.status')
            ->with('wallet', $wallet)
            ->with('member', $this->member);

        return Response::create($response)->header('Content-Type', 'text/html');
    }

    /**
     * @param int $id
     * @return View
     * @throws AuthenticationException
     * @throws NotFoundException
     * @throws BadParameterException
     */
    public function monthlyPreview($id) {
        $this->assumeLogged();

        $purposes = $this->purposeService->getUserPurposes($this->member);
        $purposes = $this->purposeService->formatEntities($purposes, $this->member);
        $wallet = $this->walletService->getWallet($id, $this->member);
        $wallet = $this->walletService->format($wallet);

        return view('pages.monthlyPreview')
            ->with('notes', $purposes)
            ->with('wallet', $wallet);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return Response
     * @throws AuthenticationException
     * @throws NotFoundException
     * @throws BadParameterException
     */
    public function monthlyPreviewData(Request $request, $id) {
        $this->assumeLogged();
        $notes = $request->get('noteId');
        if (strtolower($notes) === 'null')
            $notes = null;
        $statistics = $this->itemService->getMonthStatistics($this->member, $id, $notes);

        $lavaFull = new Lavacharts();
        $table = \Lava::DataTable();
        $table->addStringColumn('Station')
            ->addNumberColumn('asd');
        $table->addRow([
            'asdas',
            45,
        ]);
        $lavaFull->ColumnChart('full', $table, [
            'backgroundColor' => [999],
            'chartArea' => [80],
            'colors' => ['090', '900', '009'],
            'title' => 'title',
            'titlePosition' => 'c',
        ]);


        $lavaPart = new Lavacharts();
        $table2 = \Lava::DataTable();
        $table2->addStringColumn('Station')
            ->addNumberColumn('asd');
        $table2->addRow([
            'asdas',
            45,
        ]);
        $lavaPart->ColumnChart('part', $table2, [
            'backgroundColor' => [999],
            'chartArea' => [80],
            'colors' => ['090', '900', '009'],
            'title' => 'title',
            'titlePosition' => 'c',
        ]);


        return view('jquery.monthlyPreviewData')
            ->with('data', $statistics)
            ->with('partGraph', $lavaPart)
            ->with('fullGraph', $lavaFull);
    }
}
