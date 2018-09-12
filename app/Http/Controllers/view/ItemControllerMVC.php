<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 7. 7. 2018
 * Time: 18:47
 */

namespace App\Http\Controllers;


use App\Http\Pagination;
use App\Model\Entity\Item;
use App\Model\Enum\ItemState;
use App\Model\Exception\ApplicationException;
use App\Model\Exception\AuthenticationException;
use App\Model\Exception\AuthenticationMVCException;
use App\Model\Exception\BadParameterException;
use App\Model\Exception\IntegrityException;
use App\Model\Exception\NotFoundException;
use App\Model\Filter\ItemFilter;
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
use Vkrtecek\Table\Table;

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
		parent::__construct($memberService, $translationService);
		$this->itemService = $itemService;
		$this->currencyService = $currencyService;
		$this->purposeService = $purposeService;
		$this->walletService = $walletService;
		$this->dateFormatter = $dateFormatter;
	}

	/**
	 * @param int $id
	 * @return Response
	 * @throws AuthenticationMVCException
     * @throws NotFoundException
     * @throws BadParameterException
	 */
	public function getHTML($id) {
		$this->assumeLogged();
		try {
			$item = $this->itemService->getItem($id);
		} catch (ApplicationException $ex) {
            $message = $this->trans->get($ex->getMessage(), $ex->getDefault());
			return Response::create(['error' => $ex->bind($message)], Response::HTTP_BAD_REQUEST);
		}
		$item = $this->itemService->format($item, $this->member);
		$item = $this->makeHTML($item);
		return Response::create($item)->header('Content-Type', 'text/html');
	}

	/**
	 * @param Request $request
	 * @param int $walletId
	 * @return Response
	 * @throws AuthenticationException
     * @throws BadParameterException
     * @throws NotFoundException
	 */
	public function getWalletItems(Request $request, $walletId) {
		$this->assumeLogged();
		try {
            $filter = Pagination::create($request, 'Item');
            $filter->setWalletId($walletId)->setMember($this->member);
            $items = $this->itemService->getWalletItems($walletId, $this->member, $filter);
		} catch (ApplicationException $ex) {
            $message = $this->trans->get($ex->getMessage(), $ex->getDefault());
			return Response::create(['error' => $ex->bind($message)], Response::HTTP_BAD_REQUEST);
		}

		$response = $this->makeHTMLs($items, $request->get('state'), $walletId);
		return Response::create($response)->header('Content-Type', 'text/html');
	}

	/**
	 * @param Request $request
     * @param int $walletId
	 * @return \Illuminate\Routing\Redirector
	 * @throws AuthenticationException
	 * @throws AuthenticationMVCException
	 * @throws BadParameterException
	 * @throws NotFoundException
	 * @throws \App\Model\Exception\UnderEntityNotFoundException
	 */
	public function create(Request $request, $walletId) {
		$this->assumeLogged();

		//only form to add
		if ($request->get('walletId') === null) {
            $wallet = $this->walletService->getWallet($walletId, $this->member);
            $wallet = $this->walletService->format($wallet);
            return view('pages.addItem')
                ->with('wallet', $wallet);
        }

		$data = $request->all();
        $data['vyber'] = $request->get('vyber') === 'on';
        $data['odepsat'] = $request->get('odepsat') === 'on';
		$data['member'] = $this->member->getLogin();
		$data['currency']['code'] = $request->get('currencyId');
        $data['note']['id'] = $request->get('noteId');
        $data['wallet'] = $request->get('walletId');
		try {
			$this->itemService->createItem($this->member, $data);
		} catch (ApplicationException $e) {
			$wallet = $this->walletService->getWallet($request->get('walletId'), $this->member);
			$wallet = $this->walletService->format($wallet);
			$message = $this->trans->get($e->getMessage(), $e->getDefault());
			return view('pages.addItem')
				->with('wallet', $wallet)
				->with('message', $e->bind($message));
		}
		return redirect(route('get.wallet', ['id' => $request->get('walletId')]));
	}

    /**
     * @param Request $request
     * @param int $walletId
     * @return View
     * @throws AuthenticationException
     * @throws AuthenticationMVCException
     * @throws BadParameterException
     * @throws NotFoundException
     */
    public function createIncome(Request $request, int $walletId) {
        $this->assumeLogged();
        $wallet = $this->walletService->getWallet($walletId, $this->member);
        $wallet = $this->walletService->format($wallet);
        //only form to add
        if ($request->get('walletId') === null) {
            return view('pages.addIncome')
                ->with('wallet', $wallet);
        }
        //request to add income
        try {
            $data = $request->all();
            $data['member'] = $this->member->getLogin();
            $data['currency']['code'] = $request->get('currencyId');
            $data['wallet'] = $request->get('walletId');
            $this->itemService->createItem($this->member, $data);
        } catch (ApplicationException $ex) {
            $message = $this->trans->get($ex->getMessage(), $ex->getDefault());
            return view('pages.addIncome')
                ->with('wallet', $wallet)
                ->with('message', $ex->bind($message));
        }

        return redirect(route('get.wallet.incomes', ['id' => $wallet['id']]));
    }

	/**
	 * @param Request $request
     * @param int $id of item
	 * @return Response
	 * @throws AuthenticationMVCException
     * @throws NotFoundException
     * @throws BadParameterException
	 */
	public function update(Request $request, $id) {
		$this->assumeLogged();
        $item = $this->itemService->getItem($id);
        $wallet = $item->getWallet();
        $wallet = $this->walletService->format($wallet);
        $item = $this->itemService->format($item, $this->member);
        $currencies = $this->currencyService->getCurrencies();
        $currencies = $this->currencyService->formatEntities($currencies);
        $purposes = $this->purposeService->getUserPurposes($this->member);
        $purposes = $this->purposeService->formatEntities($purposes, $this->member);
        $wallets = $this->walletService->getWallets($this->member->getLogin());
        $wallets = $this->walletService->formatEntities($wallets);

        //only form to update
        if ($request->get('id') === null) {
            return view('pages.updateItem')
                ->with('item', $item)
                ->with('wallet', $wallet)
                ->with('currencies', $currencies)
                ->with('notes', $purposes)
                ->with('wallets', $wallets)
                ->with('previousURL', url()->previous());
        }

		$data = $request->all();
        $data['vyber'] = $request->get('vyber') === 'on';
        $data['odepsat'] = $request->get('odepsat') === 'on';
        $data['member'] = $this->member->getLogin();
        //$data['currency']['code'] = $request->get('currencyId');
        $data['note']['id'] = $request->get('noteId');
        $data['wallet'] = $request->get('walletId');
		try {
			$this->itemService->updateItem($this->member, $request->get('id'), $data);
		} catch (ApplicationException $ex) {
            $message = $this->trans->get($ex->getMessage(), $ex->getDefault());
            return view('pages.updateItem')
                ->with('item', $item)
                ->with('currencies', $currencies)
                ->with('notes', $purposes)
                ->with('wallets', $wallets)
                ->with('previousURL', url()->previous())
                ->with('message', $ex->bind($message));
		}
		return redirect($request->get('previousURL'));
	}

	/**
	 * @param int $id
	 * @throws AuthenticationMVCException
	 * @throws AuthenticationException
	 * @throws BadParameterException
	 * @throws NotFoundException
	 */
	public function check($id) {
		$this->assumeLogged();
		$member = $this->loggedMember();
		$this->itemService->checkItem($member, $id);
	}

    /**
     * @param Request $request
     * @param int $walletId
     * @throws AuthenticationException
     * @throws AuthenticationMVCException
     * @throws BadParameterException
     * @throws NotFoundException
     */
	public function checkAll(Request $request, $walletId) {
	    $this->assumeLogged();
        try {
            $filter = Pagination::create($request, 'Item');
            $filter->setWalletId($walletId)->setMember($this->member);
            $items = $this->itemService->getWalletItems($walletId, $this->member, $filter);
        } catch (ApplicationException $ex) {
            // do nothing
            return;
        }
        foreach ($items as $item)
            $this->check($item->getId());
    }

	/**
	 * @param int $id
	 * @throws AuthenticationMVCException
	 * @throws BadParameterException
	 * @throws IntegrityException
	 * @throws NotFoundException
	 */
	public function delete($id) {
		$this->assumeLogged();
		$this->itemService->deleteItem($this->member, $id);
	}


	/**
	 * @param Item[] $items
	 * @param int $state
     * @param int $walletID
	 * @return string
     * @throws NotFoundException
     * @throws BadParameterException
     * @throws AuthenticationException
	 */
	private function makeHTMLs(array $items, int $state, int $walletID): string {
        $table = Table::create($items, env('FILTERING_LIST_LIMIT', 15), true);
        $table->addColumn($this->trans->get('PrintItems.Name', 'Item name'), 'mainName')->setContent('name');
        $table->addColumn($this->trans->get('PrintItems.Description', 'Description'))->setContent('description');
        if ($state !== ItemState::INCOMES)
            $table->addColumn($this->trans->get('PrintItems.Note', 'Note'))->setContent(function (Item $item) {
                return $item->getNote()->getValue();
            });
        $table->addColumn($this->trans->get('PrintItems.Type', 'Type'))->setContent('type');
        $table->addColumn($this->trans->get('PrintItems.Date', 'Date'), 'date')->setContent(function (Item $item) {
            return strftime(env('DATETIME_FORMAT',"%e. %b %y, %H:%M"), $item->getDate()->getTimestamp());
        });
        $table->addColumn($this->trans->get('PrintItems.Price', 'Price'), 'price')->setContent(function (Item $item) {
            return '<strong>' . number_format($item->getPrice() * $item->getCourse(), 2, ',', ' ') .
                ' ' . $this->member->getCurrency()->getValue() . '</strong>';
        });
        $table->addColumn($this->trans->get('PrintItems.Actions', 'Actions'))->setClass('actions_col')->setContent(function (Item $item) use ($state) {
            $str = '<span title="' . $this->trans->get('PrintItems.DeleteItemTitle', 'Delete') . '" class="delete_item"' .
                ' onclick="deleteItem(\'' . $item->getId() . '\', \'' . route('delete.item', ['id' => $item->getId()]) . '\', \'' . $this->trans->get('PrintItems.DeleteItem.Confirm', 'Do you really want to delete this item?') . '\', \'' . route('get.items.wallet', ['id' => $item->getWallet()->getId()]) . '\', \'' . $state . '\')"><b>&times;</b></span>';
            if ($state == ItemState::UNCHECKED) {
                $str .= '<span title="' . $this->trans->get('PrintItems.CheckedItemTitle', 'Move to archive') . '" class="move_item"' .
                    ' onclick="updateItemRead(\'' . $item->getId() . '\', \'' . route('put.item.check', ['id' => $item->getId()]) . '\', \'' . route('get.items.wallet', ['id' => $item->getWallet()->getId()]) . '\', \'' . $state . '\')"><b>&#10004;</b></span>';
            }
            if ($state !== ItemState::CHECKED) {
                $str .= '<a href="' . route('get.item.update', ['itemId' => $item->getId()]) . '">' .
                        '<span title="' . $this->trans->get('PrintItems.UpdateItemTitle') . '" class="updateItem"></span>' .
                    '</a>';
            }
            return $str;
        });

        $url = $state === ItemState::INCOMES
            ? 'get.wallet.incomes'
            : $state === ItemState::CHECKED
                ? 'get.wallet.archive'
                : 'get.wallet';
        $filter = (new ItemFilter())->setLimit(PHP_INT_MAX)->setState($state)->setWalletId($walletID)->setMember($this->member);
        $table->setTotalItemCount($this->itemService->count($filter))->setNavigationNames([
            'url' => route($url, ['id' => $walletID]),
            'orderBy' => 'orderBy',
            'order' => 'orderHow',
        ]);

        $price = $this->itemService->priceByFilter($this->member, $filter);

	    return view('jquery.itemsTable')
            ->with('table', $table)
            ->with('price', $price)
            ->with('state', $state)
            ->with('walletId', $walletID)
            ->with('currency', $this->member->getCurrency()->getValue());
	}

	/**
	 * @param array $item
	 * @return string
	 */
	private function makeHTML($item) {
		return view('jquery.item')->with('item', $item);
	}
}
