@extends('base')
@inject('trans', 'App\Model\Service\ITranslationService')

@section('title', $trans->get('Titles.Settings', 'Settings'))

@section('navigation')
    <div class="container">
        <a href="{{ route('get.wallets') }}">{{ env('APP_NAME', 'Laravel') }}</a> &gt;
        <a href="#">{{ $trans->get('Member.Settings', 'Settings') }}</a>
    </div>
@endsection


@section('stylesheets')
    <link href="{{ asset('css/settings.css') }}" rel="stylesheet">
@endsection

@section('scripts')
    <script type="text/javascript">
        @if($changePassword != 'on')
        $(document).ready(function() {
            $('.password').hide();
            $('.passwordInput').prop('disabled', true);
        });
        @endif
        function togglePassword() {
            $('.password').toggle();
            var val = true;
            if ($('.passwordInput').prop('disabled'))
                val = false;

            $('.passwordInput').prop('disabled', val);
        }
    </script>
@endsection

@section('content')
    <div class="container" id="settings">
        <form method="POST" action="{{ route('put.member') }}">
            <table rules="none">
                <input type="hidden" name="_method" value="put" >
                {{ csrf_field() }}

                <!-- first name -->
                <tr>
                    <td>
                        <label for="fname">{{ $trans->get('Settings.Form.FirstName', 'First name:') }}</label>
                    </td>
                    <td>
                        <input type="text" id="fname" placeholder="{{ $trans->get('Settings.Form.FirstName.Placeholder', 'John') }}" name="firstName" value="{{ old('firstName') ? old('firstName') : $member->getFirstName() }}" autofocus />
                    </td>
                    <td>
                        @if ($errors->has('firstName'))
                            <span class="help-block">
                                <strong class="red">{{ $errors->first('firstName') }}</strong>
                            </span>
                        @endif
                    </td>
                </tr>

                <!-- last name -->
                <tr>
                    <td>
                        <label for="lname">{{ $trans->get('Settings.Form.LastName', 'Last name:') }}</label>
                    </td>
                    <td>
                        <input type="text" id="lname" placeholder="{{ $trans->get('Settings.Form.LastName.Placeholder', 'Doe') }}" name="lastName" value="{{ old('lastName') ? old('lastName') : $member->getLastName() }}" />
                    </td>
                    <td>
                        @if ($errors->has('lastName'))
                            <span class="help-block">
                                <strong class="red">{{ $errors->first('lastName') }}</strong>
                            </span>
                        @endif
                    </td>
                </tr>

                <!-- login -->
                @if(!$member->isExternal())
                <tr>
                    <td>
                        <label for="login">{{ $trans->get('Settings.Form.Login', 'Login:') }}</label>
                    </td>
                    <td colspan="2">
                        <input type="text" id="login" value="{{ $member->getLogin() }}" disabled />
                        <input type="hidden" name="login" value="{{ $member->getLogin() }}" >
                    </td>
                </tr>
                @endif

                <!-- switch passwords -->
                @if(!$member->isExternal())
                <tr>
                    <td colspan="3">
                        <input type="checkbox" id="changePasswd" name="changePassword" onchange="togglePassword()" {{ $changePassword == 'on' ? 'checked' : '' }}>
                        <label for="changePasswd">{{ $trans->get('Settings.Form.ChangePassword.CheckBox', 'Change password') }}</label>
                    </td>
                </tr>
                @endif

                <!-- password -->
                <tr class="password">
                    <td>
                        <label for="passwd">{{ $trans->get('Settings.Form.Password', 'Password:' )}}</label>
                    </td>
                    <td>
                        <input type="password" id="passwd" class="passwordInput" placeholder="{{ $trans->get('Settings.Form.Password.Placeholder', 'password') }}" name="password" />
                    </td>
                    <td>
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong class="red">{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </td>
                </tr>

                <!-- confirm password -->
                <tr class="password">
                    <td>
                        <label for="passwdAgain">{{ $trans->get('Settings.Form.ConfirmPassword', 'Password again:') }}</label>
                    </td>
                    <td>
                        <input type="password" id="passwdAgain" class="passwordInput" placeholder="{{ $trans->get('Settings.Form.ConfirmPassword.Placeholder', 'password') }}" name="password_confirmation" />
                    </td>
                    <td></td>
                </tr>

                <!-- old password -->
                <tr class="password">
                    <td>
                        <label for="oldPasswd">{{ $trans->get('Settings.Form.OldPassword', 'Old password:') }}</label>
                    </td>
                    <td>
                        <input type="password" id="oldPasswd" class="passwordInput" placeholder="{{ $trans->get('Settings.Form.OldPassword.Placeholder', 'old password') }}" name="oldPassword" />
                    </td>
                    <td>
                        @if ($errors->has('oldPassword'))
                            <span class="help-block">
                                <strong class="red">{{ $errors->first('oldPassword') }}</strong>
                            </span>
                        @endif
                    </td>
                </tr>

                <!-- my mail -->
                <!--
                <tr>
                  <td>
                    <label for="myMail">{{ $trans->get('Settings.Form.MailToMe', 'My mail:') }}</label>
                  </td>
                  <td colspan="2">
                    <input type="text" id="myMail" [(ngModel)]="member.me" (keypress)="handleEnter($event)"
                           placeholder="example@mail.com">
                  </td>
                </tr>
                -->

                <!-- send by one -->
                <!--
                <tr>
                  <td>
                    <label for="sendByOne">{{ $trans->get('Settings.Form.SendByOne', 'Send every item:') }}</label>
                  </td>
                  <td>
                    <select [(ngModel)]="member.sendByOne" id="sendByOne">
                      <option value="1">{{ $trans->get('Yes', 'YES') }}</option>
                      <option value="0">{{ $trans->get('No', 'NO') }}</option>
                    </select>
                  </td>
                </tr>
                -->

                <!-- send monthly -->
                <!--<tr>
                <td>
                    <label for="sendMonthly">{{ $trans->get('Settings.Form.SendMonthly', 'Ability to send mothly expense:') }}</label>
                </td>
                <td>
                    <select [(ngModel)]="member.sendMonthly" id="sendMonthly">
                      <option value="1">{{ $trans->get('Yes', 'YES') }}</option>
                      <option value="0">{{ $trans->get('No', 'NO') }}</option>
                    </select>
                  </td>
                </tr>-->

                <!-- currency -->
                <tr>
                    <td>
                        <label for="currency">{{ $trans->get('Settings.Form.Currency', 'Currency:') }}</label>
                    </td>
                    <td>
                        <select id="currency" name="currencyCode">
                            @foreach($currencies as $currency)
                                <option value="{{ $currency->getCode() }}" {{ $member->getCurrency() == $currency ? 'selected' : '' }}>
                                    {{ $currency->getName() }} ({{ $currency->getValue() }})
                                </option>
                            @endforeach
                        </select>
                    </td>
                </tr>

                <!-- language -->
                <tr>
                    <td>
                        <label for="language">{{ $trans->get('Settings.Form.Language', 'Language:') }}</label>
                    </td>
                    <td>
                        <select id="language" name="languageCode">
                            @foreach($languages as $language)
                                <option value="{{ $language->getCode() }}" {{ $member->getLanguage() == $language ? 'selected' : '' }}>
                                    {{ $language->getName() }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                </tr>

                <!-- notes -->
                <tr>
                    <td>
                        <label for="notes">{{ $trans->get('Settings.Form.KindsOfSpend', 'Kinds of expense:') }}</label>
                    </td>
                    <td colspan="2">
                        <a href="{{ route('get.purposes.manage') }}" id="manageNotes">{{ $trans->get('Settings.Form.ManageNotes', 'Manage notes') }}</a>
                    </td>
                </tr>


                <tr>
                    <td colspan="3">
                        <button type="submit">{{ $trans->get('Settings.Form.Change', 'Save') }}</button>
                    </td>
                </tr>
            </table>
        </form>

        @if(isset($warning))
            <div class="container">
                <strong class="red">{{ $warning }}</strong>
            </div>
        @endif
    </div>
@endsection
