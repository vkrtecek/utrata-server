/**
 * Created by vkrte_000 on 7. 7. 2018.
 */

$('.otherCurrency').hide();

function enableOtherCurrency() {
    $('.otherCurrency').toggle();
}

/**
 * get course between myCurrency and selected currency
 * @param myCurrency string
 * @param url string - where to get data
 * @param inputId string - id of input where course will be printed
 * @param select input whole select with selected currency recount to
 */
function recountCourse(myCurrency, url, inputId, select) {
    var currency = select.value;
    var data = {
        from: myCurrency,
        to: currency,
    };
    $.ajax({
        url: url,
        data: data,
        success: function(course) {
            $('#' + inputId).val(course);
        }
    });
}

function switchVyberOdepsat(type) {
    if (type === 'vyber') {
        $('#odepsat').attr('selected', false);
    }
    if (type === 'odepsat') {
        $('#odepsat').attr('selected', false);
    }

}
