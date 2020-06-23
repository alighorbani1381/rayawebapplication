$(document).ready(function () {
    $(".ajax-loading").hide();


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





    $(document).on('change', '#project', function () {
        var isNeedContractor = $('input[name=contractor_pay]:checked', '#project-form').val();
        if (isNeedContractor != 'true') {
            hideAjaxLoading();
            return false;
        }

        var projectId = $(this).val();
        showAjaxLoading();
        hideContractorBox();
        renameContractorLabel('لیست کارمندان');
        clearContractorBox();
        getProjectContractors(projectId);


    });

    $('input[type="radio"]#deactive').on('click change', function (e) {
        showProjectBox();
        hideAjaxLoading();
        hideContractorBox();
        clearContractorBox();
    });

    $('input[type="radio"]#project-pay').on('click change', function (e) {
        var projectId = $("#project option:first").val();       
        setTimeout(function () {
            Swal.fire({
                icon: 'success',
                title: "حالت پرداخت به کارمند (بابت انجام پروژه) فعال شد.",
                text: "الان فقط کافیه پروژه مورد نظرت رو انتخاب کنی تا کارمندان اون پروژه رو دریافت کنی",
                confirmButtonText: "باشه مرسی",
            });
        }, 300);
        showProjectBox();
        hideContractorBox();
        getProjectContractors(projectId);
        $('#project').prop('selectedIndex',0);
    });

    $('input[type="radio"]#normal-pay').on('click change', function (e) {
        setTimeout(function () {
            Swal.fire({
                icon: 'success',
                title: "حالت پرداخت معمولی (غیر پروژه ای) برای کارمندان فعال شد.",
                text: "از این گزینه برای پرداخت هایی انجام می شود که ارتباطی با پروژه ندارد برای مثال پرداختی های مدیر برای خودش",
                confirmButtonText: "باشه مرسی",
            });
        }, 300);
        hideProjectBox();
        hideAjaxLoading();
        clearContractorBox();
        renameContractorLabel('لیست کارمندان');
        getContractors();
    });

    $("#clear-form").on('click', function(){
        showProjectBox();
        hideAjaxLoading();
        hideContractorBox();
        clearContractorBox();
    });

    function showAjaxLoading() {
        $('#project').css('width', '92%');
        setTimeout(function () {
            $(".ajax-loading").fadeIn();
        }, 250);
    }

    function hideAjaxLoading() {
        $(".ajax-loading").fadeOut();
        $('#project').delay(200).animate({ width: "100%", });


    }


    // Get Contractor From Server it's Related to Normal pay
    function getContractors() {
        $.ajax({
            url: '/admin/give/contractor',
            type: 'get',
            dataType: 'json',
            data: {
                type: 'all'
            },
            success: function (data) {
                clearContractorBox();

                if (data.admins.length != 0) {
                    $("#contractors-box").append('<optgroup label="مدیران">');
                    for (var i = 0; i < data.admins.length; i++) {
                        var fullName = data.admins[i].name + " " + data.admins[i].lastname;
                        $("#contractors-box").append('<option value=" ' + data.admins[i].id + '" >' + fullName + '</option>');
                    }
                    $("#contractors-box").append('</optgroup>');
                }

                if (data.contractors.length != 0) {
                    $("#contractors-box").append('<optgroup label="کارمندان">');
                    for (var i = 0; i < data.contractors.length; i++) {
                        var fullName = data.contractors[i].name + " " + data.contractors[i].lastname;
                        $("#contractors-box").append('<option value=" ' + data.contractors[i].id + '" >' + fullName + '</option>');
                    }
                    $("#contractors-box").append('</optgroup>');
                }

                showContractorBox();
            }
        });
    }

    function getProjectContractors(id) {
        $.ajax({
            url: '/admin/give/contractor',
            type: 'get',
            dataType: 'json',
            data: {
                project_id: id
            },
            success: function (data) {
                clearContractorBox();
                renameContractorLabel('کارمندان این پروژه');
                if (data.contractors.length != 0) {
                    for (var i = 0; i < data.contractors.length; i++) {
                        var fullName = data.contractors[i].name + " " + data.contractors[i].lastname;
                        $("#contractors-box").append('<option value=" ' + data.contractors[i].id + '" >' + fullName + '</option>');
                    }
                }


                hideAjaxLoading();
                showContractorBox();
            }
        });
    }

    function showContractorBox() {
        $("#contractor-mainbox").fadeIn();
    }

    function hideContractorBox() {
        $("#contractor-mainbox").fadeOut();
    }

    function showProjectBox() {
        $("#project-box").fadeIn();
    }

    function hideProjectBox() {
        $("#project-box").fadeOut();
    }

    function renameContractorLabel(newName) {
        $("#contractor-label").text(newName);
    }

    function clearContractorBox() {
        $("#contractors-box").html('');
    }

});