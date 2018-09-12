/**
 * get monthly statistics and draw it into div
 * @param url string - where to request for data
 * @param divID string - id of div whose content will be overwritten
 */
function printStatistics(url, divID) {
    document.getElementById(divID).innerHTML = '<span id="statistics-loading"></span>';

    var notes = $("#notesList").val();
    if (notes == "" || notes == null)
        notes = null;

    $.ajax({
        url: url + '?noteId=' + notes,
        success: function (text) {
            document.getElementById(divID).innerHTML = text;
        },
        error: function (e) {
            console.log(e);
            document.getElementById(divID).innerHTML = '500 - Internal Server Error';
        }
    });
}
