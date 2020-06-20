$(document).ready(function () {
    console.clear();

    function clearCloneBox(box) {
        box.find('.earning-title').val('');
        box.find('.earning-moeny').val('');
        box.find('.earning-description').val('');
        box.find('.earning-status').val('');
    }

    function refreshBoxNames() {

        var $number = 0;
        $('.earning-holder').each(function () {
            var title = "title[" + $number + "]";
            var money = "received_money[" + $number + "]";
            var description = "description[" + $number + "]";
            var status = "status[" + $number + "]";

            $(this).find('.earning-title').attr('name', title);
            $(this).find('.earning-moeny').attr('name', money);
            $(this).find('.earning-description').attr('name', description);
            $(this).find('.earning-paid').attr('name', status);
            $(this).find('.earning-unpaid').attr('name', status);
            $number += 1;
        });

    }

    function mustExistOneBox() {
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
        var box = $('.earning-holder').eq(0).clone(true);
        clearCloneBox(box);

        $('#main-holders').hide().append(box).fadeIn();
        refreshBoxNames();
    });

    // Delete Box
    $('.delete-box').on('click', function () {
        var boxCount = $('.earning-holder').length;
        if (boxCount == 1) {
            mustExistOneBox();
            return false;
        }
        $(this).parents('.earning-holder').remove();
        $('#main-holders').hide().fadeIn();
        refreshBoxNames();
    });

    // Control Recieve Money Input
    $('.earning-moeny').bind('input keyup change', function () {
        var value = parseInt($(this).val());

        if (isNaN(value))
            $(this).val('1');

        if (value <= 0)
            $(this).val('1');
    });

    // Delete Earning Item
    $('.delete-earning').on('click', function () {
        var earningName = $(this).parents('td').siblings('td.earningName').text();
        var projectName = $(this).parents('td').siblings('td.projectName').text();
        var message = "آیا از حذف در آمد   «" + earningName + "»" + " برای پروژه " + "«" + projectName + "»" + " مطمئن هستید ؟ ";
        Swal.fire({
            title: message,
            text: "با حدف این درآمد تمامی اطلاعات مربوط به آن از سیستم پاک خواهد شد.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'نه منصرف شدم',
            cancelButtonText: 'آره مطمئنم',
        }).then((result) => {
            if (result.value)
                return false;
            var form = $(this).parents('form');
            form.submit();
        });
    });

    // Update Earning Ask
    $('#update-earning').on('click', function () {
        Swal.fire({
            title: "آیا از بروزرسانی این مورد اطمینان دارید؟",
            text: " اگر از تغییر این اطلاعات مطمئن هستید رو گزینه آره مطمئنم کلیک کنید. ",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'نه منصرف شدم',
            cancelButtonText: 'آره مطمئنم',
        }).then((result) => {
            if (result.value)
                return false;
            var form = $(this).parents('form');
            form.submit();
        });
    });

    $("#create-earning").on('click', function(){
        var form = $(this).parents('form');
        form.submit();
    });

});