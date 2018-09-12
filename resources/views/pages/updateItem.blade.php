@extends('wallet')
@inject('trans', 'App\Model\Service\ITranslationService')
@inject('dateFormatter', 'App\Model\Help\DateFormatter')

@section('title', $trans->get('UpdateItem.Form.Heading', 'Update item'))

@section('stylesheets')
    <link href="{{ asset('css/addItem.css') }}" rel="stylesheet">
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/updateItems.js') }}"></script>
@endsection

@section('navigation')
    <div class="container">
        <a href="{{ route('get.wallets') }}">{{ env('APP_NAME', 'Laravel') }}</a> &gt;
        <a href="{{ route('get.wallet', ['id' => $item['wallet']]) }}">{{ $trans->get('Navigation.Wallet', 'Wallet') }} {{ $wallet['name'] }}</a> &gt;
        <a href="#">{{ $trans->get('Navigation.UpdateItem', 'Update item') }}</a>
    </div>
@endsection

@section('content')
    <div class="container">
        <div id="updateForm">
            <h3>{{ $trans->get('UpdateItem.Form.Heading', 'Update item form') }}</h3>
            <form method="POST" action="{{ route('put.item', ['id' => $item['id']]) }}">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="put">
                <input type="hidden" name="id" value="{{ $item['id'] }}">

                <table rules="none">
                    <!-- name -->
                    <tr>
                        <td>
                            <label for="name">{{ $trans->get('UpdateItem.Form.Name', 'Name:') }}</label>
                        </td>
                        <td>
                            <input type="text" id="name" name="name" value="{{ $_POST['name'] ?? $item['name'] }}" /><strong class="red"> *</strong>
                        </td>
                    </tr>

                    <!-- description -->
                    <tr>
                        <td>
                            <label for="description">{{ $trans->get('UpdateItem.Form.Description', 'Description:') }}</label>
                        </td>
                        <td>
                            <textarea id="description" name="description" rows="3">{{ old('description') ? old('description') : $item['description'] }}</textarea>
                        </td>
                    </tr>

                    <!-- price -->
                    <tr>
                        <td>
                            <label for="price">{{ $trans->get('UpdateItem.Form.Price', 'Price:') }}</label>
                        </td>
                        <td>
                            <input type="number" step="0.01" id="price" name="price" value="{{ old('price') ? old('price') : $item['price'] }}" /><strong class="red"> *</strong>
                            <span id="otherCurrencySpan" onclick="enableOtherCurrency()">{{ $trans->get('UpdateItem.Form.AnotherCurrency', 'other currency') }}</span>
                        </td>
                    </tr>

                    <!-- course -->
                    <tr class="otherCurrency">
                        <td>
                            <label for="currency">{{ $trans->get('UpdateItem.Form.Currency', 'Currency:') }}</label>
                        </td>
                        <td>
                            <select id="curr" name="currency" class="thirth" onchange="recountCourse( '{{ Auth::user()->getCurrency()->getCode() }}', '{{ route('get.course') }}', 'course', this)">
                                @foreach($currencies as $currency)
                                    <option value="{{ $currency['code'] }}" {{ $currency['code'] == $item['currency']['code'] ? 'selected' : '' }}>
                                        {{ $currency['value'] }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="course" class="thirth">{{ $trans->get('UpdateItem.Form.Course', 'course:') }}</label>
                            <input type="number" step="0.001" name="course" value="{{ old('course') ? old('course') : $item['course'] }}" class="thirth" id="course" /><strong class="red"> *</strong>
                        </td>
                    </tr>

                    <!-- date -->
                    <tr>
                        <td>
                            <label for="date">{{ $trans->get('UpdateItem.Form.Date', 'Date:') }}</label>
                        </td>
                        <td>
                            <input type="datetime-local" name="date" value="{{ old('date') ? old('date') : $dateFormatter->dateToInputFormat($item['date']) }}" id="date" /><strong class="red"> *</strong>
                        </td>
                    </tr>

                    <!-- type -->
                    <tr>
                        <td>
                            <label for="type">{{ $trans->get('UpdateItem.Form.Type', 'Type:') }}</label>
                        </td>
                        <td>
                            <select id="type" name="type">
                                <option value="karta" {{ $item['type'] == 'karta' ? 'selected' : '' }}>{{ $trans->get('UpdateItem.Form.Type.Card', 'Card') }}</option>
                                <option value="hotovost" {{ $item['type'] == 'hotovost' ? 'selected' : '' }}>{{ $trans->get('UpdateItem.Form.Type.Cash', 'Cash') }}</option>
                            </select>
                        </td>
                    </tr>

                    <!-- odepsat -->
                    <!--
                    <tr>
                        <td>
                            <label for="odepsat">{{ $trans->get('UpdateItem.Form.Odepsat', 'My expense:') }}</label>
                        </td>
                        <td>
                            <input type="checkbox" [(ngModel)]="backItem.odepsat" id="odepsat" />
                        </td>
                    </tr>
                    -->

                    <!-- purpose -->
                    @if($item['income'] !== true)
                    <tr>
                        <td>
                            <label for="purpose">{{ $trans->get('UpdateItem.Form.Purpose', 'Note:') }}</label>
                        </td>
                        <td>
                            <select id="purpose" name="noteId">
                                @foreach($notes as $note)
                                    <option {{ $note['id'] == $item['note']['id'] ? 'selected' : '' }} value="{{ $note['id'] }}">
                                        {{ $note['value'] }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    @endif

                    <!-- wallet -->
                    <tr>
                        <td>
                            <label for="wallet">{{ $trans->get('UpdateItem.Form.Wallet', 'Wallet:') }}</label>
                        </td>
                        <td>
                            <select id="wallet" name="wallet">
                                @foreach($wallets as $_wallet)
                                    <option {{ $_wallet['id'] == $item['wallet'] ? 'selected' : '' }} value="{{ $_wallet['id'] }}">
                                        {{ $_wallet['name'] }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <button type="submit" class="green">{{ $trans->get('UpdateItem.Form.Save', 'Update') }}</button>
                        </td>
                        <td>
                            <button class="red"><a href="{{ old('previousURL') ?? $previousURL }}">{{ $trans->get('UpdateItem.Form.Storno', 'Strono') }}</a></button>
                            <span class="red">* {{ $trans->get('Item.Form.Required', 'Required fields') }}</span>
                        </td>
                    </tr>
                    <input type="hidden" name="previousURL" value="{{ old('previousURL') ?? $previousURL }}" />
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
