$(document).ready(function () {

    console.clear();
    $('.delete-cost').on('click', function () {
        var cost = $(this).parents('td').siblings('td.costTitle').text();
        var type = $(this).parents('td').siblings('td.costTitle').attr('type');
        switch (type) {
            case 'extra':
                var message = "گزینه مورد نظر شما" + " « " + cost + " » " + "یک هزینه جانبی است آیا از حذف آن مطمئن هستید؟";
                Swal.fire({
                    title: message,
                    text: "با حذف این هزینه  اطلاعات آن برای همیشه از سیستم پاک خواهشد شد.",
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
                break;

            case 'project_base':
                var projectName = $(this).parents('td').siblings('td.projectName').text();
                var message = "گزینه مورد نظر شما" + " « " + cost + " » " + "یک هزینه پایه در پروژه" + " « " + projectName + " » " + "است آیا از حذف آن مطمئن هستید؟";
                Swal.fire({
                    title: message,
                    text: "در صورت حذف هزینه مورد نظر برای این پروژه حذف و از درون سیستم پاک می شود.",
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
                break;

            case 'contractor':
                break;
        }



    });



});