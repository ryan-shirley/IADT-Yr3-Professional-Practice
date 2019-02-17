
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('about-component', require('./components/AboutComponent.vue'));

const app = new Vue({
    el: '#app'
});

// Navbar
$('#navbar-burger-icon').click(function(){
	$(this).toggleClass('open');
});

// Checkout

// Create Shipping Address
$( "#submit_shipping_address" ).click(function() {
    console.log("Sending Ajax to create shipping address");

    axios.post('/api/checkout/shipping-address', {
        line1: $('#shipping_address_line1').val(),
        shipping: 1,
        billing: 0,
        user_id: $('#shipping_user_id').val(),
    })
    .then(function( resp ){
        console.log("Shipping Address Added Succesfully");
        console.log(resp.data);

        var data = resp.data;

        // Create Shipping Address
        $("#list_shipping_address").prepend(
            '<div class="custom-control custom-radio address card-light">' +
                '<input id="shipping_address_' + data.id + '" type="radio" id="address-' + data.id + '" class="custom-control-input" name="shipping_id" value="' + data.id + '">' +
                '<label class="custom-control-label" for="shipping_address_' + data.id + '">' +
                    data.line1 +
                '</label>' +
            '</div>' );
        // Select Added Address
        $("#shipping_address_" + data.id).prop( "checked", true );

        // Hide Modal & Clear
        $('#newShippingAddressModal').modal('hide');
        $('#shipping_address_line1').val('');
    })
    .catch(function(data){
        console.log("Error Adding Shipping Address");
        console.log(data);
   });
});

// Create Billing Address
$( "#submit_billing_address" ).click(function() {
    console.log("Sending Ajax to create billing address");

    $.ajax({
        url: '/api/checkout/billing-address',
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify({
            line1: $('#billing_address_line1').val(),
            shipping: 0,
            billing: 1,
            user_id: $('#billing_user_id').val(),
        }),
        dataType: 'json',
        success: function( data ){
            console.log("Billing Address Added Succesfully");
            console.log(data);

            // Create Billing Address
            $("#list_billing_address").prepend(
                '<div class="custom-control custom-radio address card-light">' +
                    '<input id="billing_address_' + data.id + '" type="radio" id="address-' + data.id + '" class="custom-control-input" name="billing_id" value="' + data.id + '">' +
                    '<label class="custom-control-label" for="billing_address_' + data.id + '">' +
                        data.line1 +
                    '</label>' +
                '</div>' );
            // Select Added Address
            $("#billing_address_" + data.id).prop( "checked", true );

            // Hide Modal & Clear
            $('#newBillingAddressModal').modal('hide');
            $('#billing_address_line1').val('');
        },
        error: function(data){
            console.log("Error Adding Shipping Address");
            console.log(data);
       },
    });
});

// Payment Method Card
$( "#card" ).click(function() {
    console.log("Clicked card");
    $(this).find( ".form-check-input" ).prop( "checked", true );
});

// Shipping Method update total
$( "#shipping .custom-control-label").click(function() {
    console.log("Shipping method clicked.");

    var shipping_value = $(this).data( "price" );
    var sub_total = $("#cart_sub_total").html();
    var total = parseInt(sub_total) + parseInt(shipping_value);
    $("#cart_total").html(total.toFixed(2) + " €");
    shipping_value = shipping_value.toFixed(2);

    if(shipping_value == 0) {
        shipping_value = "FREE";
    }

    $("#cart_shipping_price").html(shipping_value);
});


// Create Order
$('#customerList').change(function() {
    console.log("Changed customer");
    console.log($(this).val());
    var app = $(this);

    // Remove addresses displayed
    $("#billing_addresses").html("");
    $("#shipping_addresses").html("");

    if(app.val() != 0) {
        axios.get('/api/artist/order/addresses/' + app.val())
            .then(function( resp ){
                console.log(resp.data);

                var data = resp.data;
                var shipping_addresses = '';
                var billing_addresses = '';

                data.forEach(function(entry) {
                    console.log(entry);
                    if(entry.shipping == 1) {
                        shipping_addresses = shipping_addresses +
                            '<div class="custom-control custom-radio address card-light">' +
                                '<input id="shipping_address_' + entry.id + '" type="radio" id="address-' + entry.id + '" class="custom-control-input" name="shipping_address" value="' + entry.id + '">' +
                                '<label class="custom-control-label" for="shipping_address_' + entry.id + '">' +
                                    entry.line1 +
                                '</label>' +
                            '</div>'
                    }
                    else if(entry.billing == 1) {
                        billing_addresses = billing_addresses +
                            '<div class="custom-control custom-radio address card-light">' +
                                '<input id="billing_address_' + entry.id + '" type="radio" id="address-' + entry.id + '" class="custom-control-input" name="billing_address" value="' + entry.id + '">' +
                                '<label class="custom-control-label" for="billing_address_' + entry.id + '">' +
                                    entry.line1 +
                                '</label>' +
                            '</div>'
                    }
                })

                // Display Addresses
                if(shipping_addresses == "") {
                    shipping_addresses = 'No Shipping Addresses'
                }
                $("#shipping_addresses").html(shipping_addresses);


                if(billing_addresses == "") {
                    billing_addresses = 'No Billing Addresses'
                }
                $("#billing_addresses").html(billing_addresses);
            })
            .catch(function(data){
                console.log(data);
           });
    }
    else {
        $("#shipping_addresses").html("No customer selected");
        $("#billing_addresses").html("No customer selected");
        $("#user_error").html("A customer needs to be selected");
    }
});
