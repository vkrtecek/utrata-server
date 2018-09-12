@extends('inc.header')
@inject('trans', 'App\Model\Service\ITranslationService')

@section('menu-items')
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
            {{ $trans->get('Menu.Wallet', 'Wallet') }} <span class="caret"></span>
        </a>

        <ul class="dropdown-menu" role="menu">
            <li>
                <a id="_button_base" href="{{ route('get.wallet', ['id' => $wallet['id']]) }}">{{ $trans->get('Menu.Wallet', 'Expenses') }}</a>
            </li>
            <li>
                <a id="_button_new_item" href="{{ route('get.item.addItem', ['id' => $wallet['id']]) }}">{{ $trans->get('Menu.AddItem', 'Add item') }}</a>
            </li>
            <li>
                <a id="_button_incomes" href="{{ route('get.wallet.incomes', ['id' => $wallet['id']]) }}">{{ $trans->get('Menu.Incomes', 'Incomes') }}</a>
            </li>
            <li>
                <a id="_button_archive" href="{{ route('get.wallet.archive', ['id' => $wallet['id']]) }}">{{ $trans->get('Menu.OldItems', 'Archive') }}</a>
            </li>
            <li>
                <a id="_button_monthly_preview" href="#">{{ $trans->get('Menu.MonthlyPreview', 'Monthly preview') }}</a>
            </li>
        </ul>
    </li>
@endsection
