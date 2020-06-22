$(document).ready(function () {
    // Configuration Ajax Headers (CSRF Token Laravel)
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});
function minMbox(message, timeout) {
    $(window).on('load', function () {
        setTimeout(function () {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-start',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                onOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });

            Toast.fire({
                icon: 'success',
                title: message,
            });
        }, timeout);

    });
}

function maxMbox(titleText, messageText, iconText, btnText, timeout) {
    $(window).on('load', function () {
        setTimeout(function () {
            Swal.fire({
                icon: iconText,
                title: titleText,
                text: messageText,
                confirmButtonText: btnText,
            });
        }, timeout);

    });

}