$(document).ready(function () {
    $(".delete-user").click(function () {
        var fullName = $(this).parents("td").siblings('.fullname').text();
        var message = "آیا از حذف" + " « " + fullName + " » " + "اطمینان دارید؟";

        Swal.fire({
            title: message,
            text: "شما تنها مجاز به حذف کاربرانی هستید که در سیستم شما مشارکتی نداشته اند",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'نه بیخیال',
            cancelButtonText: 'آره مطمئنم',
        }).then((result) => {
            if (result.value || result.dismiss == "backdrop")
                return false;
            var form = $(this).parents('form');
            form.submit();
        });
    });

});

function showUserDeleteMessage() {

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
        title: 'کاربر با موفقیت حذف شد'
    });

}