@inject('trans', 'App\Model\Service\ITranslationService')
@inject('dateFormatter', 'App\Model\Help\DateFormatter')
@inject('purposeService', 'App\Model\Service\IPurposeService')
@inject('currencyService', 'App\Model\Service\ICurrencyService')
@inject('walletService', 'App\Model\Service\IWalletService')

<div id="buttons">
	<button onclick="stornoUpdating(' {{ route('get.items.wallet', ['id' => $item['wallet']]) }} ', ' {{ App\Model\Enum\ItemState::UNCHECKED }} ')" class="updateButtonStorno"></button>
	<button onclick="acceptUpdating(' {{ route('put.item') }} ', ' {{ route('get.items.wallet', ['id' => $item['wallet']]) }} ', ' {{ App\Model\Enum\ItemState::UNCHECKED }} ')" class="updateButtonSave"></button>
</div>

<table rules="none">
	<tr>
		<input type="hidden" id="_id" value="{{ $item['id'] }}" />
		<td class="name red">
			<input type="text" id="_name" value="{{ $item['name'] }}" autofocus />
			</td>
		<td class="description">
			<textarea id="_description">{{ $item['description'] }}</textarea>
			</td>
		<td class="note">
			<select id="_note">
				@foreach ($purposeService->getUserPurposes(Auth::user()) as $purpose)
					<option value="{{ $purpose->getId() }}" {{ ($purpose->getId() == $item['note']['id'] ? 'selected' : '') }}>{{ $purpose->getValue() }}</option>
				@endforeach
			</select>
			</td>
		<td class="type">
			<select id="_type">
				<option value="karta" {{ ('karta' == $item['type'] ? 'selected' : '') }}>{{ $trans->get('PrintItems.PayedBy.Card', 'Card') }}</option>
				<option value="hotovost" {{ ('hotovost' == $item['type'] ? 'selected' : '') }}>{{ $trans->get('PrintItems.PayedBy.Cash', 'Cash') }}</option>
				</select>
			</td>
		<td class="price">
			<input type="number" id="_price" value="{{ $item['price'] }}" />
			<select id="_currency">
				@foreach ($currencyService->getCurrencies() as $currency)
					<option value="{{ $currency->getCode() }}" {{ ($currency->getId() == $item['currency']['id'] ? 'selected' : '') }}>{{ $currency->getValue() }}</option>
				@endforeach
			</select>
			{{ $trans->get('UpdateItem.Form.Course', 'course') }}
			<input type="number" id="_course" value="{{ $item['course'] }}" />
		</td>
	</tr>
</table>
<p>
	<input type="datetime-local" id="_date" value="{{ $dateFormatter->dateToInputFormat($item['date']) }}" />
	 | {{ $trans->get('UpdateItem.Form.ChangeWallet', 'Wallet: ') }}
	<select id="_wallet">
		@foreach ($walletService->getWallets(Auth::user()->getLogin()) as $wallet)
			<option value="{{ $wallet->getId() }}" {{ ($wallet->getId() == $item['wallet'] ? 'selected' : '') }}>{{ $wallet->getName() }}</option>
		@endforeach
	</select>
</p>