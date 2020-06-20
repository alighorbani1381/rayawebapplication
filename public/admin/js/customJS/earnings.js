$(document).ready(function () {
    console.clear();

    function refreshBoxNames() {

        var $number = 0;
        $('.earning-holder').each(function () {
            var title = "name[" + $number + "]";
            var money ="received_money[" + $number + "]";
            var description = "description[" + $number + "]";
            var status = "status[" + $number + "]";

            $(this).find('.earning-title').attr('name', title);
            $(this).find('.earning-moeny').attr('name', money);
            $(this).find('.earning-description').attr('name', description);
            $(this).find('.earning-status').attr('name', status);
            $number+=1;
        });

    }

    $('#add-earning-box').on('click', function () {
        var box = $('.earning-holder').first().clone(true)
        $('#main-holders').append(box);
        refreshBoxNames();
    });

});