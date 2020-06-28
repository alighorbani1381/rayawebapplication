$(document).ready(function () {

    $("#change-password").on('click', function () {
        Swal.fire({
            title: "آیا از تغییر رمز عبورت مطمئنی؟!",
            text: "پیشنهاد میکنم رمز جدید رو روی کاغذ بنویس تا یه موقع فراموشش نکنی 😉",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'نه منصرف شدم',
            cancelButtonText: 'آره مطمئنم',
        }).then((result) => {
            if (result.value || result.dismiss == "backdrop")
                return false;
            var form = $(this).parents('form');
            form.submit();
        });
    });

});