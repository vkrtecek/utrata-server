/**
 * Created by vkrte_000 on 7. 7. 2018.
 */

var inUpdate = false;

function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
}

function updateAllItems(url, urlPrintItems, state, conf = 'Do you really want to move this items to archive?') {
    if (!confirm(conf))
        return;
    var body = {
        state: state,
        month: $('#month').val(),
        notes: $('#notesList').val(),
        year: $('#filterYear').val(),
        pattern: $('#filterPattern').val(),
        orderBy: $('#orderBy').val(),
        orderHow: $('#orderHow').val()
    };
    $.ajax({
        url: url,
        method: 'put',
        data: body,
        error: function(e) {
            console.log(e);
        }
    });
    printItems(urlPrintItems, state);
}
/*
function updateItemMakeForm(itemId, url) {
    if(inUpdate)
        return;
    inUpdate = true;
    $.ajax({
        url: url,
        data: {

        },
        success: function(responseText) {
            $('#itemDiv_' + itemId).html(responseText);
        }
    });
}

function stornoUpdating(url, state) {
    printItems(url, state);
    inUpdate = false;
}

function acceptUpdating(url, urlPrintItems, state) {
    var body = {
        id: $('#_id').val(),
        name: $('#_name').val(),
        description: $('#_description').val(),
        note: {
            id: $('#_note').val()
        },
        type: $('#_type').val(),
        price: $('#_price').val(),
        currency: {
            code: $('#_currency').val()
        },
        course: $('#_course').val(),
        date: $('#_date').val(),
        wallet: $('#_wallet').val()
    };
    $.ajax({
        url: url,
        method: 'put',
        data: body,
        success: function() {
            printItems(urlPrintItems, state);
            inUpdate = false;
        }
    });
}*/

function updateItemRead(itemId, url, printUrl, state) {
    $.ajax({
        url: url,
        method: 'put',
        success: function() {
            printItems(printUrl, state);
        }
    });
}

function deleteItem(itemId, url, conf = 'Do you really want to delete this item?', printUrl, state) {
    if (!confirm(conf))
        return;
    $.ajax({
        url: url,
        method: 'delete',
        success: function() {
            printItems(printUrl, state);
        }
    });
}



function printItems(url, state) {
    var body = {
        state: state,
        month: $('#month').val(),
        notes: $('#notesList').val(),
        year: $('#filterYear').val(),
        pattern: $('#filterPattern').val(),
        orderBy: $('#orderBy').val(),
        orderHow: $('#orderHow').val(),
        limit: getUrlParameter('limit'),
        page: getUrlParameter('page'),
    };

    $.ajax({
        url: url,
        data: body,
        success: function(responseText) {
            $('#items').html(responseText);
        },
        error: function(e) {
            console.log(e);
            $('#items').html(e);
        }
    });
}
