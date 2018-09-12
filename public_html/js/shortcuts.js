/* shortcuts */
$(document).keydown(function(e) {
    if (e.ctrlKey) {
        if (e.which === 72) {//Ctrl + H
            e.preventDefault();
            document.getElementById("_button_home").click();
        }
        if (e.which === 76) {//Ctrl + L
            e.preventDefault();
            document.getElementById("_button_logout").click();
        }
        if (e.which === 83) {//Ctrl + S
            e.preventDefault();
            document.getElementById("_button_settings").click();
        }


        if (e.which === 66) {//Ctrl + B
            var input = document.getElementById("_button_base");
            if (input) {
                e.preventDefault();
                input.click();
            }
        }
        if (e.which === 73) {//Ctrl + I
            var input = document.getElementById("_button_incomes");
            if (input) {
                e.preventDefault();
                input.click();
            }
        }
        if (e.which === 77) {//Ctrl + M
            var input = document.getElementById("_button_monthly_preview");
            if (input) {
                e.preventDefault();
                input.click();
            }
        }
        if (e.which === 79) {//Ctrl + O
            var input = document.getElementById("_button_archive");
            if (input) {
                e.preventDefault();
                input.click();
            }
        }
        if (e.which === 188) {//Ctrl + ,
            var input = document.getElementById("_button_new_item");
            if (input) {
                e.preventDefault();
                input.click();
            }
        }
        // if (e.which === 85) {//Ctrl + U
        //     e.preventDefault();
        //     alert('Ctrl+u');
        // }
    }
});
