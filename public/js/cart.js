var formatterCNY = new Intl.NumberFormat('zh-CN', {
    style: 'currency',
    currency: 'CNY',
});

var formatterVND = new Intl.NumberFormat('vi-VN', {
    style: 'currency',
    currency: 'VND',
});

$(document).ready(function () {
    $('.btn-plus').click(function (e) {
        let parent = $(this).closest('.item-wrapper');

        let input = parent.find('.input-quantity');
        let quantity = parseInt(input.val());
        input.val(quantity + 1);
        calcAmount(parent, function () { });
    });

    $('.btn-minus').click(function (e) {
        let parent = $(this).closest('.item-wrapper');

        let input = parent.find('.input-quantity');
        let quantity = parseInt(input.val());
        if (quantity > 1) {
            input.val(quantity - 1);
            calcAmount(parent, function () { });
        }
    });

    $('.input-quantity').blur(function (e) {
        let parent = $(this).closest('.item-wrapper');
        let input = parent.find('.input-quantity');
        let quantity = parseInt(input.val());
        if (quantity >= 1) {
            input.val(quantity);
            calcAmount(parent, function () { });

        } else {
            input.val(1);
        }
    });

    function calcAmount(parent, quantity, func) {
        parent.each(function () {
            let thiss = $(this);
            let data = JSON.parse($(this).find('.input-quantity').attr('data-config'));
            $.ajax({
                type: "get",
                url: BASE_URL + "users/cart/update",
                dataType: "json",
                data: {
                    owner_type: data.owner_type,
                    shop: data.shop,
                    index: data.index,
                    quantity: parseInt(parent.find('.input-quantity').val())
                },
                success: function (response) {
                    // func();

                    let input = thiss.find('.input-quantity');
                    let CNYPrice = thiss.find('.input-cny-price').val();
                    CNYPrice = parseFloat(CNYPrice);
                    let stuffCNYPrice = parseInt(input.val()) * CNYPrice;

                    let VNDPrice = thiss.find('.input-vnd-price').val();
                    VNDPrice = parseFloat(VNDPrice);
                    let stuffVNDPrice = parseInt(input.val()) * VNDPrice;
                    thiss.find('.stuff-cny-price strong').text(formatterCNY.format(stuffCNYPrice));
                    thiss.find('.stuff-vnd-price strong').text(formatterVND.format(stuffVNDPrice));

                    let table = thiss.closest('.box');
                    var stuffsPrice = 0;
                    let fee = 0;
                    if (table.find('.check-item-elm:checked').length > 0) {
                        table.find('.check-item-elm:checked').each(function () {
                            let inputQuantity = parseInt($(this).closest('.item-wrapper').find('.input-quantity').val());
                            let inputVNDPrice = parseFloat($(this).closest('.item-wrapper').find('.input-vnd-price').val());
                            if (!isNaN(inputQuantity) && !isNaN(inputVNDPrice)) {
                                stuffsPrice = stuffsPrice + (inputQuantity * inputVNDPrice);
                                console.log(stuffsPrice);
                            }
                            //fee 10 percent
                            fee = (stuffsPrice / 100) * buy_fee;
                            table.closest('.box').find('.stuffs-amount').text(formatterVND.format(stuffsPrice));
                            table.closest('.item-wrapper').find('.input-fee-order').val(fee);
                            table.closest('.item-wrapper').find('.fee-order').text(formatterVND.format(fee));
                            table.closest('.item-wrapper').find('input[name="total"]').val(fee + stuffsPrice);

                            table.closest('.box').find('.input-stuffs-price').val(stuffsPrice);
                            table.closest('.box').find('.count-fee-order').text(formatterVND.format(fee));
                            table.closest('.box').find('.final-amount').text(formatterVND.format(fee + stuffsPrice));

                            thiss.closest('.item-wrapper').find('.price-only-item').val(stuffVNDPrice);
                            calc_price();
                        });
                    } else {
                        table.closest('.box').find('.stuffs-amount').text(formatterVND.format(0));
                        table.closest('.box').find('.input-stuffs-price').val(0);
                        table.closest('.box').find('.count-fee-order').text(formatterVND.format(0));
                        table.closest('.box').find('.final-amount').text(formatterVND.format(0));

                        thiss.closest('.item-wrapper').find('.price-only-item').val(0);
                        calc_price();
                    }

                    var html_miss_amount = '';
                    // if ((stuffsPrice + fee) > user_amount) {
                    //     html_btn = '<a href="' + url_deposit + '" style="margin-top:10px" class="btn btn-danger">Nạp tiền</a>';

                    //     html_miss_amount += '<label class="col-sm-6 control-label text-uppercase" style="padding-top: 5px;">Còn thiếu:</label>';
                    //     html_miss_amount += '<div class="col-sm-6 pull-right"><p class="text-right text-red text-bold6" style="font-size: 20px">';
                    //     html_miss_amount += '<strong class="miss-amount">' + formatterVND.format((fee + stuffsPrice) - user_amount) + '</strong>';
                    //     html_miss_amount += '</p>';
                    //     html_miss_amount += '</div>';
                    // }
                    // if ((stuffsPrice + fee) < user_amount) {
                    //     html_btn = '<button type="submit" class="btn btn-primary" style="margin-top:10px">Đặt hàng</button>';
                    //     html_miss_amount = '';
                    // }

                    //parent_btn.find('.miss-amount-wrapper').html(html_miss_amount);
                    //parent_btn.find('.btn-order-wrapper').html(html_btn);
                }
            });
        })
    }


    // $('.rpw').on('click', '.btn-order-total[type="button"]', function(){
    //     alert('Bạn chưa lựa chọn sản phẩm nào');
    // });

    // $('.box').on('click', '.btn-add-order[type="button"]', function(){
    //     alert('Bạn chưa lựa chọn sản phẩm nào');
    // });



    didloadview();
    function didloadview() {
        $('.box .check-item-ip:checked').each(function () {
            let html_od_owner_name = $(this).closest('.box').find('.od-owner-name');
            let html_od_rate = $(this).closest('.box').find('.od-rate');

            $('.group-all-ip').append(html_od_owner_name.clone(true));
            $('.group-all-ip').append(html_od_rate.clone(true));

            if (($(this).closest('.box').find('.check-item-elm:checked')).length > 0) {
                $(this).closest('.box').find('.check-item-ip').prop('checked', true);
                ($(this).closest('.box').find('.check-item-elm:checked')).each(function () {

                    let html_od_ind_item = $(this).closest('.item-wrapper').find('.od-ind-item');

                    $(this).closest('.box').find('.group-ip').append(html_od_ind_item.clone(true));
                    // $('.group-all-ip').append(html_od_note.clone(true));

                    $('.group-all-ip').append(html_od_ind_item.clone(true));

                    let parent = $(this).closest('.item-wrapper');
                    calcAmount(parent, function () { });
                });

                $(this).closest('.box').find('.check-item-elm:not(:checked)').each(function () {
                    let temp_id = $(this).closest('.item-wrapper').find('.od-ind-item').data('only');
                    $('.group-ip .od-ind-item[data-only="' + temp_id + '"]').remove();
                    $('.group-all-ip .od-ind-item[data-only="' + temp_id + '"]').remove();
                });


                $(this).closest('.box').find('.btn-add-order').prop('type', 'submit');
            } else {
                $(this).closest('.box').find('.check-item-ip').prop('checked', false);
                $(this).closest('.box').find('.group-ip .od-ind-item').remove();

                $('.group-all-ip .od-owner-name[data-only="' + html_od_owner_name.data('only') + '"]').remove();
                $('.group-all-ip .od-rate[data-only="' + html_od_rate.data('only') + '"]').remove();
                // $('.group-all-ip .od-note[data-only="'+html_od_note.data('only')+'"]').remove();

                $(this).closest('.box').find('.check-item-elm').each(function () {
                    let temp_id = $(this).closest('.item-wrapper').find('.od-ind-item').data('only');
                    $('.group-all-ip .od-ind-item[data-only="' + temp_id + '"]').remove();
                });

                $(this).closest('.box').find('.btn-add-order').prop('type', 'button');
                $(this).closest('.box').find('.btn-add-order').attr('data-toggle', 'modal');
                $(this).closest('.box').find('.btn-add-order').attr('data-target', '#tickModal');
            }
        });
        calc_price();

        $('.box .check-item-ip:not(:checked)').each(function () {
            $(this).closest('.box').find('.stuffs-amount').text(formatterVND.format(0));
            $(this).closest('.box').find('.input-stuffs-price').val(0);
            $(this).closest('.box').find('.count-fee-order').text(formatterVND.format(0));
            $(this).closest('.box').find('.final-amount').text(formatterVND.format(0));

            $(this).closest('.item-wrapper').find('.price-only-item').val(0);

            $(this).closest('.box').find('.btn-add-order').prop('type', 'button');
            $(this).closest('.box').find('.btn-add-order').attr('data-toggle', 'modal');
            $(this).closest('.box').find('.btn-add-order').attr('data-target', '#tickModal');
        });
    }




    $('.check-item-ip').change(function () {

        let html_od_owner_name = $(this).closest('.box').find('.od-owner-name');
        // let only_od_owner_name = $(this).closest('.box').find('.od-owner-name').data('only');

        let html_od_ind_item = $(this).closest('.box').find('.od-ind-item');
        // let only_od_ind_item = $(this).closest('.box').find('.od-ind-item').data('only');

        let html_od_rate = $(this).closest('.box').find('.od-rate');
        // let only_od_rate = $(this).closest('.box').find('.od-rate').data('only');

        // let html_od_note = $(this).closest('.box').find('.od-note');
        // let only_od_rate = $(this).closest('.box').find('.od-rate').data('only');

        if ($(this).is(":checked") == true) {
            $(this).closest('.box').find('.check-item-elm').prop('checked', true);

            $(this).closest('.box').find('.group-ip').append(html_od_ind_item.clone(true));

            $('.group-all-ip').append(html_od_owner_name.clone(true));
            $('.group-all-ip').append(html_od_rate.clone(true));
            $('.group-all-ip').append(html_od_ind_item.clone(true));
            // $('.group-all-ip').append(html_od_note.clone(true));


            $(this).closest('.box').find('.btn-add-order').prop('type', 'submit');
            $(this).closest('.box').find('.btn-add-order').removeAttr('data-toggle');
            $(this).closest('.box').find('.btn-add-order').removeAttr('data-target');
        } else {
            $(this).closest('.box').find('.check-item-elm').prop('checked', false);
            $(this).closest('.box').find('.group-ip .od-ind-item').remove();

            $(this).closest('.box').find('.check-item-elm').each(function () {
                let temp_id = $(this).closest('.item-wrapper').find('.od-ind-item').data('only');
                $('.group-all-ip .od-ind-item[data-only="' + temp_id + '"]').remove();
            });

            $('.group-all-ip .od-owner-name[data-only="' + html_od_owner_name.data('only') + '"]').remove();
            $('.group-all-ip .od-rate[data-only="' + html_od_rate.data('only') + '"]').remove();
            // $('.group-all-ip .od-note[data-only="'+html_od_note.data('only')+'"]').remove();


            $(this).closest('.box').find('.btn-add-order').prop('type', 'button');
            $(this).closest('.box').find('.btn-add-order').attr('data-toggle', 'modal');
            $(this).closest('.box').find('.btn-add-order').attr('data-target', '#tickModal');
        }
        calc_price();



        let parent = $(this).closest('.box').find('.item-wrapper');
        calcAmount(parent, function () { });
    });

    $('.box').on('change', '.check-item-elm', function () {

        let html_od_owner_name = $(this).closest('.box').find('.od-owner-name');
        let html_od_ind_item = $(this).closest('.item-wrapper').find('.od-ind-item');
        let html_od_rate = $(this).closest('.box').find('.od-rate');
        // let html_od_note = $(this).closest('.box').find('.od-note');

        if (($(this).closest('.box').find('.check-item-elm:checked')).length > 0) {
            $(this).closest('.box').find('.check-item-ip').prop('checked', true);

            $(this).closest('.box').find('.group-ip').append(html_od_ind_item.clone(true));

            $('.group-all-ip').append(html_od_owner_name.clone(true));
            $('.group-all-ip').append(html_od_rate.clone(true));
            // $('.group-all-ip').append(html_od_note.clone(true));

            $('.group-all-ip').append(html_od_ind_item.clone(true));

            $(this).closest('.box').find('.check-item-elm:not(:checked)').each(function () {
                let temp_id = $(this).closest('.item-wrapper').find('.od-ind-item').data('only');
                $('.group-ip .od-ind-item[data-only="' + temp_id + '"]').remove();
                $('.group-all-ip .od-ind-item[data-only="' + temp_id + '"]').remove();
            });


            $(this).closest('.box').find('.btn-add-order').prop('type', 'submit');
        } else {
            $(this).closest('.box').find('.check-item-ip').prop('checked', false);
            $(this).closest('.box').find('.group-ip .od-ind-item').remove();

            $('.group-all-ip .od-owner-name[data-only="' + html_od_owner_name.data('only') + '"]').remove();
            $('.group-all-ip .od-ind-item[data-only="' + html_od_ind_item.data('only') + '"]').remove();
            $('.group-all-ip .od-rate[data-only="' + html_od_rate.data('only') + '"]').remove();
            // $('.group-all-ip .od-note[data-only="'+html_od_note.data('only')+'"]').remove();

            $(this).closest('.box').find('.check-item-elm').each(function () {
                let temp_id = $(this).closest('.item-wrapper').find('.od-ind-item').data('only');
                $('.group-all-ip .od-ind-item[data-only="' + temp_id + '"]').remove();
            });


            $(this).closest('.box').find('.btn-add-order').prop('type', 'button');
            $(this).closest('.box').find('.btn-add-order').attr('data-toggle', 'modal');
            $(this).closest('.box').find('.btn-add-order').attr('data-target', '#tickModal');
        }
        calc_price();


        let parent = $(this).closest('.item-wrapper');
        calcAmount(parent, function () { });
    });

    function calc_price() {
        var price = 0;
        var service = 0;
        var total = 0;
        let item_checked = $('.check-item-elm:checked');
        let shop_checked = $('.check-item-ip:checked');

        if (item_checked.length > 0) {
            $('.btn-order-total').prop('type', 'submit');
        } else {
            $('.btn-order-total').prop('type', 'button');
            $('.btn-order-total').attr('data-toggle', 'modal');
            $('.btn-order-total').attr('data-target', '#tickModal');
        }

        item_checked.each(function () {
            price = price * 1 + (($(this).closest('.item-wrapper').find('.price-only-item')).val()) * 1;
        });

        service = (price / 100) * buy_fee;
        total = price + service;

        $('.numb-price').html(formatterVND.format(price));
        $('.numb-item').html(item_checked.length);
        $('.numb-shop').html(shop_checked.length);

        $('.numb-service').html(formatterVND.format(service));
        $('.numb-total').html(formatterVND.format(total));
    };



    var link = null;

    $('.btn-del').click(function () {
        link = $(this).data('link');
    });

    $('.confirm-del').click(function () {
        window.location.href = link;
        link = null;
    });
});