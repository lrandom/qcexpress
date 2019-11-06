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
        let parent = $(this).parent().parent();

        let parent_btn = $(this).closest('.box-body');

        let input = parent.find('.input-quantity');
        let quantity = parseInt(input.val());

        let data = JSON.parse($(this).attr('data-config'));
        let owner_type = data.owner_type;
        let shop = data.shop;
        let index = data.index;
        calcAmount(parent, parent_btn, owner_type, shop, index, quantity, function () {
            input.val(quantity + 1);
        });
    });

    $('.btn-minus').click(function (e) {
        let parent = $(this).parent().parent();

        let parent_btn = $(this).closest('.box-body');

        let input = parent.find('.input-quantity');
        let quantity = parseInt(input.val());
        if (quantity > 1) {
            let data = JSON.parse($(this).attr('data-config'));
            let owner_type = data.owner_type;
            let shop = data.shop;
            let index = data.index;
            calcAmount(parent, parent_btn, owner_type, shop, index, quantity, function () {
                input.val(quantity - 1);
            });
        }
    });

    $('.input-quantity').blur(function (e) {
        let parent = $(this).parent();
        let parent_btn = $(this).closest('.box-body');
        let input = parent.find('.input-quantity');
        let quantity = parseInt(input.val());
        if (quantity > 1) {
            let data = JSON.parse($(this).attr('data-config'));
            let owner_type = data.owner_type;
            let shop = data.shop;
            let index = data.index;
            calcAmount(parent, parent_btn, owner_type, shop, index, quantity, function () {
                input.val(quantity);
            });
        } else {
            input.val(1);
        }
    });

    function calcAmount(parent, parent_btn, owner_type, shop, index, quantity, func) {
        $.ajax({
            type: "get",
            url: BASE_URL + "users/cart/update?owner_type=1&shop=831821984&index=1&quantity=65",
            dataType: "json",
            data: {
                owner_type: owner_type,
                shop: shop,
                index: index,
                quantity: quantity
            },
            success: function (response) {
                func();
                let input = parent.find('.input-quantity');
                let CNYPrice = parent.find('.input-cny-price').val();
                CNYPrice = parseFloat(CNYPrice);
                let stuffCNYPrice = parseInt(input.val()) * CNYPrice;

                let VNDPrice = parent.find('.input-vnd-price').val();
                VNDPrice = parseFloat(VNDPrice);
                let stuffVNDPrice = parseInt(input.val()) * VNDPrice;
                parent.parent().find('.stuff-cny-price strong').text(formatterCNY.format(stuffCNYPrice));
                parent.parent().find('.stuff-vnd-price strong').text(formatterVND.format(stuffVNDPrice));

                let table = parent.parent().parent().parent().parent();
                var stuffsPrice = 0;
                let fee = 0;
                table.find('table').find('tr').each(function () {
                    let inputQuantity = parseInt($(this).find('.input-quantity').val());
                    let inputVNDPrice = parseFloat($(this).find('.input-vnd-price').val());
                    if (!isNaN(inputQuantity) && !isNaN(inputVNDPrice)) {
                        stuffsPrice = stuffsPrice + (inputQuantity * inputVNDPrice);
                        console.log(stuffsPrice);
                    }
                    //fee 10 percent
                    fee = (stuffsPrice / 100) * buy_fee;
                    table.next().find('.input-stuffs-price').val(stuffsPrice);
                    table.next().find('.stuffs-amount').text(formatterVND.format(stuffsPrice));
                    table.next().find('.input-fee-order').val(fee);
                    table.next().find('.fee-order').text(formatterVND.format(fee));
                    table.next().find('.final-amount').text(formatterVND.format(fee + stuffsPrice));
                    table.next().find('input[name="total"]').val(fee + stuffsPrice);
                });

                var html_miss_amount = '';
                if ((stuffsPrice + fee) > user_amount && per_deposit > 0) {
                    html_btn = '<a href="' + url_deposit + '" style="margin-top:10px" class="btn btn-danger">Nạp tiền</a>';
                    html_miss_amount += '<label class="col-sm-6 control-label text-uppercase" style="padding-top: 5px;">Còn thiếu:</label>';
                    html_miss_amount += '<div class="col-sm-6 pull-right"><p class="text-right text-red text-bold6" style="font-size: 20px">';
                    html_miss_amount += '<strong class="miss-amount">' + formatterVND.format((fee + stuffsPrice) - user_amount) + '</strong>';
                    html_miss_amount += '</p>';
                    html_miss_amount += '</div>';
                }


                if ((stuffsPrice + fee) < user_amount) {
                    html_btn = '<button type="submit" class="btn btn-primary" style="margin-top:10px">Đặt hàng</button>';
                    html_miss_amount = '';
                }

                parent_btn.find('.miss-amount-wrapper').html(html_miss_amount);
                parent_btn.find('.btn-order-wrapper').html(html_btn);
            }
        });

    }
});