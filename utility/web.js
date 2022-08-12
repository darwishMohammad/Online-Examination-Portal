$(document).ready(function () {

    // client registration input masks
    $("#client_id").inputmask("9999999999999"); // id number 
    $("#client_code").inputmask({ "mask": "9999" });
    // telephone numbers 
    $("#client_tel_h").inputmask({ "mask": "(999)-(999)-(9999)" });
    $("#client_tel_w").inputmask({ "mask": "(999)-(999)-(9999)" });
    $("#client_tel_c").inputmask({ "mask": "(999)-(999)-(9999)" });

    // supplier regitration input masks
    $("#supplier_id").inputmask({ "mask": "SUPPLIER AA" });
    $("#supplier_tel").inputmask({ "mask": "(999)-(999)-(9999)" });
    $("#bank_code").inputmask({ "mask": "999999" });
    $("#supplier_bankNum").inputmask({ "mask": "9999999999" });

    // supplement save input mask
    $("#supplement_id").inputmask({ "mask": "SUPPLEMENT 999" });
    $("#nappiCode").inputmask({ "mask": "9999" });

    // code to show the supplement catalog
    showSupplements();
    function showSupplements() {
        $.ajax({
            url: '/model/process.php',
            method: 'POST',
            data: { showSupplement: 1 },
            success: function (data) {
                $("#supplement_listing").html(data);
            }
        });
    }

    // show supplement pagination
    supplementPage();
    function supplementPage() {
        $.ajax({
            url: "/model/process.php",
            method: "POST",
            data: { supplementPagination: 1 },
            success: function (data) {
                $("#supplement_pagination").html(data);
            }
        })
    }

    // pagination button click
    $("body").delegate(".supplementPager", "click", function () {
        var pageNumber = $(this).attr("pageNumber");
        $.ajax({
            url: "/model/process.php",
            method: "POST",
            data: { showSupplement: 1, pagination: 1, pageNumber: pageNumber },
            success: function (data) {
                $("#supplement_listing").html(data);
            }
        });
    });

    // searching supplement 
    $("#supplementCatalogSearch").keyup(function (e) {
        e.preventDefault();
        var searchTerm = $("#supplementCatalogSearch").val();
        if (searchTerm != "") {
            $.ajax({
                url: "/model/process.php",
                method: "POST",
                data: { showSupplement: 1, searchCatalogSupplement: 1, searchTerm: searchTerm },
                success: function (data) {
                    $("#supplement_listing").html(data);
                }
            })
        }
    })

    $("body").delegate("#product", "click", function (event) {
        event.preventDefault();
        var supplement_id = $(this).attr("supplement_id");
        $.ajax({
            url: "/model/process.php",
            method: "POST",
            data: { addSupplementToCart: 1, supplement_id: supplement_id },
            success: function (data) {
                $("#cart_msg").html(data);
                cart_items_count();
            }
        })
    });

    // cart drop down automatic populate 
    $("#cdd").change(function () {
        if ($(this).val() != '') {
            var clientID = $(this).val();
            $.ajax({
                url: "/model/process.php",
                method: "POST",
                data: { getClientData: 1, clientID: clientID },
                dataType: 'json',
                success: function (response) {
                    console.log("ID: " + response.id + "Address: " + response.address);
                    if (response.status == 1) {
                        $('#c_address').val(response.address);
                        $('#c_id').val(response.id);
                    }
                }
            });
        }
    });

    // get the number of items in user cart 
    cart_items_count();
    function cart_items_count() {
        $.ajax({
            url: "/model/process.php",
            method: "POST",
            data: { cartItemCount: 1 },
            success: function (data) {
                $("#cart_items_count").html(data);
            }
        });
    }

    // show cart items
    cart_items_view();
   function cart_items_view() {
      $.ajax({
         url: "/model/process.php",
         method: "POST",
         data: { cartItemsView: 1 },
         success: function (data) {
            $("#cart").html(data);
         }
      });
   }

   // delete car item 
   $("body").delegate(".delete", "click", function (event) {
    event.preventDefault();
    var supplement_id = $(this).attr("delete_id");
    $.ajax({
       url: "/model/process.php",
       method: "POST",
       data: { del: 1, supplement_id: supplement_id },
       success: function (data) {
          $("#cart_msg").html(data);
          cart_items_view();
          cart_items_count();
       }
    });
 });

   // update cart
   $("body").delegate(".qty", "keyup", function () {
    var product_id = $(this).attr("product_id");
    var quantity = $("#qty-" + product_id).val();
    var price = $("#price-" + product_id).val();
    var total = quantity * price;
    $("#total-" + product_id).val(total);
 });

 // update cart item
 $("body").delegate(".update", "click", function (event) {
    event.preventDefault();
    var product_id = $(this).attr("update_id");
    var quantity = $("#qty-" + product_id).val();
    var price = $("#price-" + product_id).val();
    var total = $("#total-" + product_id).val();
    $.ajax({
       url: "/model/process.php",
       method: "POST",
       data: { upd: 1, product_id: product_id, quantity: quantity, price: price, total: total },
       success: function (data) {
          $("#cart_msg").html(data);
          cart_items_view(); 
       }
    });
 });

 


});