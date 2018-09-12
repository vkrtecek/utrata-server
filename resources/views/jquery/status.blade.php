@inject('formatter', 'App\Model\Help\DateFormatter')
@inject('trans', 'App\Model\Service\ITranslationService')

<em>{{ $trans->get('Status.Card', 'Rest in card') }}: <button name="check_K" onclick="updateState('{{ route('get.checkstate.status', ['id' => $wallet['id']]) }}', 'karta', 'checkstates', '{{ $wallet['cardRest'] }}', '{{ route('put.wallet.checkState', ['id' => $wallet['id']]) }}')">{{ $wallet['cardRest'] . ' ' . $member->getCurrency()->getValue() }}</button></em>
<span title="{{ $wallet['checkState']['card']['value'] }}">{{ $formatter->dateToReadableFormat($wallet['checkState']['card']['checked']) }}</span>
<br />
<em>{{ $trans->get('Status.Cash', 'Rest in cash') }}: <button name="check_H" onclick="updateState('{{ route('get.checkstate.status', ['id' => $wallet['id']]) }}', 'hotovost', 'checkstates', '{{ $wallet['cashRest'] }}', '{{ route('put.wallet.checkState', ['id' => $wallet['id']]) }}')">{{ $wallet['cashRest'] . ' ' . $member->getCurrency()->getValue() }}</button></em>
<span title="{{ $wallet['checkState']['cash']['value'] }}">{{ $formatter->dateToReadableFormat($wallet['checkState']['cash']['checked']) }}</span>
