/**
 * Created by vkrte_000 on 7. 7. 2018.
 */

var inUpdate = false;

function clearSearch() {

}

function resizeNotes() {

}

function updateAllItems() {
    alert('coming soon');
}

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
}

function updateItemRead(itemId, url) {
    $.ajax({
        url: url,
        method: 'put',
        success: function() {
            document.getElementById('itemDiv_' + itemId).style.display = 'none';
        }
    });
}

function deleteItem(itemId, url) {
    $.ajax({
        url: url,
        method: 'delete',
        success: function() {
            document.getElementById('itemDiv_' + itemId).style.display = 'none';
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
        orderHow: $('#orderHow').val()
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