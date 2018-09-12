@extends('inc.headerExt')
@inject('trans', 'App\Model\Service\ITranslationService')

@section('menu-items')
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
            {{ $trans->get('Menu.Incomes', 'Incomes') }} <span class="caret"></span>
        </a>

        <ul class="dropdown-menu" role="menu">
            <li>
                <a href="{{ route('get.wallet.incomes', ['id' => $wallet['id']]) }}">{{ $trans->get('Menu.Incomes', 'Incomes') }}</a>
            </li>
            <li>
                <a href="{{ route('get.item.addIncome', ['id' => $wallet['id']]) }}">{{ $trans->get('Menu.AddIncome', 'Add income') }}</a>
            </li>
        </ul>
    </li>

    @parent('menu-items')
@endsection
