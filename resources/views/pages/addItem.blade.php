@extends('wallet')
@inject('trans', 'App\Model\Service\ITranslationService')
@inject('CService', 'App\Model\Service\ICurrencyService')
@inject('PService', 'App\Model\Service\IPurposeService')
@inject('formatter', 'App\Model\Help\DateFormatter')

@section('navigation')
    <div class="container">
        <a href="{{ route('get.wallets') }}">{{ env('APP_NAME', 'Laravel') }}</a> &gt;
        <a href="{{ route('get.wallet', ['id' => $wallet['id']]) }}">{{ $trans->get('Navigation.Wallet', 'Wallet') }} {{ $wallet['name'] }}</a> &gt;
        <a href="#">{{ $trans->get('Item.Add.Title', 'Add new Item') }}</a>
    </div>
@endsection

@section('title', $trans->get('Title.AddItem', 'Add item'))

@section('stylesheets')
    <link href="{{ asset('css/addItem.css') }}" rel="stylesheet">
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/updateItems.js') }}"></script>
@endsection

@section('content')
    <div class="container">
        <div id="updateForm">
            <h3>{{ $trans->get('AddItem.Form.Heading', 'Create new item') }}</h3>

            <form method="POST" action="{{ route('post.item', ['id' =>$wallet['id']]) }}">
                <input type="hidden" name="walletId" value="{{ $wallet['id'] }}">
                <table rules="none">
                        <!-- name -->
                        <tr>
                            <td>
                                <label for="name">{{ $trans->get('AddItem.Form.Name', 'Name:') }} {{ old('name') }}</label>
                            </td>
                            <td>
                                <input type="text" name="name" id="name" value="{{ $_POST['name'] ?? '' }}" placeholder="{{ $trans->get('AddItem.Form.Name.Placeholder', 'name') }}" autofocus /><strong class="red"> *</strong>
                            </td>
                        </tr>

                        <!-- description -->
                        <tr>
                            <td>
                                <label for="description">{{ $trans->get('AddItem.Form.Description', 'Description:') }}</label>
                            </td>
                            <td>
                                <textarea id="description" name="description" rows="3" placeholder="{{ $trans->get('AddItem.Form.Description.Placeholder', 'description') }}">{{ $_POST['description'] ?? '' }}</textarea>
                            </td>
                        </tr>

                        <!-- price -->
                        <tr>
                            <td>
                                <label for="price">{{ $trans->get('AddItem.Form.Price', 'Price:') }}</label>
                            </td>
                            <td>
                                <input type="number" step="0.01" name="price" id="price" placeholder="132.13" value="{{ $_POST['price'] ?? '' }}" /><strong class="red"> *</strong>
                                <span id="otherCurrencySpan" onclick="enableOtherCurrency()">{{ $trans->get('AddItem.Form.AnotherCurrency', 'other currency') }}</span>
                            </td>
                        </tr>

                        <!-- course -->
                        <tr class="otherCurrency">
                            <td>
                                <label for="currency">{{ $trans->get('AddItem.Form.Currency', 'Currency:') }}</label>
                            </td>
                            <td>
                                <select id="currency" name="currencyId" class="thirth" onchange="recountCourse('{{ Auth::user()->getCurrency()->getCode() }}', '{{ route('get.course') }}', 'course', this)">
                                    @foreach($CService->getCurrencies() as $curr)
                                        <option {{ isset($_POST['currencyId']) && $_POST['currencyId'] === $curr['code'] ? 'selected' : $curr['CurrencyID'] == Auth::user()->getCurrency()->getId() ? 'selected' : '' }} value="{{ $curr['code'] }}">
                                            {{ $curr['value'] }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="course" class="thirth">{{ $trans->get('AddItem.Form.CurrencyCourse', 'course:') }}</label>
                                <input type="number" step="0.001" name="course" class="thirth" id="course" value="{{ $_POST['course'] ?? '1' }}" /><strong class="red"> *</strong>
                            </td>
                        </tr>

                        <!-- date -->
                        <tr>
                            <td>
                                <label for="date">{{ $trans->get('AddItem.Form.Date', 'Date:') }}</label>
                            </td>
                            <td>
                                <input type="datetime-local" name="date" id="date" value="{{ $_POST['date'] ?? $formatter->dateToInputFormat('now') }}"/><strong class="red"> *</strong>
                            </td>
                        </tr>

                        <!-- type -->
                        <tr>
                            <td>
                                <label for="type">{{ $trans->get('AddItem.Form.Type', 'Type:') }}</label>
                            </td>
                            <td>
                                <select id="type" name="type">
                                    <option value="karta" {{ isset($_POST['type']) && $_POST['type'] === 'karta' ? 'selected' : '' }}>{{ $trans->get('AddItem.Form.Type.Card', 'Card') }}</option>
                                    <option value="hotovost" {{ isset($_POST['type']) && $_POST['type'] === 'hotovost' ? 'selected' : '' }}>{{ $trans->get('AddItem.Form.Type.Cash', 'Cash') }}</option>
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
                                <input type="checkbox" name="vyber" id="vyber" onchange="switchVyberOdepsat('vyber')" {{ isset($_POST['vyber']) ? 'checked' : '' }} />
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
                                        <option value="{{ $note['PurposeID'] }}" {{ isset($_POST['noteId']) && $_POST['noteId'] == $note['PurposeID'] ? 'selected' : '' }}>{{ $note['value'] }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>

                    <tr>
                        <td>
                            <button type="submit" class="green">{{ $trans->get('AddItem.Form.Save', 'Store') }}</button>
                        </td>
                        <td>
                            <button type="submit" class="red">
                                <a href="{{ route('get.wallet', ['id' => $wallet['id']]) }}">{{ $trans->get('AddItem.Form.Storno', 'Strono') }}</a>
                            </button>
                            <span class="red">* {{ $trans->get('Item.Form.Required', 'Required fields') }}</span>
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
