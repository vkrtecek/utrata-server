<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 7. 7. 2018
 * Time: 18:47
 */

namespace App\Http\Controllers;


use App\Model\Enum\ItemState;
use App\Model\Help\DateFormatter;
use App\Model\Service\ICurrencyService;
use App\Model\Service\IItemService;
use App\Model\Service\IMemberService;
use App\Model\Service\IPurposeService;
use App\Model\Service\ItemService;
use App\Model\Service\ITranslationService;
use App\Model\Service\IWalletService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

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
	 * @param int $id
	 * @return View
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
	 */
	public function check($id) {
		$this->assumeLogged();
		$member = $this->loggedMember();
		$this->itemService->checkItem($member, $id);
	}

	/**
	 * @param int $id
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
		$res = '<!-- head of items -->';
		if(count($items)) {
			$res .= '<strong>';
			if($state == ItemState::UNCHECKED) {
				$res .= '<button
							title="' . $this->translationService->get('ShowItems.CheckAll.Title') . '"
							class="move_item"
							onclick="updateAllItems()">
						<b>&#10004;</b>
					</button>';
			}

				$res .= '<table rules="none" id="headOfTableContent">';
					$res .= '<tr>';
            			$res .= '<td class="name">' . $this->translationService->get('PrintItems.Name', 'Item name') . '</td>';
						$res .= '<td class="description">' . $this->translationService->get('PrintItems.Description', 'Description') . '</td>';
            			$res .= '<td class="note">' . $this->translationService->get('PrintItems.Note', 'Note') . '</td>';
						$res .= '<td class="type">' . $this->translationService->get('PrintItems.Type', 'Type') . '</td>';
            			$res .= '<td class="price">' . $this->translationService->get('PrintItems.Price', 'Price') . '</td>';
					$res .= '</tr>';
            	$res .= '</table>';
			$res .= '</strong>';
		}


		$res .= '<!-- items -->';
        if(isset($items)) {
			$res .= '<div>';
			foreach($items as $item) {
				$res .= '<div id="itemDiv_' . $item['id'] . '" class="item' . (!$item['active'] ? ' old' : $item['odepsat'] ? ' odepsat' : '') . '">';
				$res .= '<div class="buttons">';
					$res .= '<button title="' . $this->translationService->get('PrintItems.DeleteItemTitle', 'Delete') . '" class="delete_item"
									onclick="deleteItem(\'' . $item['id'] . '\', \'' . route('delete.item', ['id' => $item['id']]) . '\')"><b>&times;</b></button>';
					if($state == ItemState::UNCHECKED) {
						$res .= '<button title="' . $this->translationService->get('PrintItems.CheckedItemTitle', 'Move to archive') . '" class="move_item"
								onclick="updateItemRead(\'' . $item['id'] . '\', \'' . route('put.item.check', ['id' => $item['id']]) . '\')"><b>&#10004;</b></button>';
						$res .= '<button title="' . $this->translationService->get('PrintItems.UpdateItemTitle', 'Update') . '" class="updateItem"
								onclick="updateItemMakeForm(' . $item['id'] . ', \'' . route('get.item.HTML', ['id' => $item['id']]) . '\')"></button>';
						/*$res .= '<form method="POST" action="' . route('get.item.update', ['id' => $item['id']]) . '">';
							$res .= csrf_field();
							$res .= '<input type="hidden" name="_method" value="get">';
							$res .= '<button title="' . $this->translationService->get('PrintItems.UpdateItemTitle') . '" class="updateItem" onclick="updateItemMakeForm(' . $item['id'] . ')"></button>';
						$res .= '</form>';*/
					}
				$res .= '</div>';

					$res .= '<table rules="none">';
						$res .= '<tr>';
							$res .= '<td class="name red">';
								$res .= '<h2>' . $item['name'] . '</h2>';
							$res .= '</td>';
							$res .= '<td class="description">';
								$res .= $item['description'];
							$res .= '</td>';
							$res .= '<td class="note">';
								$res .= '<em>' . $item['note']['value'] . '</em>';
							$res .= '</td>';
							$res .= '<td class="type">';
								$res .= $item['type'];
							$res .= '</td>';
							$res .= '<td class="price">';
								$res .= '<strong>' . $item['price'] * $item['course'] . ' ' . Auth::user()->getCurrency()->getValue() . '</strong>';
							$res .= '</td>';
						$res .= '</tr>';
					$res .= '</table>';
					$res .= '<p><strong>' . $this->dateFormatter->dateToReadableFormat($item['date']) . '</strong></p>';
				$res .= '</div>';
			}

			$res .= '<!-- suma under items -->';
			if(count($items)) {
				$res .= '<table rules="none" id="sumUnderItems">';
					$res .= '<tr>';
						$res .= '<td class="name">';
							$res .=  $this->translationService->get('PrintItems.TotalItemsSize', 'Total items:') . ' ' . count($items);
						$res .= '</td>';
						$res .= '<td class="description"></td>';
						$res .= '<td class="note"></td>';
						$res .= '<td class="type"></td>';
						$res .= '<td class="price">';
							$res .= $this->translationService->get('PrintItems.TotalItemsPrice', 'SUM:') . ' ' . ItemService::getItemsPrice($items) . ' ' .  Auth::user()->getCurrency()->getCode();
						$res .= '</td>';
					$res .= '</tr>';
				$res .= '</table>';
			}
			$res .= '</div>';
		}
		return $res;
	}

	/**
	 * @param array $item
	 * @return string
	 */
	private function makeHTML($item) {
		$res = '<div id="buttons">';
			$res .= '<button onclick="stornoUpdating(\'' . route('get.items.wallet', ['id' => $item['wallet']]) . '\', \'' . ItemState::UNCHECKED . '\')" class="updateButtonStorno"></button>';
			$res .= '<button onclick="acceptUpdating(\'' . route('put.item') . '\', \'' . route('get.items.wallet', ['id' => $item['wallet']]) . '\', \'' . ItemState::UNCHECKED . '\')" class="updateButtonSave"></button>';
		$res .= '</div>';

		$res .= '<table rules="none">';
			$res .= '<tr>';
				$res .= '<input type="hidden" id="_id" value="' . $item['id'] . '" />';
				$res .= '<td class="name red">';
					$res .= '<input type="text" id="_name" value="' . $item['name'] . '" autofocus />';
				$res .= '</td>';
				$res .= '<td class="description">';
					$res .= '<textarea id="_description">' . $item['description'] . '</textarea>';
				$res .= '</td>';
				$res .= '<td class="note">';
					$res .= '<select id="_note">';
						foreach ($this->purposeService->getUserPurposes(Auth::user()) as $purpose) {
							$res .= '<option value="' . $purpose->getId() . '" ' . ($purpose->getId() == $item['note']['id'] ? 'selected' : '') . '>' . $purpose->getValue() . '</option>';
						}
					$res .= '</select>';
				$res .= '</td>';
				$res .= '<td class="type">';
					$res .= '<select id="_type">';
						$res .= '<option value="karta" ' . ('karta' == $item['type'] ? 'selected' : '') . '>' . $this->translationService->get('PrintItems.PayedBy.Card', 'Card') . '</option>';
						$res .= '<option value="hotovost" ' . ('hotovost' == $item['type'] ? 'selected' : '') . '>' . $this->translationService->get('PrintItems.PayedBy.Cash', 'Cash') . '</option>';
					$res .= '</select>';
				$res .= '</td>';
				$res .= '<td class="price">';
					$res .= '<input type="number" id="_price" value="' . $item['price'] . '" />';
					$res .= '<select id="_currency">';
						foreach ($this->currencyService->getCurrencies() as $currency) {
							$res .= '<option value="' . $currency->getCode() . '" ' . ($currency->getId() == $item['currency']['id'] ? 'selected' : '') . '>' . $currency->getValue() . '</option>';
						}
						$res .= '</select>';
						$res .= $this->translationService->get('UpdateItem.Form.Course', 'course');
						$res .= '<input type="number" id="_course" value="' . $item['course'] . '" />';
					$res .= '</select>';
				$res .= '</td>';
			$res .= '</tr>';
		$res .= '</table>';
		$res .= '<p>';
			$res .= '<input type="datetime-local" id="_date" value="' . $this->dateFormatter->dateToInputFormat($item['date']) . '" />';
			$res .= ' | ' . $this->translationService->get('UpdateItem.Form.ChangeWallet', 'Wallet: ');
			$res .= '<select id="_wallet">';
				foreach ($this->walletService->getWallets(Auth::user()->getLogin()) as $wallet) {
					$res .= '<option value="' . $wallet->getId() . '" ' . ($wallet->getId() == $item['wallet'] ? 'selected' : '') . '>' . $wallet->getName() . '</option>';
				}
			$res .= '</select>';
		$res .= '</p>';

		return $res;
	}
}
