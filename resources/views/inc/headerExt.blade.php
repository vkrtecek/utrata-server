@extends('inc.header')
@inject('trans', 'App\Model\Service\ITranslationService')

@section('menu-items')
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
            {{ $trans->get('Menu.Wallet', 'Wallet') }} <span class="caret"></span>
        </a>

        <ul class="dropdown-menu" role="menu">
            <li>
                <a href="{{ route('get.item.addItem', ['id' => $wallet['id']]) }}">{{ $trans->get('Menu.AddItem', 'Add item') }}</a>
            </li>
            <li>
                <a href="#">{{ $trans->get('Menu.Incomes', 'Incomes') }}</a>
            </li>
            <li>
                <a href="#">{{ $trans->get('Menu.OldItems', 'Archive') }}</a>
            </li>
            <li>
                <a href="#">{{ $trans->get('Menu.MonthlyPreview', 'Monthly preview') }}</a>
            </li>
        </ul>
    </li>
@endsection