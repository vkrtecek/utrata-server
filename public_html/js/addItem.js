$("#otherCurrency").hide();

function enableOtherCurrencyToggle() {
    $('#otherCurrency').toggle();
}

function recountCourse(from, inputId) {
    var to = '';
}

function switchVyberOdepsat(type) {
    if (type === 'vyber') {
        $('#odepsat').attr('selected', false);
    }
    if (type === 'odepsat') {
        $('#odepsat').attr('selected', false);
    }
    
}