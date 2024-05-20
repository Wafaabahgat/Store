(function ($) {

    $(".item-quantity").on("change", function (e) {
        const id = $(this).data("id");
        $.ajax({
            url: "/cart/" + id, //data-id
            method: "put",
            data: {
                quantity: $(this).val(),
                _token: csrf_token,
            },
            success: (res) => {
                alert('Item Updated!!');
            },
        });
    });

    $(".item-del").on("click", function (e) {
        const id = $(this).data("id");

        $.ajax({
            url: "/cart/" + id,  //data-id
            method: "delete",
            data: {
                _token: csrf_token,
            },
            success: (res) => {
                $(`#${id}`).remove();
                alert('Item Deleted!');
            },
        });
    });

})(jQuery);
