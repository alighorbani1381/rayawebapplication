function sumAllPercent() {

    var $sumAllPer = 0;
    $('.progress-divide').each(function () {
        var percent = parseInt($(this).val());
        $sumAllPer = parseInt($sumAllPer + percent);
    });
    return $sumAllPer;

}

function countOfContractor() {
    var $count = 0;
    $('.progress-divide').each(function () {
        $count += 1;
    });
    return $count;
}


$(document).ready(function () {

    console.clear();

    $("#price").bind('change', function () {
        var price = parseInt($(this).val());
        if (price <= 0)
            $(this).val(1);
    });


    $('.progress-divide').bind('keyup input change', function () {
        $('#All-Percent').removeClass("parsley-error");
        $('#All-Percent').removeClass("sucsok");
        $('#All-Percent').addClass("sucsok");
        var $sumAll = 0;
        var typePercent = parseInt($(this).val());
        if (typePercent <= 0)
            $(this).val(1);

        $('.progress-divide').each(function () {
            var value = $(this).val();
            if (value == "")
                $(this).val(1);

            var percent = parseInt($(this).val());
            $sumAll = parseInt($sumAll + percent);
        });

        if ($sumAll > 100) {
            var sum = sumAllPercent();
            var extra = parseInt($sumAll - 100);
            $(this).val(typePercent - extra);
        }

        var sumAllAgain = sumAllPercent();
        $('#All-Percent').val(sumAllAgain);

        if ($sumAll < 100)
            $('#All-Percent').addClass("parsley-error");



    });

    // Auto Divider Percent for Contractors
    $('#auto-divide').click(function () {
        var count = countOfContractor();
        var percent = Math.round(100 / count);
        var $personPercent = [];
        for (i = 0; i < count; i++) {
            var extra = 100 - (percent * i);

            if (i == (count - 1))
                $personPercent[i] = extra;
            else
                $personPercent[i] = percent;
        }
        var $number = 0;
        $('.progress-divide').each(function () {
            $(this).val($personPercent[$number]);
            $number += 1;
        });
        $('#All-Percent').removeClass("parsley-error");
        $('#All-Percent').addClass("sucsok");
        $('#All-Percent').val(100);
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
                title: 'وظایف تا حد ممکن مساوی تقسیم شدند.'
            });

        }, 150);


    });

    $('li a#contractors-tab').on('click', function () {
        var isActive = $(this).attr('taskdivide');
        if (isActive == "false")
            Swal.fire({
                icon: 'warning',
                title: "هشدار این پروژه غیر فعال است !",
                text: "همونطور که تو صفحه اول هم توضیح دادم شما باید از قسمت پیمانکاران این پروژه تو همین صفحه وظایف رو میون پیمانکار های این پروژه تقسیم کنی.",
                confirmButtonText: "حله گرفتم",
            });
        return false;


    });

    $('#divide-contractor').on('click', function () {
        Swal.fire({
            title: "آیا از تقسیم وظایف بین پیمانکاران اطمینان دارید؟!",
            text: "این تنظیمات به دلایل امنیتی قابل تغییر نیستند.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'نه بزار دوباره چک کنم',
            cancelButtonText: 'آره مطمئنم',
        }).then((result) => {
            if (result.value)
                return false;
            var form = $(this).parents('form');
            form.submit();
        });
    });




});