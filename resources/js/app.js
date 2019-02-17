
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue';
import VueRouter from 'vue-router';

// Components
import AboutComponent from './components/AboutComponent.vue';
import ProductQuickView from './components/ProductQuickView.vue';
import Empty from './components/Empty.vue';


Vue.use(VueRouter);


const routes = [
    {
        path: '/',
        components: {
            default: AboutComponent,
            quickView: Empty
        },
        name: 'about'
    },
    {
        path: '/product/:id',
        components: {
            default: AboutComponent,
            quickView: ProductQuickView
        },
        name: 'QuickViewProduct'
    }
];

const router = new VueRouter({
    routes: routes
});

const app = new Vue({
    el: '#app',
    router: router
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
$( ".v-card" ).click(function() {
    console.log("Clicked card");

    // Remove active card
    $('#card_list').find( ".active" ).removeClass('active');
    $(this).parent( "#card" ).addClass('active');
    $(this).parent( "#card" ).find( ".form-check-input" ).prop( "checked", true );
    // $(this).addClass('active');
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

$( "#submit_card" ).click(function() {
    console.log("Sending Ajax to create card");

    $("#card_number_error").html('');
    $("#card_name_error").html('');
    $("#card_expiry_error").html('');

    axios.post('/api/checkout/card', {
        card_number: $('#card_number').val(),
        card_holder_name: $('#card_holder_name').val(),
        expiry: $('#expiry').val(),
        user_id: $('#card_user_id').val(),
    })
    .then(function( resp ){
        console.log("Card Added Succesfully");
        console.log(resp.data);

        var data = resp.data;

        $('#card_list').find( ".active" ).removeClass('active');

        // Create card visual
        $("#card_list").prepend(
            '<div id="card" class="form-check visa-card active">' +
                '<input class="form-check-input" hidden type="radio" name="{{ $name }}" value="' + data.id + '" />' +
                '<label class="form-check-label v-card" for="' + data.id + '">' +
                    '<ul>' +
                        '<li>****</li>' +
                        '<li>****</li>' +
                        '<li>****</li>' +
                        '<li>' + data.number.substr(-4) + '</li>' +
                    '</ul>' +
                    '<div class="row details">' +
                        '<div class="col-md-6">' +
                            '<span class="title">Card Holder</span>' +
                            data.name_on_card +
                        '</div>' +
                        '<div class="col-md-3">' +
                            '<span class="title">Expires</span>' +
                            data.expiry +
                        '</div>' +
                        '<div class="col-md-3">' +
                            '<span class="title">Cvv</span>' +
                            '123' +
                        '</div>' +
                    '</div>' +
                '</label>' +
            '</div>');

        // // Hide Modal & Clear
        $('#newCardModal').modal('hide');
        $('#card_number').val('');
        $('#card_holder_name').val('');
        $('#expiry').val('');
    })
    .catch(function(error){
        console.log("Error Adding Card");
        console.log(error.response.data.error);

        $("#card_number_error").html(error.response.data.error.card_number);
        $("#card_name_error").html(error.response.data.error.card_holder_name);
        $("#card_expiry_error").html(error.response.data.error.expiry);
   });
});

// Get customer address when selected (artist create order)
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
