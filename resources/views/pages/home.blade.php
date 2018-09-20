@extends('base')
@inject('trans', 'App\Model\Service\ITranslationService')

@section('stylesheets')
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
@endsection

@section('title', $trans->get('Menu.Home', 'Dashboard'))

@section('scripts')
    <script type="text/javascript">
        function downloadFile(content) {
            var a = document.createElement('a');
            a.href = 'data:attachment/csv,' + encodeURIComponent(content);
            a.target = '_blank';
            a.download = '{{ Auth::user()->getLogin() }}' + '.csv';
            document.body.appendChild(a);
            a.click();
        }
        @if(isset($backupFile))
            downloadFile('{{ $backupFile }}');
        @endif
    </script>
@endsection

@section('content')
    <h1>{{ $trans->get('Dashboard.Heading', 'List of wallets') }}</h1>
    <div class="panel-body">

        <div id="content">
            <div class="grid grid-pad">
                @foreach($wallets as $wallet)
                    <a class="col-1-4" href="{{ route('get.wallet', ['id' => $wallet['id']]) }}">
                        <div class="wallet">
                            @if($wallet['empty'])
                                <div class="deleteWalletBtn" title="{{ $trans->get('Wallet.DeleteBtn.Title', 'Delete wallet') }}"
                                   onclick="event.preventDefault(); document.getElementById('deleteWallet_{{ $wallet['id'] }}').submit()">&times;</div>
                                <form method="POST" action="{{ route('delete.wallet', ['id' => $wallet['id']]) }}" id="deleteWallet_{{ $wallet['id'] }}" style="display:none;">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="delete">
                                </form>
                            @endif

                            <div class="updateWalletBtn" title="{{ $trans->get('Wallet.UpdateBtn.Title', 'Update wallet') }}"
                                onclick="event.preventDefault(); document.getElementById('updateWallet_{{ $wallet['id'] }}').submit()">i</div>
                            <form method="POST" action="{{ route('get.wallet.update', ['id' => $wallet['id']]) }}" id="updateWallet_{{ $wallet['id'] }}" style="display: none;">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="get">
                            </form>


                            <h4>{{ mb_strtoupper( $wallet['name'] ) }}</h4>
                            <table class="walletPreview">
                                <tr>
                                    <td>{{ $trans->get('Wallet.Preview.Items', 'Items:') }}</td>
                                    <td>{{ $wallet['activeItemsCnt'] }}/{{$wallet['nonActiveItemsCnt'] }} ({{ $wallet['incomeItemsCnt'] }})</td></tr>
                                <tr>
                                    <td>{{ $trans->get('Wallet.Preview.Card', 'On card: ') }}</td>
                                    <td class="{{ \App\Http\Controllers\WalletController::getClassForPrice($wallet['cardRest']) }}">{{ number_format($wallet['cardRest'], 2, ',', ' ') }} {{ Auth::user()->getCurrency()->getValue() }}</td>
                                </tr>
                                <tr>
                                    <td>{{ $trans->get('Wallet.Preview.Cash', 'In cash:') }}</td>
                                    <td class="{{ \App\Http\Controllers\WalletController::getClassForPrice($wallet['cashRest']) }}">{{ number_format($wallet['cashRest'], 2, ',', ' ') }} {{ Auth::user()->getCurrency()->getValue() }}</td>
                                </tr>
                                <tr>
                                    <td>{{ $trans->get('Wallet.Preview.PerMonth', 'This month:') }}</td>
                                    <td class="{{ \App\Http\Controllers\WalletController::getClassForPrice($wallet['monthExpense']) }}">{{ number_format($wallet['monthExpense'], 2, ',', ' ') }} {{ Auth::user()->getCurrency()->getValue() }}</td>

                                </tr>
                            </table>
                        </div>
                    </a>
                @endforeach
                <a class="col-1-4" href="{{ route('get.wallet.add') }}">
                    <div id="addWallet" class="wallet" title="{{ $trans->get('Dashboard.AddWallet', 'Add wallet') }}"><span class="plus">+</span></div>
                </a>
            </div>
        </div>
    </div>
@endsection
