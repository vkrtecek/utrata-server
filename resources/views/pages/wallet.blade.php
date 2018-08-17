@extends('wallet')
@inject('trans', 'App\Model\Service\ITranslationService')

@section('navigation')
    <div class="container">
        <a href="{{ route('get.wallets') }}">{{ env('APP_NAME', 'Laravel') }}</a> >
        <a href="#">{{ $trans->get('Navigation.Wallet', 'Wallet') }} {{ $wallet['name'] }}</a>
    </div>
@endsection

@section('title', $trans->get('Wallet.H2', 'Wallet') . ' ' . $wallet['name'])

@section('stylesheets')
    <link href="{{ asset('css/wallet.css') }}" rel="stylesheet">
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/wallet.js') }}"></script>
    <script type="text/javascript">
        printItems('{{ route('get.items.wallet', ['id' => $wallet['id']]) }}', '{{ \App\Model\Enum\ItemState::UNCHECKED }}');
    </script>
@endsection

@section('content')
    <div id="wholeWallet">
        <h2>{{ $trans->get('Wallet.H2', 'Wallet:')}} <span id="walletName">{{ mb_strtoupper($wallet['name']) }}</span></h2>

        <div id="itemsWithSearch">
            <p>{{ $trans->get('Uvod.Filtering.OrderBy', 'Order by') }}

            <!-- order by -->
            <select size="1" id="orderBy" onchange="printItems('{{ route('get.items.wallet', ['id' => $wallet['id']]) }}', '{{ \App\Model\Enum\ItemState::UNCHECKED }}')">
                <option value="mainName">{{ $trans->get('Uvod.Filtering.OrderBy.ItemName', 'Name') }}</option>
                <option value="date">{{ $trans->get('Uvod.Filtering.OrderBy.ItemDate', 'Date') }}</option>
                <option value="price">{{ $trans->get('Uvod.Filtering.OrderBy.ItemPrice', 'Price') }}</option>
            </select>

            <!-- order how -->
            <select size="1" id="orderHow" onchange="printItems('{{ route('get.items.wallet', ['id' => $wallet['id']]) }}', '{{ \App\Model\Enum\ItemState::UNCHECKED }}')">
                <option value="ASC">{{ $trans->get('Uvod.Filtering.OrderBy.Asc', 'Ascendant') }}</option>
                <option value="DESC">{{ $trans->get('Uvod.Filtering.OrderBy.Desc', 'Descendant') }}</option>
            </select>
            {{ $trans->get('Uvod.Filtering.AndMonth', 'and select only:') }}

            <!-- month -->
            <select size="1" id="month" onchange="printItems('{{ route('get.items.wallet', ['id' => $wallet['id']]) }}', '{{ \App\Model\Enum\ItemState::UNCHECKED }}')">
                <option value="" >{{ $trans->get('Uvod.Filtering.Month.Default', '--month--') }}</option>
                @foreach($months as $month)
                    <option value="{{ $month['id'] }}">{{ $trans->get($month['code'], $month['value']) }}</option>
                @endforeach
            </select>
            {{ $trans->get('Uvod.Filtering.Or', 'or') }}

            <!-- notes -->
            <select size="1" id="notesList" onclick="resizeNotes()" onchange="printItems('{{ route('get.items.wallet', ['id' => $wallet['id']]) }}', '{{ \App\Model\Enum\ItemState::UNCHECKED }}')" multiple>
                <option value="">{{ $trans->get('Uvod.Filtering.Types.Default', '--note--') }}</option>
                @foreach($notes as $note)
                    <option value="{{ $note['id'] }}">{{ $note['value'] }}</option>
                @endforeach
            </select>

            <!-- year -->
            <label>{{ $trans->get('Uvod.Filtering.Year', 'year:') }}
                <input type="number" id="filterYear" onkeyup="printItems('{{ route('get.items.wallet', ['id' => $wallet['id']]) }}', '{{ \App\Model\Enum\ItemState::UNCHECKED }}')" />
            </label>

            <!-- pattern -->
            <label> {{ $trans->get('Uvod.Filtering.Pattern', 'pattern') }}
                <input type="text" id="filterPattern" onkeyup="printItems('{{ route('get.items.wallet', ['id' => $wallet['id']]) }}', '{{ \App\Model\Enum\ItemState::UNCHECKED }}')" />
                <span title="{{ $trans->get('Uvod.Filtering.HelpTitle') }}" id="questionmark">?</span>
            </label>
            <span id="clear" title="{{ $trans->get('Uvod.Filtering.SetDefaultTitle', 'default filtering') }}" onclick="clearSearch()">×</span></p>
            <hr />






            <div id="items">
                <!-- loading ... waiting for response -->
                <span title="loading" id="loading"></span>
            </div>


            <!-- no items found -->
            @if(count($items) == 0)
                <div>
                    {{ $trans->get('PrintItems.NoResults', 'No items found') }}
                </div>
            @endif
        </div>
    </div>
@endsection