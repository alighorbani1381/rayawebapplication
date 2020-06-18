function sumAllPercent() {

    var $sumAllPer = 0;
    $('.progress-divide').each(function () {
        var percent = parseInt($(this).val());
        $sumAllPer = parseInt($sumAllPer + percent);
    });
    return $sumAllPer;

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




});