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

/**
 * updates checkstate and redraw div
 * @param url string - where to call for update
 * @param type string - karta/hotovost
 * @param divId string - id of div to be redrawn
 * @param value float - value of new chceckstate
 * @param printUrl string - where to get content in server
 */
function updateState(url, type, divId, value, printUrl) {
    var body = {
        type: type,
        value: value
    };

    $.ajax({
        url: url,
        method: 'put',
        data: body,
        success: function (text) {
            printStatus(printUrl, divId);
        },
        error: function (e) {
            console.log(e);
        }
    });
}

/**
 * prints card and cash status into div with given ID
 * @param url string - where to get content in server
 * @param divId string - div to be overwritten
 */
function printStatus(url, divId) {
    $.ajax({
        url: url,
        success: function(text) {
            document.getElementById(divId).innerHTML = text;
        },
        error: function(e) {
            console.log(e);
        }
    });
}
