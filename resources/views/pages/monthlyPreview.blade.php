@extends('wallet')
@inject('trans', 'App\Model\Service\ITranslationService')

@section('navigation')
    <div class="container">
        <a href="{{ route('get.wallets') }}">{{ env('APP_NAME', 'Laravel') }}</a> &gt;
        <a href="{{ route('get.wallet', ['id' => $wallet['id']]) }}">{{ $trans->get('Navigation.Wallet', 'Wallet') }} {{ $wallet['name'] }}</a> &gt;
        <a href="#">{{ $trans->get('Navigation.Statistics', 'Monthly preview') }}</a>
    </div>
@endsection

@section('title', $trans->get('Statistics.H1', 'Monthly preview of wallet') . ' ' . $wallet['name'])

@section('stylesheets')
    <link href="{{ asset('css/statistics.css') }}" rel="stylesheet">
@endsection

@section('preScripts')
    <script type="text/javascript" src="{{ asset('js/statistics.js') }}"></script>
@endsection

@section('scripts')
    <script type="text/javascript">
        printStatistics('{{ route('get.monthlyPreviewData', ['id' => $wallet['id']]) }}', 'statistics');
    </script>
@endsection

@section('content')
    <div class="container">
        <div id="introduction">
            <p>{{ $trans->get('Statistics.Description', 'Here you can look at the statistics as of the month you are due to the previous months. Choose if you want to review a specific note orr everything.') }}</p>

            <label for="notesList">{{ $trans->get('Statistics.Filtering.NotesLabel', 'Statistic for specific note:') }}</label>
            <select size="5" id="notesList" onchange="printStatistics('{{ route('get.monthlyPreviewData', ['id' => $wallet['id']]) }}', 'statistics')" multiple>
                <option value="" selected>{{ $trans->get('Statistics.Filtering.Types.Default', '--note--') }}</option>
                @foreach ($notes as $note)
                    <option value="{{ $note['id'] }}">{{ $note['value'] }}</option>
                @endforeach
            </select>
        </div>

        <div id="statistics"><span id="statistics-loading"></span></div>
    </div>
@endsection
