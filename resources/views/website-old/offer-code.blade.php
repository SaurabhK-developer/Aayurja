<script>
    $('#add_free_offer_save_button').click(function () {
        sessionStorage.setItem('promo_discount', 0)
    });
    var coupontype = 0;
    onLoadValidation();
    function onLoadValidation(){
        //Calculation on page load
        var subTotal = $("#item-total-price").text().replace(/.+\s/, '');
        var promo_discount = '0';
        if (sessionStorage.getItem('promo_discount') != null) {
            var product_price = `<?php echo json_encode($product_data); ?>`;
            product_price = JSON.parse(product_price);
            var each_product_id = <?php echo json_encode($each_product_id); ?>;
            var product_discount_ids = sessionStorage.getItem('product_discount_id') ? sessionStorage.getItem(
                'product_discount_id') : '[]';
            product_discount_ids = JSON.parse(product_discount_ids);

            $.each(each_product_id, function(key, value) {
                for (const cart_product_id of product_discount_ids) {
                    if (cart_product_id == value) {
                        var discount = sessionStorage.getItem('promo_discount_percentage') ?
                            sessionStorage.getItem('promo_discount_percentage') : 0.00;
                        var item_price = product_price[value];
                        loop_discount = parseFloat(item_price) * parseFloat(discount) / 100;
                        $("#product_price-" + value).html('INR ' + parseInt(item_price - loop_discount))
                        $("#product_spacial_coupon_" + value).append(
                            `<p class="special-discount">Coupon Applied</p>`);
                    }
                }
            })

            promo_discount = sessionStorage.getItem('promo_discount');
            var cupon_id = localStorage.getItem('applied_cupon')
            $("#coupon_code").val(cupon_id);
            $('#removepromodiscount').show();
            $(".applycoupon").css({
                'display': 'none'
            });
        } else if (sessionStorage.getItem('couponamountdiscount') != null) {
            promo_discount = sessionStorage.getItem('couponamountdiscount');
            coupontype = 5;
            var cupon_id = localStorage.getItem('applied_cupon')
            $("#coupon_code").val(cupon_id);
            $('#removepromodiscount').show();
            $(".applycoupon").css({
                'display': 'none'
            });
        } else {
            $('#removepromodiscount').hide();
        }

        if (coupontype != 5) {
            subTotal = subTotal - promo_discount;
        }
        if (coupontype == 5) {
            subTotal = subTotal - promo_discount;
        }
        $(".promo_discount").text("INR" + ' ' + promo_discount);
        $('#promo_discount_txt').val(promo_discount);
      

        var grandTotal = 0;
        if (coupontype == 5) {
            grandTotal = +subTotal;
        } else {
            grandTotal = +subTotal;
        }
        $("#totalvalue").html('<span>' + "INR" + '</span> ' + grandTotal);
    };
    
    function findapplycouponfunction() {
        $("#cupon_success").html('')
        var path = "{{ URL::to('find_coupon_type') }}"
        var _token = "{{ csrf_token() }}"
        var coupon = $("#coupon_code").val();

        formData = {
            _token,
            coupon
        }
        $.ajax({
            method: 'POST',
            url: path,
            dataType: 'JSON',
            data: formData,
            success: function(res) {
                if (res.status === 201) {
                    if (res.type == 5) {
                        applyCouponAmountCode();
                        coupontype = 5;
                    } else if (res.type == 8) {
                        applyCuponCodeProduct();
                        coupontype = 8;
                    } else if (res.type == 9) {
                        applyCuponCodeFreeProduct();
                        coupontype = 9;
                    } else {
                        applyCuponCode(res.type);
                        coupontype = 0;
                    }
                } else {
                    $("#cupon_success").css({
                        'display': 'block',
                        'color': '#ef0c0c',
                        'font-weight': '500',
                        'margin-left': '0.6em'
                    });
                    $("#cupon_success").text("Invalid Coupon Code.");
                }
            }
        })
    }

    function applyCouponAmountCode() {
        var cupon = $("#coupon_code").val();
        var path = "{{ URL::to('apply_coupon_amount_code') }}"
        var _token = "{{ csrf_token() }}"
        formData = {
            _token,
            cupon
        }
        $.ajax({
            method: 'POST',
            url: path,
            dataType: 'JSON',
            data: formData,
            success: function(res) {
                localStorage.setItem('applied_cupon', res.cupon_id.toUpperCase())
                if (res.status === 201) {
                    var promo_discount = res.discount;
                    var cupon_id = res.cupon_id;
                    var item_total = $("#item-total-price").text().replace(/.+\s/, '');

                    if (promo_discount > parseInt(item_total)) {
                        alert('Subtotal should be less than or equal to ' + "INR" + ' ' +promo_discount)
                        return false
                    }
                    var total_amount = +item_total - +promo_discount;
                    total_amount = +total_amount;
                    var grandTotal = total_amount

                    $("#totalvalue").html('<span>INR</span> ' + grandTotal);
                   
                   
                    
                    sessionStorage.setItem('couponamountdiscount', promo_discount)
                    coupontype = 5;

                    $('#removepromodiscount').show();

                    $("#cupon_id").val(cupon_id);

                    $("#cupon_success").css({
                        'display': 'block',
                        'color': 'green',
                        'font-weight': 'bold'
                    });
                    $("#cupon_success").text("Coupon Amount Of " + "INR" + ' ' + promo_discount +
                        ' Successfully Applied.');
                    

                    $(".applycoupon").css({
                        'display': 'none'
                    });
                } else {
                    $("#cupon_success").css({
                        'display': 'block',
                        'color': '#ef0c0c',
                        'font-weight': '500',
                        'margin-left': '0.6em'
                    });
                    $("#cupon_success").text("Invalid Coupon Code.");
                }
            }
        })
    }

    function applyCuponCodeProduct() {

        var cupon = $("#coupon_code").val();
        var path = "{{ url('apply_cupon_code_on_product') }}";
        var _token = "{{ csrf_token() }}"
        formData = {
            _token,
            cupon
        }
        $.ajax({
        method: 'POST',
        url: path,
        dataType: 'JSON',
        data: formData,
        success: function(res) {
            localStorage.setItem('applied_cupon', res.cupon_id.toUpperCase())
            if (res.status === 201) {
                var check_product_apply = false;
                var discount = res.discount;
                var cupon_id = res.cupon_id;
                var product_id = res.product_id;
                var each_product_id = <?php echo json_encode($each_product_id); ?>;
                const output = each_product_id.filter(function(obj) {
                    return product_id.indexOf(obj) !== -1;
                });
                var product_price = `<?php echo json_encode($product_data); ?>`;
                product_price = JSON.parse(product_price);
                var temp_promo_discount = 0
                $.each(product_id, function(key, value) {

                    var loop_discount = 0
                    for (const cart_product_id of output) {
                        if (cart_product_id == value) {
                            check_product_apply = true;
                            var item_price = product_price[value];
                            loop_discount = parseFloat(item_price) * parseFloat(discount) / 100;
                            temp_promo_discount += loop_discount;
                            $("#product_price-" + value).html('INR ' + parseInt(item_price -
                                loop_discount))
                            $("#product_spacial_coupon_" + value).append(
                                `<p class="special-discount">Coupon Applied</p>`);
                        } else {
                            $("#cupon_success").css({
                                'display': 'block',
                                'color': '#ef0c0c',
                                'font-weight': '500',
                                'margin-left': '0.6em'
                            });
                            $("#cupon_success").text("Invalid Coupon Code.");
                        }
                    }

                });
                if (check_product_apply) {
                    var item_total = $("#item-total-price").text().replace(/.+\s/, '');
                    
                    temp_promo_discount = parseFloat(temp_promo_discount)
                    var total_amount = +item_total - +temp_promo_discount;
                    total_amount = +total_amount.toFixed(2);
                    
                    $("#totalvalue").html('<span>' + "INR" + '</span> ' + total_amount.toFixed(2));
                    $(".promo_discount").text("INR" + ' ' + temp_promo_discount.toFixed(2));
                    $('#promo_discount_txt').val(temp_promo_discount.toFixed(2));
                   
                    sessionStorage.setItem('promo_discount', temp_promo_discount)
                    sessionStorage.setItem('promo_discount_percentage', discount)
                    product_ids = JSON.stringify(product_id);
                    sessionStorage.setItem('product_discount_id', product_ids)
                    $("#promodiscount").val(temp_promo_discount);
                    $('#removepromodiscount').show();
                    $("#cupon_id").val(cupon_id);
                    $("#cupon_success").css({
                        'display': 'block',
                        'color': 'green',
                        'font-weight': 'bold'
                    });
                    $("#cupon_success").text("Coupon Applied Successfully");
                    $(".removecoupon").css({
                        'display': 'block'
                    });
                    // $("#coupon_code").hide();
                    $(".applycoupon").css({
                        'display': 'none'
                    });
                } else {
                    $("#cupon_success").css({
                        'display': 'block',
                        'color': '#ef0c0c',
                        'font-weight': '500',
                        'margin-left': '0.6em'
                    });
                    $("#cupon_success").text("Invalid Coupon Code.");
                }
            } else if (res.status === 401 && res.message === 'limit_is_0') {
                $("#cupon_success").css({
                    'display': 'block',
                    'color': '#ef0c0c',
                    'font-weight': '500',
                    'margin-left': '0.6em'
                });
                $("#cupon_success").text("Coupon code has reached the max limit! ");
            } else if (res.status === 401 && res.message === 'limit_reached') {
                $("#cupon_success").css({
                    'display': 'block',
                    'color': '#ef0c0c',
                    'font-weight': '500',
                    'margin-left': '0.6em'
                });
                $("#cupon_success").text("Coupon code has reached the max limit!! ");
            } else {
                $("#cupon_success").css({
                    'display': 'block',
                    'color': '#ef0c0c',
                    'font-weight': '500',
                    'margin-left': '0.6em'
                });
                $("#cupon_success").text("Invalid Coupon Code.");
            }
        }
        })
    }

    function applyCuponCodeFreeProduct() {

        var cupon = $("#coupon_code").val();
        var path = "{{ url('apply_cupon_code_for_free_product') }}";
        var _token = "{{ csrf_token() }}"
        formData = {
            _token,
            cupon
        }
        $.ajax({
            method: 'POST',
            url: path,
            dataType: 'JSON',
            data: formData,
            success: function(res) {
                localStorage.setItem('applied_cupon', res.cupon_id.toUpperCase())

                if (res.status === 201) {
                    var discount = res.discount;
                    var cupon_id = res.cupon_id;
                    var product_id = res.product_id;
                    var new_product_id = res.product_id.id;

                    $.ajax({
                        method: 'POST',
                        url: "{{ url('add-offer-product-on-cart') }}",
                        dataType: 'JSON',
                        data: {
                            _token,
                            new_product_id
                        },
                        success: function(response) {
                            if (response.status === 201) {
                                add_free_offer_options(response.type, product_id.product_name,
                                    response.flavours, new_product_id,
                                    response.weight)
                            }
                        }
                    })

                } else if (res.status === 401 && res.message === 'limit_is_0') {
                    $("#cupon_success").css({
                        'display': 'block',
                        'color': '#ef0c0c',
                        'font-weight': '500',
                        'margin-left': '0.6em'
                    });
                    $("#cupon_success").text("Coupon code has reached the max limit! ");
                } else if (res.status === 401 && res.message === 'limit_reached') {
                    $("#cupon_success").css({
                        'display': 'block',
                        'color': '#ef0c0c',
                        'font-weight': '500',
                        'margin-left': '0.6em'
                    });
                    $("#cupon_success").text("Coupon code has reached the max limit!! ");
                } else {
                    $("#cupon_success").css({
                        'display': 'block',
                        'color': '#ef0c0c',
                        'font-weight': '500',
                        'margin-left': '0.6em'
                    });
                    $("#cupon_success").text("Invalid Coupon Code.");
                }
            }
        })
    }

    function add_free_offer_options(type, product_name, option_array, product_id, weight = null) {
            $("#add_free_offer_product_name").text(product_name);
            $("#add_free_offer_product_id").val(product_id);
            $("#add_free_offer_weight").val(weight);
                $("#add_free_offer_option").html('');
                $('#add_free_offer_option').append("<option selected disabled>Select</option>")
                $.each(option_array, function(key, value) {
                    console.log(key,value)
                    if (!value.out_of_stock) {
                        $('#add_free_offer_option')
                            .append($("<option></option>")
                                .attr("value", value.flavour)
                                .text(value.flavour));
                    }
                });
                $('#add_free_offer_save_button').addClass('normal');
                $('#add_free_offer_save_button').removeClass('merchandies')

            // jQuery.noConflict(); 
            $("#add_free_offer").modal('show');
        }

    function applyCuponCode(type) {
        var cupon = $("#coupon_code").val();
        var path = "{{ url('apply_cupon_code') }}";
        var _token = "{{ csrf_token() }}"

        formData = {
            _token,
            cupon,
            type
        }

        $.ajax({
            method: 'POST',
            url: path,
            dataType: 'JSON',
            data: formData,
            success: function(res) {
                localStorage.setItem('applied_cupon', res.cupon_id.toUpperCase())
                if (res.status === 201) {
                    var check_product_apply = false;
                    var discount = res.discount;
                    var cupon_id = res.cupon_id;
                    var product_id = res.product_id;
                    var each_product_id = <?php echo json_encode($each_product_id); ?>;
                    var diff = $(each_product_id).not(product_id).get();

                    var product_price = `<?php echo json_encode($product_data); ?>`;
                    product_price = JSON.parse(product_price);
                    var temp_promo_discount = 0
                    
                    $.each(diff, function(key, value) {
                        var loop_discount = 0
                        check_product_apply = true;
                        var item_price = product_price[value];
                        loop_discount = parseFloat(item_price) * parseFloat(discount) / 100;
                        temp_promo_discount += loop_discount;

                    });
                    if (check_product_apply) {
                        var item_total = $("#item-total-price").text().replace(/.+\s/, '');
                        temp_promo_discount = parseFloat(temp_promo_discount)
                        var total_amount = +item_total - +temp_promo_discount;
                        total_amount = +total_amount.toFixed(2);

                        $("#totalvalue").html('<span>' + "INR" + '</span> ' + total_amount.toFixed(2));
                            $(".promo_discount").text("INR" + ' ' + temp_promo_discount.toFixed(2));
                    $('#promo_discount_txt').val(temp_promo_discount.toFixed(2));

                            
                        sessionStorage.setItem('promo_discount', temp_promo_discount)
                        sessionStorage.setItem('promo_discount_percentage', discount)
                        $("#promodiscount").val(temp_promo_discount);
                        $('#removepromodiscount').show();
                        $("#cupon_id").val(cupon_id);
                        $("#cupon_success").css({
                            'display': 'block',
                            'color': 'green',
                            'font-weight': 'bold'
                        });
                        $("#cupon_success").text("Coupon Applied Successfully");
                        $(".removecoupon").css({
                            'display': 'block'
                        });
                        // $("#check-gift").hide();
                        $(".applycoupon").css({
                            'display': 'none'
                        });
                    } else {
                        $("#cupon_success").css({
                            'display': 'block',
                            'color': '#ef0c0c',
                            'font-weight': '500',
                            'margin-left': '0.6em'
                        });
                        $("#cupon_success").text("Offer does not exist on combos");
                    }
                } else {
                    $("#cupon_success").text("Invalid Coupon Code.");
                    $("#cupon_success").css({
                        'display': 'block',
                        'color': '#ef0c0c;',
                        'font-weight': '500',
                        'margin-left': '0.6em'
                    });
                    $("#cupon_success").addClass('err_msg');
                }
            }
        })
    }

    function removeCuponCode() {

        var cupon = $("#coupon_code").val();
        var subTotal = $("#item-total-price").text().replace(/.+\s/, '');
        var promo_discount = "INR" + ' 0';
        
        $(".promo_discount").text(promo_discount);
        $('#promo_discount_txt').val(0);

        var grandTotal = subTotal
        $("#totalvalue").html('<span>INR</span> ' + grandTotal);
        $('#removepromodiscount').hide();
        $('.special-discount').hide();
        $("#cupon_success").text("");
        $(".applycoupon").css({
            'display': 'block'
        });
        $("#coupon_code").show();
        localStorage.removeItem('applied_cupon')

        if (coupontype == 5) {
            sessionStorage.removeItem('couponamountdiscount')
            $.ajax({
                type: 'GET',
                url: '{{ url('forget_session_offer_id') }}',

            });
        } else {
            sessionStorage.removeItem('promo_discount')
            $.ajax({
                type: 'GET',
                url: '{{ url('forget_session_offer_id') }}',

            });
        }
        var product_price1 = `<?php echo json_encode($product_data); ?>`;
        product_price1 = JSON.parse(product_price1);
        var each_product_id1 = <?php echo json_encode($each_product_id); ?>;
        $.each(each_product_id1, function(key, value) {
            $("#product_price-" + value).html('INR ' + parseInt(product_price1[value]))
        })
        $("#coupon_code").val('');
        $("#cupon_success").removeAttr('style');

    }
</script>