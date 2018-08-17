@extends('wallet')
@inject('trans', 'App\Model\Service\ITranslationService')
@inject('CService', 'App\Model\Service\ICurrencyService')
@inject('PService', 'App\Model\Service\IPurposeService')

@section('navigation')
    <div class="container">
        <a href="{{ route('get.wallets') }}">{{ env('APP_NAME', 'Laravel') }}</a> >
        <a href="{{ route('get.wallet', ['id' => $wallet['id']]) }}">{{ $trans->get('Navigation.Wallet', 'Wallet') }} {{ $wallet['name'] }}</a> >
        <a href="#">{{ $trans->get('Item.Add.Title', 'Add new Item') }}</a>
    </div>
@endsection

@section('title', $trans->get('Title.AddItem', 'Add item'))

@section('stylesheets')
    <link href="{{ asset('css/addItem.css') }}" rel="stylesheet">
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/addItem.js') }}"></script>
@endsection

@section('content')
    <div class="container">
        <div id="updateForm">
            <h3>{{ $trans->get('AddItem.Form.Heading', 'Create new item') }}</h3>

            <form method="POST" action="{{ route('post.item') }}">
                <input type="hidden" name="walletId" value="{{ $wallet['id'] }}">
                <table rules="none">
                        <!-- name -->
                        <tr>
                            <td>
                                <label for="name">{{ $trans->get('AddItem.Form.Name', 'Name:') }}</label>
                            </td>
                            <td>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="{{ $trans->get('AddItem.Form.Name.Placeholder', 'name') }}" autofocus /><strong class="red"> *</strong>
                            </td>
                        </tr>

                        <!-- description -->
                        <tr>
                            <td>
                                <label for="description">{{ $trans->get('AddItem.Form.Description', 'Description:') }}</label>
                            </td>
                            <td>
                                <textarea id="description" name="description" rows="3" placeholder="{{ $trans->get('AddItem.Form.Description.Placeholder', 'description') }}"></textarea>
                            </td>
                        </tr>

                        <!-- price -->
                        <tr>
                            <td>
                                <label for="price">{{ $trans->get('AddItem.Form.Price', 'Price:') }}</label>
                            </td>
                            <td>
                                <input type="number" step="0.01" name="price" id="price" placeholder="132.13" /><strong class="red"> *</strong>
                                <span id="otherCurrencySpan" onclick="enableOtherCurrencyToggle()">{{ $trans->get('AddItem.Form.AnotherCurrency', 'other currency') }}</span>
                            </td>
                        </tr>

                        <!-- course -->
                        <tr id="otherCurrency">
                            <td>
                                <label for="currency">{{ $trans->get('AddItem.Form.Currency', 'Currency:') }}</label>
                            </td>
                            <td>
                                <select id="currency" name="currencyId" class="thirth" onchange="recountCourse('{{ Auth::user()->getCurrency()->getCode() }}', 'course')">
                                    @foreach($CService->getCurrencies() as $curr)
                                        <option {{ $curr['id'] == Auth::user()->getCurrency()->getId() ? 'selected' : '' }} value="{{ $curr['id'] }}">
                                            {{ $curr['value'] }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="course" class="thirth">{{ $trans->get('AddItem.Form.CurrencyCourse', 'course:') }}</label>
                                <input type="number" step="0.001" name="course" class="thirth" id="course" value="1" /><strong class="red"> *</strong>
                            </td>
                        </tr>

                        <!-- date -->
                        <tr>
                            <td>
                                <label for="date">{{ $trans->get('AddItem.Form.Date', 'Date:') }}</label>
                            </td>
                            <td>
                                <input type="datetime-local" name="date" id="date" value="{{ (new \DateTime())->format('Y-m-d') . 'T' .  (new \DateTime())->format('H:i:s') }}"/><strong class="red"> *</strong>
                            </td>
                        </tr>

                        <!-- type -->
                        <tr>
                            <td>
                                <label for="type">{{ $trans->get('AddItem.Form.Type', 'Type:') }}</label>
                            </td>
                            <td>
                                <select id="type" name="type">
                                    <option value="karta">{{ $trans->get('AddItem.Form.Type.Card', 'Card') }}</option>
                                    <option value="hotovost">{{ $trans->get('AddItem.Form.Type.Cash', 'Cash') }}</option>
                                </select>
                            </td>
                        </tr>

                        <!-- odepsat && vyber -->
                        <tr>
                            <td>
                                <!--
                                <input type="checkbox" [(ngModel)]="item.odepsat" id="odepsat" (change)="switchVyberOdepsat('odepsat')" />
                                <label for="odepsat" class="blue">{{ $trans->get('AddItem.Form.MyExpense', 'My expense') }}</label>
                                -->
                            </td>
                            <td>
                                <input type="checkbox" name="vyber" id="vyber" onchange="switchVyberOdepsat('vyber')" />
                                <label for="vyber" class="blue">{{ $trans->get('AddItem.Form.Pick', 'ATM pick') }}</label>
                            </td>
                        </tr>

                        <!-- purpose -->
                        <tr>
                            <td>
                                <label for="purpose">{{ $trans->get('AddItem.Form.Note', 'Note:') }}</label>
                            </td>
                            <td>
                                <select id="purpose" name="noteId">
                                    @foreach($PService->getUserPurposes(Auth::user()) as $note)
                                        <option value="{{ $note['id'] }}">{{ $note['value'] }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>

                    <tr>
                        <td>
                            <button type="submit" class="green">{{ $trans->get('AddItem.Form.Save', 'Store') }}</button>
                        </td>
                        <td>
                            <form method="GET" action="{{ route('get.wallet', ['id' => $wallet['id']]) }}">
                                <button type="submit" class="red">{{ $trans->get('AddItem.Form.Storno', 'Strono') }}</button>
                                <span class="red">* {{ $trans->get('Item.Form.Required', 'Required fields') }}</span>
                            </form>
                        </td>
                    </tr>
                </table>
            </form>

            @if(isset($message))
                <div class="red message">
                    {{ $message }}
                </div>
            @endif
        </div>
    </div>
@endsection