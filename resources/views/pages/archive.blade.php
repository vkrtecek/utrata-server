@extends('wallet')
@inject('trans', 'App\Model\Service\ITranslationService')

@section('navigation')
    <div class="container">
        <a href="{{ route('get.wallets') }}">{{ env('APP_NAME', 'Laravel') }}</a> &gt;
        <a href="{{ route('get.wallet', ['id' => $wallet['id']]) }}">{{ $trans->get('Navigation.Wallet', 'Wallet') }} {{ $wallet['name'] }}</a> &gt;
        <a href="#">{{ $trans->get('Navigation.Wallet.Archive', 'Archive') }}</a>
    </div>
@endsection

@section('title', $trans->get('Wallet.Archive.H2', 'Archive') . ' ' . $wallet['name'])

@section('stylesheets')
    <link href="{{ asset('css/wallet.css') }}" rel="stylesheet">
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/wallet.js') }}"></script>
    <script type="text/javascript">
        printItems('{{ route('get.items.wallet', ['id' => $wallet['id']]) }}', '{{ \App\Model\Enum\ItemState::CHECKED }}');
    </script>
@endsection

@section('content')
    <div id="wholeWallet">
        <h2>{{ $trans->get('Wallet.Archive.H2', 'Archive')}}: <span id="walletName">{{ mb_strtoupper($wallet['name']) }}</span></h2>

        <div id="itemsWithSearch">
            @include('inc.navigation')






            <div id="items">
                <!-- loading ... waiting for response -->
                <span title="loading" id="loading"></span>
            </div>
        </div>
    </div>
@endsection
