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
        
    });




});