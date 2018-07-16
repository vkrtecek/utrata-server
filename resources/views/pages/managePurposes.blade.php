@extends('base')
@inject('trans', 'App\Model\Service\ITranslationService')

@section('title', $trans->get('Title.Notes.Manage', 'Manage notes'))

@section('navigation')
    <div class="container">
        <a href="{{ route('get.wallets') }}">{{ env('APP_NAME', 'Laravel') }}</a> >
        <a href="{{ route('get.member.settings') }}">{{ $trans->get('Member.Settings', 'Settings') }}</a> >
        <a href="#">{{ $trans->get('Purposes.Navigation', 'Purpose management') }}</a>
    </div>
@endsection

@section('stylesheets')
    <link href="{{ asset('css/managePurposes.css') }}" rel="stylesheet">
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/managePurposes.js') }}"></script>
@endsection

@section('content')
    <div id="wrapper" class="container">
        <form method="POST" action="{{ route('post.purpose') }}">
            <label for="addNote">{{ $trans->get('ManageNotes.Form.AddLabel', 'Add:') }}</label>
            <input type="text" id="addNote" placeholder="Transport" name="name" autofocus>
            <button>{{ $trans->get('ManageNotes.Form.AddButton', 'Add') }}</button>
        </form>

        <hr />

        <div id="listing_wrapper">
            @if(count($notes))
                <table>
                    <tr>
                        <th>{{ $trans->get('ManageNotes.Form.Table.Name', 'Name') }}</th>
                        <th>{{ $trans->get('ManageNotes.Form.Table.Code', 'Code') }}</th>
                        <th>{{ $trans->get('ManageNotes.Form.Table.Using', 'Using') }}</th>
                        <th></th>
                    </tr>
                    @foreach($notes as $note)
                        <tr>
                            <td>
                                {{ $note['value'] }}
                            </td><td>
                                {{ $note['code'] }}
                            </td>
                            <td>
                                <input type="checkbox" {{ in_array($note['id'], $usingNotes) ? 'checked' : '' }}
                                       onclick="togglePurpose('{{ $note['id'] }}', '{{ Auth::user()->getLogin() }}', this, '{{ route('post.memberPurpose.connection') }}', '{{ route('delete.memberPurpose.connection') }}')" />
                            </td>
                            <td>
                                @if($note['deletable'])
                                    <form method="POST" action="{{ route('delete.purpose', ['id' => $note['id']]) }}">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="delete">
                                        <button>{{ $trans->get('ManageNotes.Form.DeleteNote', 'Delete note') }}</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </table>
            @else
                <div>
                    {{ $trans->get('ManageNotes.Form.NoNote', 'No one note') }}
                </div>
            @endif
        </div>

        <button><a href="{{ route('get.member.settings') }}">{{ $trans->get('ManageNotes.Form.Back', 'Back') }}</a></button>

        @if(isset($warning))
            <div class="red message">{{ $warning }}</div>
        @endif
    </div>
@endsection