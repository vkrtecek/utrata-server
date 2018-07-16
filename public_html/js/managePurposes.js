/**
 * Created by vkrte_000 on 6. 7. 2018.
 */
/**
 *
 * @param id integer
 * @param login string
 * @param elem HTML checkbox input element
 * @param createUrl string
 * @param deleteUrl string
 */
function togglePurpose(id, login,  elem, createUrl, deleteUrl) {
    var method = '';
    var url = '';
    var data = {
        user: login,
        purpose: id
    };
    if (elem.checked) {
        //add connection between user and purpose
        method = 'post';
        url = createUrl;
    } else {
        //destroy connection between user and purpose
        method = 'delete';
        url = deleteUrl;
    }
    $.ajax({
        method: method,
        url: url,
        data: data,
        error: function(e) {
            elem.checked = !elem.checked;
        }
    });
}