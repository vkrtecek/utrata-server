@inject('trans', 'App\Model\Service\ITranslationService')


<div id="partMonth">
    <h2>{{ str_replace('{%d}', (new \DateTime)->format('d'), $trans->get('Statistics.PartMonth.H2', 'Comparison with months since {%d}th of each month')) }}</h2>

    <div id="quick-preview-part"></div>
    {!! $partGraph->render('ColumnChart', 'part', 'quick-preview-parts') !!}

    <table rules="all" id="partExtremeMonths">
        <thead>
        <tr>
            <th></th>
            <th>{{ $trans->get('Statistics.PartMonth.Extremes.Date', 'Date') }}</th>
            <th>{{ $trans->get('Statistics.PartMonth.Extremes.Value', 'Expense' )}}</th>
            <th>{{ $trans->get('Statistics.PartMonth.Extremes.ThisMonth', 'This month') }}</th>
            <th>{{ $trans->get('Statistics.PartMonth.Extremes.Percentage', 'Percentage') }}</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th>{{ $trans->get('Statistics.PartMonth.Extremes.Min', 'MIN:') }}</th>
            <td>{{ $data['part']['min']['year'] }}-{{ $data['part']['min']['month'] }}</td>
            <td>{{ number_format($data['part']['min']['expense'], 2, ',', ' ') }}&nbsp;{{ Auth::user()->getCurrency()->getValue() }}</td>
            <td>{{ number_format($data['part']['thisMonth']['expense'], 2, ',', ' ') }}&nbsp;{{ Auth::user()->getCurrency()->getValue() }}</td>
            <td>{!! $data['part']['min']['expense'] ? number_format($data['part']['thisMonth']['expense'] / $data['part']['min']['expense'] * 100, 2, ',', ' ') . '&nbsp;%' : '-' !!}</td>
        </tr>
        <tr>
            <th>{{ $trans->get('Statistics.PartMonth.Extremes.Max', 'MAX:') }}</th>
            <td>{{ $data['part']['max']['year'] }}-{{ $data['part']['max']['month'] }}</td>
            <td>{{ number_format($data['part']['max']['expense'], 2, ',', ' ') }}&nbsp;{{ Auth::user()->getCurrency()->getValue() }}</td>
            <td>{{ number_format($data['part']['thisMonth']['expense'], 2, ',', ' ') }}&nbsp;{{ Auth::user()->getCurrency()->getValue() }}</td>
            <td>{!! $data['part']['max']['expense'] ? number_format($data['part']['thisMonth']['expense'] / $data['part']['max']['expense'] * 100, 2, ',', ' ') . '&nbsp;%' : '-' !!}</td>
        </tr>
        <tr>
            <th>{{ $trans->get('Statistics.FullMonth.Extremes.Average', 'AVERAGE:') }}</th>
            <td colspan="2">{{ number_format($data['part']['average'], 2, ',', ' ') }}&nbsp;{{ Auth::user()->getCurrency()->getValue() }}</td>
            <td>{{ number_format($data['part']['thisMonth']['expense'], 2, ',', ' ') }}&nbsp;{{ Auth::user()->getCurrency()->getValue() }}</td>
            <td>{!! $data['part']['average'] ? number_format($data['part']['thisMonth']['expense'] / $data['part']['average'] * 100, 2, ',', ' ') . '&nbsp;%' : '-' !!}</td>
        </tr>
        </tbody>
    </table>

    <table rules="all" id="partMonths">
        <thead>
        <tr>
            <th>{{ $trans->get('Statistics.TablePart.Head.Season', 'Month') }}</th>
            <th>{{ $trans->get('Statistics.TablePart.Head.Income', 'Monthly income') }}</th>
            <th>{{ $trans->get('Statistics.TablePart.Head.IncomesCnt', '#incomes') }}</th>
            <th>{{ $trans->get('Statistics.TablePart.Head.Expense', 'Monthly expense') }}</th>
            <th>{{ $trans->get('Statistics.TablePart.Head.ExpensesCnt', '#expenses') }}</th>
            <th colspan="2" class="thisMonthPrice">{{ $trans->get('Statistics.TablePart.Head.ThisMonth', 'Expense of this month') }}</th>
            <th>{{ $trans->get('Statistics.TablePart.Head.Percentage', 'Percentage') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data['part']['months'] as $month) <!-- todo: reverse -->
            <tr>
                <td>
                    {{ $month['year'] . '-' . $month['month'] }}
                </td>
                <td class="price">
                    {{ number_format($month['income'], 2, ',', ' ') }}&nbsp;{{ Auth::user()->getCurrency()->getValue() }}
                </td>
                <td>
                    {{ $month['incomesCnt'] }}
                </td>
                <td>
                    {{ number_format($month['expense'], 2, ',', ' ') }}&nbsp;{{ Auth::user()->getCurrency()->getValue() }}
                </td>
                <td>
                    {{ $month['expensesCnt'] }}
                </td>
                <td class="thisMonthPrice thisMonth price">
                    {{ number_format($data['part']['thisMonth']['expense'], 2, ',', ' ') }}&nbsp;{{ Auth::user()->getCurrency()->getValue() }}
                </td>
                <td class="thisMonth thisMonthCnt">
                    {{ $data['part']['thisMonth']['expensesCnt'] }}
                </td>
                <td>
                    {!! $month['expense'] ? number_format($data['part']['thisMonth']['expense'] / $month['expense'] * 100, 2, ',', ' ') . '&nbsp;%' : '-' !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>








<div id="fullMonth">
    <h2>{{ $trans->get('Statistics.FullMonth.H2', 'Comparsion with whole months') }}</h2>

    <div id="quick-preview-full"></div>
    {!! $fullGraph->render('ColumnChart', 'full', 'quick-preview-full') !!}

    <table rules="all" id="fullExtremeMonths">
        <thead>
        <tr>
            <th></th>
            <th>{{ $trans->get('Statistics.FullMonth.Extremes.Date', 'Date')}}</th>
            <th>{{ $trans->get('Statistics.FullMonth.Extremes.Value', 'Expense')}}</th>
            <th>{{ $trans->get('Statistics.FullMonth.Extremes.ThisMonth', 'This month')}}</th>
            <th>{{ $trans->get('Statistics.FullMonth.Extremes.Percentage', 'Percentage')}}</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th>{{ $trans->get('Statistics.FullMonth.Extremes.Min', 'MIN:') }}</th>
            <td>{{ $data['full']['min']['year'] }}-{{ $data['full']['min']['month'] }}</td>
            <td>{{ number_format($data['full']['min']['expense'], 2, ',', ' ') }}&nbsp;{{ Auth::user()->getCurrency()->getValue() }}</td>
            <td>{{ number_format($data['full']['thisMonth']['expense'], 2, ',', ' ') }}&nbsp;{{ Auth::user()->getCurrency()->getValue() }}</td>
            <td>{!! $data['full']['min']['expense'] ? number_format($data['full']['thisMonth']['expense'] / $data['full']['min']['expense'] * 100, 2, ',', ' ') . '&nbsp;%' : '-' !!}</td>
        </tr>
        <tr>
            <th>{{ $trans->get('Statistics.FullMonth.Extremes.Max', 'MAX:') }}</th>
            <td>{{ $data['full']['max']['year'] }}-{{ $data['full']['max']['month'] }}</td>
            <td>{{ number_format($data['full']['max']['expense'], 2, ',', ' ') }}&nbsp;{{ Auth::user()->getCurrency()->getValue() }}</td>
            <td>{{ number_format($data['full']['thisMonth']['expense'], 2, ',', ' ') }}&nbsp;{{ Auth::user()->getCurrency()->getValue() }}</td>
            <td>{!! $data['full']['max']['expense'] ? number_format($data['full']['thisMonth']['expense'] / $data['full']['max']['expense'] * 100, 2, ',', ' ') . '&nbsp;%' : '-' !!}</td>
        </tr>
        <tr>
            <th>{{ $trans->get('Statistics.FullMonth.Extremes.Average', 'AVERAGE:') }}</th>
            <td colspan="2">{{ number_format($data['full']['average'], 2, ',', ' ') }}&nbsp;{{ Auth::user()->getCurrency()->getValue() }}</td>
            <td>{{ number_format($data['full']['thisMonth']['expense'], 2, ',', ' ') }}&nbsp;{{ Auth::user()->getCurrency()->getValue() }}</td>
            <td>{!! $data['full']['average'] ? number_format($data['full']['thisMonth']['expense'] / $data['full']['average'] * 100, 2, ',', ' ') . '&nbsp;%' : '-' !!}</td>
        </tr>
        </tbody>
    </table>

    <table rules="all" id="fullMonths">
        <thead>
        <tr>
            <th>{{ $trans->get('Statistics.TableFull.Head.Season', 'Month') }}</th>
            <th>{{ $trans->get('Statistics.TableFull.Head.Income', 'Monthly income') }}</th>
            <th>{{ $trans->get('Statistics.TableFull.Head.IncomesCnt', '#incomes') }}</th>
            <th>{{ $trans->get('Statistics.TableFull.Head.Expense', 'Monthly expense') }}</th>
            <th>{{ $trans->get('Statistics.TableFull.Head.ExpensesCnt', '#expenses') }}</th>
            <th colspan="2" class="thisMonthPrice">{{ $trans->get('Statistics.TableFull.Head.ThisMonth', 'Expense of this month') }}</th>
            <th>{{ $trans->get('Statistics.TableFull.Head.Percentage', 'Percentage') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data['full']['months'] as $month) <!-- todo: reverse -->
        <tr>
            <td>
                {{ $month['year'] . '-' . $month['month'] }}
            </td>
            <td class="price">
                {{ number_format($month['income'], 2, ',', ' ') }}&nbsp;{{ Auth::user()->getCurrency()->getValue() }}
            </td>
            <td>
                {{ $month['incomesCnt'] }}
            </td>
            <td>
                {{ number_format($month['expense'], 2, ',', ' ') }}&nbsp;{{ Auth::user()->getCurrency()->getValue() }}
            </td>
            <td>
                {{ $month['expensesCnt'] }}
            </td>
            <td class="thisMonthPrice thisMonth price">
                {{ number_format($data['full']['thisMonth']['expense'], 2, ',', ' ') }}&nbsp;{{ Auth::user()->getCurrency()->getValue() }}
            </td>
            <td class="thisMonth thisMonthCnt">
                {{ $data['full']['thisMonth']['expensesCnt'] }}
            </td>
            <td>
                {!! $month['expense'] ? number_format($data['full']['thisMonth']['expense'] / $month['expense'] * 100, 2, ',', ' ') . '&nbsp;%' : '-' !!}
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
