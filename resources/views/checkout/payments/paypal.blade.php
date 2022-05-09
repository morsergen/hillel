<div id="paypal-button-container"></div>

<!-- Include the PayPal JavaScript SDK -->
<script src="https://www.paypal.com/sdk/js?client-id={{ config('paypal.' . config('paypal.mode') . '.client_id') }}&currency=USD&disable-funding=card"></script>

<script>
    let errorExists = false;
    let fields = {};

    function getFields() {
        return $('#order-form').serializeArray().reduce(function(obj, item) {
            obj[item.name] = item.value;
            return obj;
        }, {});
    }

    function validateEmptyFields() {
        for(const [key, value] of Object.entries(getFields())) {
            if (value.length <= 0) { return true; }
        }
        return false;
    }

    // Render the PayPal button into #paypal-button-container
    // DOCUMENTATION https://developer.paypal.com/demo/checkout/#/pattern/server
    paypal.Buttons({
        onInit: function(data, actions) {
            if(validateEmptyFields()) {
                actions.disable();
            }

            $(document).on('change', '#order-form', function(){
                if(!validateEmptyFields()) {
                    actions.enable();
                }
            });
        },

        onClick: function() {
            if(validateEmptyFields()) {
                iziToast.error({
                    title: 'Error',
                    message: 'All fields required!',
                    position: 'topRight'
                });
            }
        },

        // Call your server to set up the transaction
        createOrder: function(data, actions) {
            const errorClass = 'is-invalid';

            return $.ajax({
                url: '/paypal/order/create',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Accept': 'application/json'
                },
                type: 'POST',
                method: 'POST',
                dataType: 'json',
                data: getFields(),
                beforeSend: function () {
                    $('.invalid-feedback').remove();
                    $(`.${errorClass}`).removeClass(errorClass);
                },
                error: function(error) {
                    const responseJson = error.responseJSON;
                    if (responseJson !== 'undefined') {
                        let errorTemplate = '<span class="invalid-feedback"><strong>#####</strong></span>';
                        for(const [field, message] of Object.entries(responseJson.errors)) {
                            let $input = $(`input[name="${field}"]`);
                            $input.addClass(errorClass);
                            $input.after(errorTemplate.replace('#####', message[0]));
                        }
                    }
                },
            }).then(function(order) {
                return order.vendor_order_id;
            }).catch(function(){
                return;
            });
        },

        // Call your server to finalize the transaction
        onApprove: function(data, actions) {
            if (data.hasOwnProperty('orderID')) {
                return fetch('/paypal/order/' + data.orderID + '/capture', {
                    method: 'post',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'Accept': 'application/json'
                    },
                }).then(function(res) {
                    return res.json();
                }).then(function (orderData) {
                    var errorDetail = Array.isArray(orderData.details) && orderData.details[0];

                    if (errorDetail && errorDetail.issue === 'INSTRUMENT_DECLINED') {
                        return actions.restart(); // Recoverable state, per:
                        // https://developer.paypal.com/docs/checkout/integration-features/funding-failure/
                    }

                    if (errorDetail) {
                        iziToast.error({
                            title: 'Error',
                            message: 'Sorry, your transaction could not be processed.',
                            position: 'topCenter',
                        });
                        return false;
                    }

                    if (orderData.order_id) {
                        window.location.href = `/thank-you-page/${orderData.order_id}`;
                    }
                });
            }
        }

    }).render('#paypal-button-container');
</script>

