$(document).ready(function () {

    

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


    $(".ajax-loading").hide();
    //Given Data From Category Id
    $(document).on('change', '#project', function () {
        console.clear();
        var isNeedContractor = $('input[name=contractor_pay]:checked', '#project-form').val();
        if (isNeedContractor != 'true'){
            hideAjaxLoading();
            return false;
        }

        var projectId = $(this).val();
        showAjaxLoading();
        changeContractorValue();
        
    });

    $('input[type="radio"]#deactive').on('click change', function(e) {
        hideAjaxLoading();
    });

    $('input[type="radio"]#project-pay').on('click change', function(e) {
        setTimeout(function () {
            Swal.fire({
                icon: 'success',
                title: "حالت پرداخت به پیمانکار فعال شد.",
                text: "الان فقط کافیه پروژه مورد نظرت رو انتخاب کنی تا پیمانکاران اون پروژه رو دریافت کنی",
                confirmButtonText: "باشه مرسی",
            });
        }, 300);
    });

    $('input[type="radio"]#normal-pay').on('click change', function(e) {
        setTimeout(function () {
            Swal.fire({
                icon: 'success',
                title: "حالت پرداخت معمولی (غیر پروژه ای) برای پیمانکاران فعال شد.",
                text: "از این گزینه برای پرداخت هایی انجام می شود که ارتباطی با پروژه ندارد برای مثال پرداختی های مدیر برای خودش",
                confirmButtonText: "باشه مرسی",
            });
        }, 300);
    });

    function showAjaxLoading() {
        $('#project').css('width', '92%');
        setTimeout(function () {
            $(".ajax-loading").fadeIn();
        }, 250);
    }

    function hideAjaxLoading() {
        $(".ajax-loading").fadeOut();
        $('#project').css('width', '100%');
    }


    //Send Category id with Ajax and Recive this properties
    function changeContractorValue(id) {
        $.ajax({
            url: '/admin/give/contractor',
            type: 'get',
            dataType: 'json',
            data: {
                project_id: id
            },
            success: function (data) {
                // for (var i = 0; i < data.filters.length; i++)
                //     $("#parent_id").append('<option value=" ' + data.filters[i].id + '" >' + data.filters[i].persian_name + '</option>');
                alert('successful');
                console.log(data);
            }
        });
    }

});