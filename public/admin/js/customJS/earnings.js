$(document).ready(function () {
    console.clear();

    function refreshBoxNames() {

        var $number = 0;
        $('.earning-holder').each(function () {
            var title = "name[" + $number + "]";
            var money = "received_money[" + $number + "]";
            var description = "description[" + $number + "]";
            var status = "status[" + $number + "]";

            $(this).find('.earning-title').attr('name', title);
            $(this).find('.earning-moeny').attr('name', money);
            $(this).find('.earning-description').attr('name', description);
            $(this).find('.earning-status').attr('name', status);
            $number += 1;
        });

    }

    function mustExistOneBox(){
        setTimeout(function () {
            Swal.fire({
                icon: 'warning',
                title: "داداش داری اشتباه میزنی !",
                text: " اینجا باید حداقل یه فیلد وجود داشته باشه" + "😐😑",
                confirmButtonText: "حله",
            });
        }, 250);
    }

    // Add Earning Button Click
    $('#add-earning-box').on('click', function () {
        var box = $('.earning-holder').first().clone(true)
        $('#main-holders').hide().append(box).fadeIn();
        refreshBoxNames();
    });

    // Delete Box
    $('.delete-box').on('click', function () {
        var boxCount = $('.earning-holder').length;
        if (boxCount == 1){
            mustExistOneBox();
            return false;
        }
        $(this).parents('.earning-holder').remove();
        $('#main-holders').hide().fadeIn();
        refreshBoxNames();
    });

});