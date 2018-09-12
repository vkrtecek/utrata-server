@extends('base')
@inject('trans', 'App\Model\Service\ITranslationService')

@section('title', $trans->get('Import.Title', 'Import backup'))

@section('stylesheets')
    <link href="{{ asset('css/loadBackup.css') }}" rel="stylesheet">
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/backup.js') }}"></script>
@endsection

@section('navigation')
    <div class="container">
        <a href="{{ route('get.wallets') }}">{{ env('APP_NAME', 'Laravel') }}</a> &gt;
        <a href="#">{{ $trans->get('Import.Title', 'Import backup') }}</a>
    </div>
@endsection

@section('content')
    <div class="container">
        <div id="import">
            <h3>{{ $trans->get('Import.Title', 'Import backup') }}</h3>
            <p>{{ $trans->get('Import.Description', 'Insert CSV file') }}</p>
            <div id="form">
                <form method="POST" action="{{ route('post.import') }}" enctype="multipart/form-data" onsubmit="return checkUpload('{{ $trans->get('Uploading.Error.NoCSV', 'Not a CSV file') }}', '{{ $trans->get('Uploading.Error.NoFile', 'Must choose some file') }}')">

                    <input type="file" id="file" name="file" onchange="seeFileName()">
                    <label for="file">{{ $trans->get('Uploading.Upload.Button', 'Choose file') }}</label>
                    <span id="fileName"></span>
                    <button type="submit">{{ $trans->get('Import.Send', 'Import') }}</button>
                </form>

                @if(isset($err))
                    <div class="red">{{ $err }}</div>
                @elseif(isset($message))
                    <strong class="green">{{ $message }}</strong>
                @endif
            </div>
        </div>
    </div>
@endsection
