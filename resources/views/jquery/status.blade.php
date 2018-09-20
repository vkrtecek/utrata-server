@inject('formatter', 'App\Model\Help\DateFormatter')
@inject('trans', 'App\Model\Service\ITranslationService')

<em>{{ $trans->get('Status.Card', 'Rest in card') }}:</em> <strong name="check_K" onclick="updateState('{{ route('get.checkstate.status', ['id' => $wallet['id']]) }}', 'karta', 'checkstates', '{{ $wallet['cardRest'] }}', '{{ route('put.wallet.checkState', ['id' => $wallet['id']]) }}')" class="statusBtn {{ (float)$wallet['cardRest'] < 0 ? 'red' : ((float)$wallet['cardRest'] == 0 ? 'violet' : '') }}" >{{ number_format($wallet['cardRest'], 2, ',', ' ') . ' ' . $member->getCurrency()->getValue() }}</strong>
<span title="{{ $wallet['checkState']['card']['value'] }}">{{ $formatter->dateToReadableFormat($wallet['checkState']['card']['checked']) }}</span>
<br />
<em>{{ $trans->get('Status.Cash', 'Rest in cash') }}:</em> <strong name="check_H" onclick="updateState('{{ route('get.checkstate.status', ['id' => $wallet['id']]) }}', 'hotovost', 'checkstates', '{{ $wallet['cashRest'] }}', '{{ route('put.wallet.checkState', ['id' => $wallet['id']]) }}')" class="statusBtn {{ (float)$wallet['cashRest'] < 0 ? 'red' : ((float)$wallet['cashRest'] == 0 ? 'violet' : '') }}" >{{ number_format($wallet['cashRest'], 2, ',', ' ') . ' ' . $member->getCurrency()->getValue() }}</strong>
<span title="{{ $wallet['checkState']['cash']['value'] }}">{{ $formatter->dateToReadableFormat($wallet['checkState']['cash']['checked']) }}</span>
