/* js custom */
$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // view site
    // list of categories
    categoriesList();
    
    // view all categories
    shopCategories();
    // view shopping
    //shopping();

    // view shopping
    $(window).on('scroll', function(event) {
        var scrollValue = $(window).scrollTop();
        if ( scrollValue > 110) {
             $('.sticky-top').addClass('pt-stick');
        }else{
           $('.sticky-top').removeClass('pt-stick');
        }
    });

    $.get('/cart/total/', function (data) 
    {
        $('#total').text(data.total);
        $('#qty').text(data.qty);

        if(data.qty > 0){
            $('#emptyCart').hide();
            $('#btnMyCart').show();
        }else{
            $('#emptyCart').show();
            $('#btnMyCart').hide();
        }
    });

    // View cart
    /* addOne button ***********************************************************************/
    $(document).on('click', ".addOne", function(e)
    {
        var productId = $(this).val();
        var quantity = $('.quantity_' + productId).text();
        var quantity = $('.menuQuantity_' + productId).text();
        ++quantity;
        updateCart(productId, quantity);

        // dropdown open after remove, addOne or removeOne
        e.stopPropagation();
        $(this).children(".dropdown-menu").toggle();
    });

    /* removeOne button **********************************************************************/
    $(document).on('click', ".removeOne", function(e)
    {
        var productId = $(this).val();
        var quantity = $('.quantity_' + productId).text();
        var quantity = $('.menuQuantity_' + productId).text();
        quantity--;
        
        if (quantity <= 0) {
            removeProduct(productId);
        }else{
            updateCart(productId, quantity);
        }
        
        // dropdown open after remove, addOne or removeOne
        e.stopPropagation();
        $(this).children(".dropdown-menu").toggle();
    });

    /* removeProduct button */
    $(document).on('click', ".removeProduct", function(e) 
    {
        var productId = $(this).val();
        removeProduct(productId);
        // dropdown open after remove, addOne or removeOne
        e.stopPropagation();
        $(this).children(".dropdown-menu").toggle();
    });

    // View cart
    /* Update cart table */
    function updateCart(productId, quantity) {
        $.ajax({
            type: "PATCH",
            data: { id: productId , quantity: quantity },
            dataType: "json",
            url: "/cart/update/",
            success: function(data) {
                $.get('/cart/total/', function (data) 
                {
                    // menu
                    $('#total').text(data.total);
                    $('#qty').text(data.qty);
                    // totalcart line
                    $('#totalCart').text(data.total);
                    $('#totalQty').text(data.qty);
                    // line product
                    $('.quantity_' + productId).text(quantity);
                    $('.subtotal_' + productId ).text(quantity * $('.price_' + productId).text());    
                    // menu
                    $('.menuQuantity_' + productId).text(quantity);

                });
            },
            error: function () {
                console.log('Error!');
            }
        });            
    }
    /* remove product from cart table */
    function removeProduct(productId) {
        $.ajax({
            type: "DELETE",
            data: { id: productId },
            dataType: "json",
            url: "/cart/remove",
            success: function(data) {
                $.get('/cart/total/', function (data) 
                {
                    // menu
                    $('#total').text(data.total);
                    $('#qty').text(data.qty);
                    // totalcart line
                    $('#totalCart').text(data.total);
                    $('#totalQty').text(data.qty);
                    // line product delete
                    $('#menuProductLine_'+ productId).remove();
                    $('#cartProductLine_'+ productId).remove();
                    
                    if(data.qty > 0){
                        $('#emptyCart').hide();
                        $('#btnMyCart').show();
                        
                    }else{
                        $('#emptyCart').show();
                        $('#btnMyCart').hide();
                    }
                });
            },
            error: function() {
                console.log('Error!');
            }
        });
    }

    /* When user click add button */
    $(document).on('click', "[data-product]", function() {
        var productId = $(this).val();
        $.ajax({
            type: "GET",
            url: "/cart/add/" + productId,
            success: function(data) {
                
                quantity = data.addedProduct.quantity;
                productName = data.addedProduct.productName;
                price = data.addedProduct.price;

                htmlRow = '';
                $.get('/cart/total/', function (data) 
                {   
                    $('#total').text(data.total);
                    $('#qty').text(data.qty);
                    
                    if(data.qty > 0){
                        $('#emptyCart').hide();
                        $('#btnMyCart').show();
                        
                    }else{
                        $('#emptyCart').show();
                        $('#btnMyCart').hide();
                    }
                });

                htmlRow += '<tr id="menuProductLine_' + productId + '">';
                htmlRow += '<td class="align-middle">';
                htmlRow += '<button class="btn btn-link removeOne" value="' + productId + '"><i class="fas fa-minus-circle"></i></button>';
                htmlRow += '<span class="menuQuantity_'+ productId +'">' +  quantity + '</span>';
                htmlRow += '<button class="btn btn-link addOne" value="' + productId + '"><i class="fas fa-plus-circle"></i></button>';
                htmlRow += '</td>';
                htmlRow += '<td class="align-middle">' + productName + '</td>';
                htmlRow += '<td class="align-middle">' + price + '</td>';
                htmlRow += '<td class="align-middle">';
                htmlRow += '<button class="btn btn-sm btn-link text-danger removeProduct" value="' + productId + '"><i class="fas fa-times-circle"></i></button>';
                htmlRow += '</td>';
                htmlRow += '</tr>';

                $('#cartMenu').append(htmlRow);
            },
            error: function () {
                console.log('Error!');
            }
        });
    });

    /* clearCart button */
    $('#clearCart').click(function () 
    {
        $.ajax({
            type: "GET",
            url: "/cart/clear",
            success: function(data) {
                $.get('/cart/total/', function (data) 
                {
                    $('#total').text(data.total);
                    $('#qty').text(data.qty);
                });
                location.reload();
            },
            error: function () {
                console.log('Error!');
            }
        });
    });

    // When click coupom_code Button
    $(document).on('submit', '#form_coupom', function(event) {
        event.preventDefault();
        
        $.ajax({
            method: "GET",
            data: $(this).serialize(),
            url: "/coupom/",
            dataType: "json",
            success: function(data) {
                // adicionar uma linha na table com o valor do desconto
                // modificar o valor total

                // adicionar o resultado do retorno no campo do desconto
                $('#coupom_data').empty();

                htmlRow = '';
                if(data.msg == 'Invalid Coupom!'){
                    htmlRow = '<span class="text-danger">' + data.msg + '</span>';
                }else{
                    $('#btn_coupom_ok').empty();
                    btn_coupom_code = '<button class="btn btn-secondary" disabled>Ok</button>';
                    $('#btn_coupom_ok').append(btn_coupom_code);
                    htmlRow += '<span class="text-success">' + data.msg + ' ' + '</span>';
                    htmlRow += '<div class="custom-control custom-checkbox">';
                    htmlRow += '<input class="custom-control-input" type="checkbox" name="addCoupom" id="addCoupom" data-value="'+ data.value +'"' + 'data-type="'+ data.type +'">';
                    htmlRow += '<label for="addCoupom" class="custom-control-label"> Discount coupom: ' + data.value + ' ' + (data.type == 'Money' ? '$':'%') + '</label>';
                    htmlRow += '</div>';
                }
                $('#coupom_data').append(htmlRow);

            },
            error: function() {
                console.log('Error!');
            }
        });
    })

    // When click checkout Button
    $(document).on('click', "#checkout", function() {
        event.preventDefault();
                
        var coupom_code     = $("input[name='coupom_code']").val();
        var coupom_type     = $("#addCoupom").attr("data-type");
        var coupom_value    = $("#addCoupom").attr("data-value");
        var shipping_method = $("input[name='shipping']:checked").val();
        var shipping_cost   = $("input[name='shipping']:checked").attr("data-cost");
        var payment_method  = $("input[name='payment']:checked").val();
        var installment     = $("#installment").attr("data-installment");

        if($("input[name='shipping']").is(":checked") == false) {
            $('#invalid-shipping').show();
        }

        if($("input[name='payment']").is(":checked") == false) {
            $('#invalid-payment').show();
        }

        if(($("input[name='shipping']").is(":checked") == true) && ($("input[name='payment']").is(":checked") == true)) {
            $('#form_coupom_code').val(coupom_code);
            $('#form_coupom_type').val(coupom_type);
            $('#form_coupom_value').val(coupom_value);
            $('#form_shipping_method').val(shipping_method);
            $('#form_shipping_cost').val(shipping_cost);
            $('#form_payment_method').val(payment_method);
            $('#form_installment').val(installment);
            $( "#form_checkout" ).submit();
        }
        
        // cart items            
        
    });
    
    // view all products
    shopProducts();    
});

// view site
function categoriesList(){
    $.ajax({
        type: "GET",
        url: "/menuCategories",
        success: function(data) {
            var categories = data;
            var htmlRow = '';
            $.each(categories, function (i, item) {
               htmlRow += '<a class="dropdown-item" href="/' + item.slug + '">' + item.categoryName +"</a>";
            }); 
            $('#categoriesList').append(htmlRow);
        },
        error: function() {
            console.log('Error!');
        }
    });
}

// view all products
function shopProducts() {
    $.ajax({
        type: "GET",
        url: "/shop/products/",
        success: function(data) {
            var shopProducts = data;
            var htmlRow = '';
            $.each(shopProducts, function (i, item) {
            htmlRow += '<div class="col-sm-6 col-md-4 col-lg-3 margin-bottom-20">';
                htmlRow += '<div class="card h-100">';
                    
                    if(item.image == ''){
                        htmlRow += '<img class="img-fluid" src="img/default/default-250x150.jpg" class="card-img-top" alt="...">';
                    }else{
                        htmlRow += '<img class="img-fluid" src="img/products/' + item.image + '" class="card-img-top" alt="...">';
                    }

                    htmlRow += '<div class="card-body">';
                    htmlRow += '<h5 class="card-title">' + item.productName + '</h5>';
                    htmlRow += '<p class="card-text">';
                    htmlRow += item.category.categoryName +'</br>';
                    htmlRow += item.price +' $</br>';
                    // htmlRow += item.description +'</br>';
                    htmlRow += '</p>'; 
                    
                    if(item.quantity > 0){
                        htmlRow += '<button class="addButton btn btn-success" data-product="' + item.id + '" value="' + item.id + '"><i class="fas fa-cart-plus"></i> Add</button>';
                    }else{
                        htmlRow += '<button class="wishButton btn btn-warning" data-product="' + item.id + '" value="' + item.id + '">Wish List</button>';
                    }
                    htmlRow += '<a href="' + item.category.slug + '/' + item.slug +'" class="btn btn-link margin-right-5">Description</a>';
                    htmlRow += '</div>';
                htmlRow += '</div>'; 
            htmlRow += '</div>'; 
        }); 
            $('#allProducts').append(htmlRow);
        },
        error: function() {
                console.log('Error!');
        }
    });
}

// View all categories
function shopCategories(){
    $.ajax({
        type: "GET",
        url: "/shop/categories",
        success: function(data) {
            var shopCategories = data;
            var htmlRow = '';
            $.each(shopCategories, function (i, item) {
                //htmlRow += '<a class=" href="' + item.slug + '">' + item.categoryName + '</a>';
                htmlRow += '<div class="col-sm-6 col-md-4 col-lg-3 margin-top-25">';
                htmlRow += '<div class="card h-100">';
                
                if(item.image == ''){
                    htmlRow += '<img class="img-fluid" src="img/default/default-350x250.jpg" class="card-img-top" alt="...">';
                }else{
                    htmlRow += '<img class="img-fluid" src="img/categories/' + item.image + '" class="card-img-top" alt="...">';
                }
                
                htmlRow += '<div class="card-body">';
                htmlRow += '<h5 class="card-title">' + item.categoryName + '</h5>';
                // htmlRow += '<p class="card-text">'+ item.description + '</p>';
                htmlRow += '<a href="' + item.slug + '" class="btn btn-primary btn-block">Description</a>';
                htmlRow += '</div>';
                htmlRow += '</div>'; 
                htmlRow += '</div>';
            }); 
            $('#allCategories').append(htmlRow);
        },
        error: function() {
            console.log('Error!');
        }
    });

    // Slider - When click img products
    $(document).on('click', ".thumb_product", function() {
        event.preventDefault();
        
        id_thumb = $(this).attr('data-id'); 
        $(".frame_product").addClass('d-none');
        $('[data-id=' + id_thumb +']').removeClass('d-none');
    });
}


function shopping(){
    $.ajax({
        type: "GET",
        url: "/shop/categories",
        success: function(data) {
            var shopCategories = data;
            var htmlRow = '';
            $.each(shopCategories, function (i, item) {
                //htmlRow += '<a class=" href="' + item.slug + '">' + item.categoryName + '</a>';
                htmlRow += '<div class="col-sm-6 col-md-4 col-lg-3 margin-top-25">';
                htmlRow += '<div class="card h-100">';
                
                if(item.image == ''){
                    htmlRow += '<img class="img-fluid" src="img/default/default-350x250.jpg" class="card-img-top" alt="...">';
                }else{
                    htmlRow += '<img class="img-fluid" src="img/categories/' + item.image + '" class="card-img-top" alt="...">';
                }
                
                htmlRow += '<div class="card-body">';
                htmlRow += '<h5 class="card-title">' + item.categoryName + '</h5>';
                // htmlRow += '<p class="card-text">'+ item.description + '</p>';
                htmlRow += '<a href="' + item.slug + '" class="btn btn-primary btn-block">Description</a>';
                htmlRow += '</div>';
                htmlRow += '</div>'; 
                htmlRow += '</div>';
            }); 
            $('#allCategories').append(htmlRow);
        },
        error: function() {
            console.log('Error!');
        }
    });

    // Slider - When click img products
    $(document).on('click', ".thumb_product", function() {
        event.preventDefault();
        
        id_thumb = $(this).attr('data-id'); 
        $(".frame_product").addClass('d-none');
        $('[data-id=' + id_thumb +']').removeClass('d-none');
    });
}

                