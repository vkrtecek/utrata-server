@inject('trans', 'App\Model\Service\ITranslationService')
@inject('dateFormatter', 'App\Model\Help\DateFormatter')


<!-- head of items -->
@if(count($items))
<strong>
    @if($state == \App\Model\Enum\ItemState::UNCHECKED && count($items))
    <button
            title="{{ $trans->get('ShowItems.CheckAll.Title') }}"
            class="move_item"
            onclick="updateAllItems('{{ route('put.items.check', ['id' => $items[0]['wallet']]) }}', '{{ route('get.items.wallet', ['id' => $items[0]['wallet']]) }}', '{{ App\Model\Enum\ItemState::UNCHECKED }}', '{{$trans->get('PrintItems.MoveAllToArchive', 'Do you really want to move this items to archive?')}}')">
        <b>&#10004;</b>
    </button>
    @endif

    <table rules="none" id="headOfTableContent">
        <tr>
            <td class="name">{{ $trans->get('PrintItems.Name', 'Item name') }}</td>
            <td class="description">{{ $trans->get('PrintItems.Description', 'Description') }}</td>
            <td class="note">{{ $trans->get('PrintItems.Note', 'Note') }}</td>
            <td class="type">{{ $trans->get('PrintItems.Type', 'Type') }}</td>
            <td class="price">{{ $trans->get('PrintItems.Price', 'Price') }}</td>
            </tr>
        </table>
    </strong>
@endif


<!-- items -->
@if(isset($items))
<div>
    @foreach($items as $item)
    <div id="itemDiv_{{ $item['id'] }}" class="item{{ (!$item['active'] ? ' old' : $item['odepsat'] ? ' odepsat' : '') }}">
        <div class="buttons">
            <button title="{{ $trans->get('PrintItems.DeleteItemTitle', 'Delete') }}" class="delete_item"
                             onclick="deleteItem('{{ $item['id'] }}', '{{ route('delete.item', ['id' => $item['id']]) }}', '{{$trans->get('PrintItems.DeleteItem.Confirm', 'Do you really want to delete this item?')}}')"><b>&times;</b></button>
            @if($state == \App\Model\Enum\ItemState::UNCHECKED)
            <button title="{{ $trans->get('PrintItems.CheckedItemTitle', 'Move to archive') }}" class="move_item"
                             onclick="updateItemRead('{{ $item['id'] }}', '{{ route('put.item.check', ['id' => $item['id']]) }}')"><b>&#10004;</b></button>
            <button title="{{ $trans->get('PrintItems.UpdateItemTitle', 'Update') }}" class="updateItem"
                             onclick="updateItemMakeForm('{{ $item['id'] }}', '{{ route('get.item.HTML', ['id' => $item['id']]) }}')"></button>
            @endif
            </div>

        <table rules="none">
            <tr>
                <td class="name red">
                    <h2>{{ $item['name'] }}</h2>
                    </td>
                <td class="description">
                    {{ $item['description'] }}
                    </td>
                <td class="note">
                    <em>{{ $item['note']['value'] }}</em>
                    </td>
                <td class="type">
                    {{ $item['type'] }}
                    </td>
                <td class="price">
                    <strong>{{ number_format($item['price'] * $item['course'], 2, ',', ' ') }} {{ Auth::user()->getCurrency()->getValue() }}</strong>
                    </td>
                </tr>
            </table>
        <p><strong>{{ $dateFormatter->dateToReadableFormat($item['date']) }}</strong></p>
        </div>
    @endforeach

    <!-- suma under items -->
    @if(count($items))
    <table rules="none" id="sumUnderItems">
        <tr>
            <td class="name">
                {{ $trans->get('PrintItems.TotalItemsSize', 'Total items:') . ' ' . count($items) }}
            </td>
            <td class="description"></td>
            <td class="note"></td>
            <td class="type"></td>
            <td class="price">
                {{ $trans->get('PrintItems.TotalItemsPrice', 'SUM:') . ' ' . number_format(\App\Model\Service\ItemService::getItemsPrice($items), 2, ',', ' ') . ' ' .  Auth::user()->getCurrency()->getValue() }}
            </td>
            </tr>
        </table>
    @endif
    </div>
@endif
