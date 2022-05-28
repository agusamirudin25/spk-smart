function success_alert(title, msg, page) {
    Swal.fire({
        icon: 'success',
        title: title,
        text: msg,
        timer: 3500,
        footer: '',
        showCancelButton: false,
        showConfirmButton: false
    }).then(function() {
        window.location = page;
    })
}

function error_alert(title, msg) {
    Swal.fire({
        icon: 'error',
        title: title,
        text: msg
    })
}

// Custom Library
$.fn.number = function(){
    $(this).on('keypress', function (e) {
        var regex = new RegExp(/^[0-9\s]+$/);
        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        if (regex.test(str)) {
            return true;
        }
        else {
            e.preventDefault();
            return false;
        }
    });
}

$.fn.maxLength = function(max){
    $(this).on('keypress', function(e){
        if(e.target.value.length >= max){
            return false;
        }
    })
}