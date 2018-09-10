@inject('trans', 'App\Model\Service\ITranslationService')

@if($state == \App\Model\Enum\ItemState::UNCHECKED && $price)
    <button
        title="{{ $trans->get('ShowItems.CheckAll.Title') }}"
        class="move_items"
        onclick="updateAllItems('{{ route('put.items.check', ['id' => $walletId]) }}', '{{ route('get.items.wallet', ['id' => $walletId]) }}', '{{ App\Model\Enum\ItemState::UNCHECKED }}', '{{$trans->get('PrintItems.MoveAllToArchive', 'Do you really want to move this items to archive?')}}')">
        <b>&#10004;</b>
    </button>
@endif

<div class="container">
    {!! $table->renderHTML([
        'css' => true,
        'translations' => [
            'of' => $trans->get('PrintItems.table.of', 'of'),
        ]
    ]) !!}

    @if ($price)
        <strong class="price">
            {{ number_format($price, 2, ',', ' ') . ' ' . $currency }}
        </strong>
    @endif
</div>

<style type="text/css">
    strong.price {
        display: inline-block;
        text-align: right;
        margin-left: -255px;
    }
</style>
