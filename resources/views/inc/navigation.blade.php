<p>{{ $trans->get('Uvod.Filtering.OrderBy', 'Order by') }}

<!-- order by -->
    <select size="1" id="orderBy" onchange="printItems('{{ route('get.items.wallet', ['id' => $wallet['id']]) }}', '{{ \App\Model\Enum\ItemState::UNCHECKED }}')">
        <option value="mainName">{{ $trans->get('Uvod.Filtering.OrderBy.ItemName', 'Name') }}</option>
        <option value="date" selected>{{ $trans->get('Uvod.Filtering.OrderBy.ItemDate', 'Date') }}</option>
        <option value="price">{{ $trans->get('Uvod.Filtering.OrderBy.ItemPrice', 'Price') }}</option>
    </select>

    <!-- order how -->
    <select size="1" id="orderHow" onchange="printItems('{{ route('get.items.wallet', ['id' => $wallet['id']]) }}', '{{ \App\Model\Enum\ItemState::UNCHECKED }}')">
        <option value="ASC">{{ $trans->get('Uvod.Filtering.OrderBy.Asc', 'Ascendant') }}</option>
        <option value="DESC" selected>{{ $trans->get('Uvod.Filtering.OrderBy.Desc', 'Descendant') }}</option>
    </select>
{{ $trans->get('Uvod.Filtering.AndMonth', 'and select only:') }}

<!-- month -->
    <select size="1" id="month" onchange="printItems('{{ route('get.items.wallet', ['id' => $wallet['id']]) }}', '{{ \App\Model\Enum\ItemState::UNCHECKED }}')">
        <option value="" >{{ $trans->get('Uvod.Filtering.Month.Default', '--month--') }}</option>
        @foreach($months as $month)
            <option value="{{ $month['id'] }}">{{ $trans->get($month['code'], $month['value']) }}</option>
        @endforeach
    </select>
{{ $trans->get('Uvod.Filtering.Or', 'or') }}

<!-- notes -->
    <select size="1" id="notesList" onclick="resizeNotes()" onchange="printItems('{{ route('get.items.wallet', ['id' => $wallet['id']]) }}', '{{ \App\Model\Enum\ItemState::UNCHECKED }}')" multiple>
        <option value="">{{ $trans->get('Uvod.Filtering.Types.Default', '--note--') }}</option>
        @foreach($notes as $note)
            <option value="{{ $note['id'] }}">{{ $note['value'] }}</option>
        @endforeach
    </select>

    <!-- year -->
    <label>{{ $trans->get('Uvod.Filtering.Year', 'year:') }}
        <input type="number" id="filterYear" onkeyup="printItems('{{ route('get.items.wallet', ['id' => $wallet['id']]) }}', '{{ \App\Model\Enum\ItemState::UNCHECKED }}')" />
    </label>

    <!-- pattern -->
    <label> {{ $trans->get('Uvod.Filtering.Pattern', 'pattern') }}
        <input type="text" id="filterPattern" onkeyup="printItems('{{ route('get.items.wallet', ['id' => $wallet['id']]) }}', '{{ \App\Model\Enum\ItemState::UNCHECKED }}')" />
        <span title="{{ $trans->get('Uvod.Filtering.HelpTitle') }}" id="questionmark">?</span>
    </label>
    <span id="clear" title="{{ $trans->get('Uvod.Filtering.SetDefaultTitle', 'default filtering') }}" onclick="clearSearch()">×</span></p>
<hr />
