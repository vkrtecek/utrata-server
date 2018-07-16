@extends('base')
@inject('trans', 'App\Model\Service\ITranslationService')

@section('navigation')
    <div class="container">
        <a href="{{ route('get.wallets') }}">{{ env('APP_NAME', 'Laravel') }}</a> >
        <a href="#">{{ $trans->get('Wallet.Add.Title', 'Add new Wallet') }}</a>
    </div>
@endsection

@section('stylesheets')
    <link href="{{ asset('css/addWallet.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <div id="form">
            <h4>{{ $trans->get('Wallet.Add.Title', 'Add new Wallet') }}</h4>

            <form method="POST" action="{{ route('post.wallet') }}">
                <table rules="none">
                    <tr>
                        <td>
                            <label for="name">{{ $trans->get('Wallet.Add.Name', 'Name') }}</label>
                        </td>
                        <td>
                            <input type="text" name="name" placeholder="{{ $trans->get('Wallet.Add.Name.Placeholder', 'name') }}" id="name">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <button type="submit">{{ $trans->get('Wallet.Add.CreateBtn', 'Create') }}</button>
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