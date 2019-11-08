$(document).ready(function () {
    $('.btn-change-quantity').click(function () {
        let id = $(this).attr('data-id');
        let input = $(this).parent().parent().find('.input-quantity');
        $.ajax({
            type: "post",
            url: BASE_API + "stuffs/change_quantity",
            data: { id: id, quantity: input.val() },
            dataType: "json",
            success: function (response) {

            }
        });
    })

    $('.btn-change-price').click(function () {
        let id = $(this).attr('data-id');
        let input = $(this).parent().parent().find('.input-price');
        $.ajax({
            type: "post",
            url: BASE_API + "stuffs/change_price",
            data: { id: id, price: input.val() },
            dataType: "json",
            success: function (response) {
            }
        });
    })

    $('.btn-change-fee-inland-transport').click(function () {
        let id = $(this).attr('data-id');
        let input = $(this).parent().parent().find('.input-fee-inland-transport');
        $.ajax({
            type: "post",
            url: BASE_API + "orders/change_fee_inland_transport",
            data: { id: id, fee: input.val() },
            dataType: "json",
            success: function (response) {

            }
        });
    })

    $('.btn-change-fee-transport-cn-vn').click(function () {
        let id = $(this).attr('data-id');
        let input = $(this).parent().parent().find('.input-fee-transport-cn-vn');
        $.ajax({
            type: "post",
            url: BASE_API + "orders/change_fee_transport_cn_vn",
            data: { id: id, fee: input.val() },
            dataType: "json",
            success: function (response) {

            }
        });
    })

    $('.btn-change-fee-service').click(function () {
        let id = $(this).attr('data-id');
        let input = $(this).parent().parent().find('.input-fee-service');
        $.ajax({
            type: "post",
            url: BASE_API + "orders/change_fee_service",
            data: { id: id, fee: input.val() },
            dataType: "json",
            success: function (response) {

            }
        });
    })

    $('.btn-change-weight').click(function () {
        let id = $(this).attr('data-id');
        let input = $(this).parent().parent().find('.input-weight');
        $.ajax({
            type: "post",
            url: BASE_API + "orders/change_weight",
            data: { id: id, fee: input.val() },
            dataType: "json",
            success: function (response) {

            }
        });
    })






    $('.btn-add-link').click(function () {
        let thiss = $(this);
        let id = $(this).attr('data-id');
        let input = $(this).parent().parent().find('.input-add-link');
        $.ajax({
            type: "post",
            url: BASE_API + "orders/add_link",
            data: { id: id, link: input.val() },
            dataType: "json",
            success: function (response) {
                let id = response.id;
                let html_link = '<div class="link-elm" style="display: flex;">' 
                html_link += '<a style="display: block" href="'+input.val()+'" target="_blank">'+input.val()+'</a>';
                html_link += '<a class="btn-del-link text-red" data-id="'+id+'">Xoá</a>';
                html_link += '</div>';
                thiss.parent().parent().find('.wrap-links').append(html_link);
            }
        });
    })

    $('.wrap-links').on('click', '.btn-del-link', function () {
        let thiss = $(this);
        let id = $(this).attr('data-id');
        $.ajax({
            type: "post",
            url: BASE_API + "orders/del_link",
            data: { id: id },
            dataType: "json",
            success: function (response) {
                thiss.closest('.link-elm').remove();
            }
        });
    })




    $('.btn-change-wood-package').click(function () {
        let id = $(this).attr('data-id');
        let input = $(this).parent().parent().find('.input-fee-wood-package');
        $.ajax({
            type: "post",
            url: BASE_API + "orders/change_wood_package",
            data: { id: id, fee: input.val() },
            dataType: "json",
            success: function (response) {

            }
        });
    })

    $('.btn-change-code-order-cn').click(function () {
        let id = $(this).attr('data-id');
        let input = $(this).parent().parent().find('.input-code-order-cn');
        $.ajax({
            type: "post",
            url: BASE_API + "orders/change_code_order_cn",
            data: { id: id, code: input.val() },
            dataType: "json",
            success: function (response) {

            }
        });
    })

    $('.btn-change-buy-account').click(function () {
        let id = $(this).attr('data-id');
        let input = $(this).parent().parent().find('.input-buy-account');
        $.ajax({
            type: "post",
            url: BASE_API + "orders/change_buy_account",
            data: { id: id, account: input.val() },
            dataType: "json",
            success: function (response) {

            }
        });
    })

    $('.btn-change-note-admin').click(function () {
        let id = $(this).attr('data-id');
        let input = $(this).parent().parent().find('.input-note-admin');
        $.ajax({
            type: "post",
            url: BASE_API + "orders/change_note_admin",
            data: { id: id, note_admin: input.val() },
            dataType: "json",
            success: function (response) {

            }
        });
    })

    $('.btn-comment').click(function () {
        let id_order = $(this).attr('data-id');
        let user = $(this).attr('data-user');
        let input = $(this).parent().parent().find('.input-comment');
        let thiss = $(this);
        $.ajax({
            type: "post",
            url: BASE_API + "orders/send_comment",
            data: { id_user: id_user, id_order: id_order, comment: input.val() },
            dataType: "json",
            success: function (response) {
                if (response['success'] == 1) {
                    let html_comment = '';
                    html_comment += '<div class="">';
                    html_comment += '<p style="margin-bottom: 0;" class="">- ' + user + '</p>';
                    html_comment += '<p style="margin-top: 0px; padding-left: 15px; font-weight: 400;" class="">' + input.val() + '</p>';
                    html_comment += '</div>';

                    thiss.closest('.wrapper-comments').find('.cm-element').append(html_comment);

                    thiss.parent().parent().find('.input-comment').val('');
                }
            }
        });
    })










    $('.btn-china-transfer-bill').click(function () {
        let id = $(this).attr('data-id');
        let input = $(this).prev();
        $.ajax({
            type: "post",
            url: BASE_API + "orders/change_lading",
            data: { id: id, lading: input.val() },
            dataType: "json",
            success: function (response) {

            }
        });
    });

    $('.btn-update-exchange-rate').click(function () {
        $(this).hide();
        $(this).parent().find('.form-update-exchange-rate').show();
    });

    $('.form-update-exchange-rate .btn-cancel').click(function (e) {
        $(this).parent().hide();
        $(this).parent().next().show();
    });

    $('.form-update-exchange-rate .btn-update').click(function (e) {
        let input = $(this).parent().find('.input-exchange-rate');
        var $this = $(this);
        $.ajax({
            type: "post",
            url: BASE_API + "orders/change_exchange_rate",
            data: { id: $(this).attr('data-id'), exchange_rate: input.val() },
            dataType: "json",
            success: function (response) {
                $this.parent().hide();
                $this.parent().next().show();
                $this.parent().parent().find('.exchange-rate').html(input.val());
            }
        });
    });

    $('.btn-update-status').click(function (e) {
        let data = $(this).attr('data-status');
        let id = $(this).attr('data-id');
        let thiss = $(this);
        let html_txt = $(this).html();
        $.ajax({
            type: "post",
            url: BASE_API + "orders/change_status",
            data: { status: data, id: id },
            dataType: "json",
            success: function (response) {
                thiss.closest('.group-btn-status').find('.status-txt').html(html_txt);
                location.reload();
            }
        });
    })


    $('.btn-change-stuff-status').click(function (e) {
        let c = confirm("Bạn chắc chắn muốn cập nhật sản phẩm này là hết hàng ?");
        if (!c) {
            return;
        }
        let id = $(this).attr('data-id');
        let id_order = $(this).attr('data-order');
        $.ajax({
            type: "post",
            url: BASE_API + "stuffs/change_status",
            data: { id: id, id_order: id_order },
            dataType: "json",
            success: function (response) {

            }
        });
    })

    $('.btn-edit-link').click(function () {
        let link = $(this).prev().attr('href');
        $(this).prev().hide();
        $(this).prev().prev().show();
        $(this).prev().prev().val(link);
        $(this).next().show();
        $('.btn-update-link').click(function () {
            let id = $(this).attr('data-id');
            $(this).prev().prev().show();
            var link = $(this).prev().prev().prev().val();
            var $this = $(this);

            $.ajax({
                type: "post",
                url: BASE_API + "stuffs/change_link",
                data: { link: link, id: id },
                dataType: "json",
                success: function (response) {
                    $this.prev().prev().attr('href', link);
                    $this.prev().prev().text(link);
                    $this.prev().prev().prev().hide();
                    $this.hide();
                }
            });

        })
    })
});