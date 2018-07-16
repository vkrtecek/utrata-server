/**
 * Created by vkrte_000 on 7. 7. 2018.
 */

$('.otherCurrency').hide();

function enableOtherCurrency() {
    $('.otherCurrency').toggle();
}

/**
 *
 * @param myCurrency string
 */
function recountCourse(myCurrency) {
    var currency = $('#currency').val();
    $.ajax({
        url: 'http://api.fixer.io/latest?base=' + currency + '&to=' + myCurrency,
        success: function(course) {
            $('#course').val(course);
        }
    });
}