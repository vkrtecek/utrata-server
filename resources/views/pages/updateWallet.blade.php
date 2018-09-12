@extends('base')
@inject('trans', 'App\Model\Service\ITranslationService')

@section('title', $trans->get('Wallet.Update.Title', 'Change wallet'))

@section('navigation')
    <div class="container">
        <a href="{{ route('get.wallets') }}">{{ env('APP_NAME', 'Laravel') }}</a> >
        <a href="#">{{ $trans->get('Wallet.Update.Title', 'Change wallet') }}</a>
    </div>
@endsection

@section('stylesheets')
    <link href="{{ asset('css/addWallet.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <div id="form">
            <h4>{{ $trans->get('Wallet.Update.Title', 'Change wallet') }}</h4>

            <form method="POST" action="{{ route('put.wallet', ['id' => $wallet['id']]) }}">
                <input type="hidden" name="_method" value="put">
                <table rules="none">
                    <tr>
                        <td>
                            <label for="name">{{ $trans->get('Wallet.Update.Name', 'Name') }}</label>
                        </td>
                        <td>
                            <input type="text" name="name" value="{{ old('name') ? old('name') : $wallet['name'] }}" id="name">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <button type="submit">{{ $trans->get('Wallet.Update.CreateBtn', 'Update') }}</button>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            @if(isset($warning))
                                <span class="red error">{{ $warning }}</span>
                            @endif
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
@endsection
