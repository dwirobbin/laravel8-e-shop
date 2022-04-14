$(document).ready(function () {

    loadCart();
    loadWishlist();

    function loadCart() {
        $.ajax({
            method: "GET",
            url: "/load-cart-data",
            success: function (response) {
                $('.cart-count').html('');
                $('.cart-count').html(response.count);
            }
        });
    }

    function loadWishlist() {
        $.ajax({
            method: "GET",
            url: "/load-wishlist-data",
            success: function (response) {
                $('.wishlist-count').html('');
                $('.wishlist-count').html(response.count);
            }
        });
    }


    $(".increment-btn").click(function (e) {
        e.preventDefault();

        // let inc_value = $(".qty-input").val();
        let inc_value = $(this).closest(".product_data").find(".qty-input").val();
        let value = parseInt(inc_value, 10);
        value = isNaN(value) ? 0 : value;
        if (value < 10) {
            value++;
            // $(".qty-input").val(value);
            $(this).closest(".product_data").find(".qty-input").val(value);
        }
    });

    $(".decrement-btn").click(function (e) {
        e.preventDefault();

        // let dec_value = $(".qty-input").val();
        let dec_value = $(this).closest(".product_data").find(".qty-input").val();
        let value = parseInt(dec_value, 10);
        value = isNaN(value) ? 0 : value;
        if (value > 0) {
            value--;
            // $(".qty-input").val(value);
            $(this).closest(".product_data").find(".qty-input").val(value);
        }
    });

    $(".addToCartBtn").click(function (e) {
        e.preventDefault();

        let product_id = $(this)
            .closest(".product_data")
            .find(".product_id")
            .val();
        let product_qty = $(this)
            .closest(".product_data")
            .find(".qty-input")
            .val();

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            method: "POST",
            url: "/add-to-cart",
            data: {
                product_id: product_id,
                product_qty: product_qty,
            },
            success: function (response) {
                Swal.fire(response.status);
                loadCart();
            },
        });
    });

    $('.delete-cart-item').click(function (e) {
        e.preventDefault();

        let product_id = $(this).closest(".product_data").find(".product_id").val();

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            method: "POST",
            url: "delete-cart-item",
            data: {
                'product_id' : product_id
            },
            success: function (response) {
                setTimeout(function(){
                    window.location.reload(1);
                 }, 1000);
                Swal.fire(response.status);
            }
        });
    });

    $('.remove-wishlist-item').click(function (e) {
        e.preventDefault();

        let product_id = $(this).closest(".product_data").find(".product_id").val();

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            method: "POST",
            url: "delete-wishlist-item",
            data: {
                'product_id' : product_id
            },
            success: function (response) {
                setTimeout(function(){
                    window.location.reload(1);
                 }, 1000);
                Swal.fire('', response.status, 'success');
            }
        });
    });

    $('.changeQuantity').click(function (e) {
        e.preventDefault();

        let product_id = $(this).closest(".product_data").find(".product_id").val();
        let quantity = $(this).closest(".product_data").find(".qty-input").val();

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            method: "POST",
            url: "update-cart",
            data: {
                'product_id' : product_id,
                'product_quantity' : quantity
            },
            success: function (response) {
                window.location.reload();
            }
        });

    });

    $('.addToWishlist').click(function (e) {
        e.preventDefault();

        let product_id = $(this).closest(".product_data").find(".product_id").val();

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            method: "POST",
            url: "/add-to-wishlist",
            data: {
                'product_id' : product_id
            },
            success: function (response) {
                Swal.fire(response.status);
                loadWishlist();
            }
        });
    });
});
