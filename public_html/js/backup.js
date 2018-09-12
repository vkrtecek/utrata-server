/**
 * Created by vkrte_000 on 7. 7. 2018.
 */
function checkUpload(errCSV, errEmptyFile) {
    var element = document.getElementById('file');
    var file = element.files[0];
    if (file) {
        var path = element.value;
        var startIndex = path.lastIndexOf('.');
        var extention = path.substring(startIndex+1);
        if (extention.toLowerCase() !== "csv") {
            alert(errCSV);
            return false;
        }
        return true;
    } else {
        alert(errEmptyFile);
        return false;
    }
}

function seeFileName() {
    var fullPath = document.getElementById('file').value;
    var fileNames = fullPath.split('\\').length ? fullPath.split('\\') : fullPath.split('/');
    var fileName = fileNames[fileNames.length - 1];
    document.getElementById('fileName').innerHTML = fileName;
}


/**
 * downloads a file with backup
 * @param url string - where to request for data
 * @param username string
 */
function downloadBackup(url, username) {
    $.ajax({
        url: url,
        success: function (text) {
            var a = document.createElement('a');
            a.href = 'data:attachment/csv;charset=UTF8,' + encodeURIComponent(text);
            a.target = '_blank';
            a.download = username + '.csv';

            a.style.display = 'none';
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
        },
        error: function (e) {
            console.log(e);
        }
    });
}