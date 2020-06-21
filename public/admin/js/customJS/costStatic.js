$(document).ready(function () {
    // Delete Static Cost Item
    $('.delete-cost-static').on('click', function () {
        var costStatic = $(this).parents('td').siblings('td.costStatic').text();
        var child = parseInt($(this).parents('td').siblings('td.costStatic').attr('child'));

        if (child == 0) {
            Swal.fire({
                title: "گزینه انتخابی شما سرگروه است آیا از حذف آن اطمینان دارید؟",
                text: "با حدف این گزینه تمامی زیر گروه ها و اطلاعات مربوط به آن ها از سیستم پاک خواهد شد. در حذف سرگروه ها بسیار دقت کنید.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'نه منصرف شدم',
                cancelButtonText: 'آره مطمئنم',
            }).then((result) => {                
                if (result.value || result.dismiss == "backdrop")
                    return false;
                    alert("form submited !!");
                //var form = $(this).parents('form');
                //form.submit();
            });
            return false;
        }
        var message = "آیا از حذف هزینه ثابت   «" + costStatic + "»" + " مطمئن هستید ؟ ";
        Swal.fire({
            title: message,
            text: "در حدف هزینه های ثابت دقت کنید چون با حذف آن ها تمامی اطلاعات و هزینه های ثبت شده به اسم آن ها از سیستم پاک خواهد شد.",
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
});