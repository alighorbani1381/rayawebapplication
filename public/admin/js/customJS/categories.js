$(document).ready(function () {

    $(".delete-button").click(function () {
        var fullName = $(this).parents("td").siblings('td.categoryName').text();
        var message = "آیا از حذف دسته بندی" + " « " + fullName + " » " + "اطمینان دارید؟";

        Swal.fire({
            title: message,
            text: "با حدف این دسته بندی تمامی پروژه های مربوط به آن از بین می رود",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'نه بیخیال',
            cancelButtonText: 'آره مطمئنم',
        }).then((result) => {
            if (result.value)
                return false;
            var form = $(this).parents('form');
            form.submit();
        });
    });

});

