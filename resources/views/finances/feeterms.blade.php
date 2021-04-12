<!-- Fee Info -->
<div class="col-5">
    <div class="card  bg-secondary shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col-8">
                    <h3 class="mb-0">{{ __('Plan estandar') }}</h3>
                </div>
                <div class="col-4 text-right">
                </div>
            </div>
        </div>
        <div class="card-body">
            <p>
                {{-- {{ __('Your current static fee on each order is:')}}  @money( $restaurant->static_fee, config('settings.cashier_currency'),config('settings.do_convertion'))<br />
                {{ __('Your current percentage fee on each order is:').' '.$restaurant->fee."% ".__('on the order value')}} <br /> --}}
           Si tu negocio no tiene más de 15 pedidos el siguiente mes es GRATIS<br>
                          <hr />
                          El costo mensual del servicio es de  <b> 25$</b><br><br>
                {{-- <b>{{__('Fees').": ".$restaurant->fee."% + "}} @money($restaurant->static_fee, config('settings.cashier_currency'),config('settings.do_convertion'))</b> --}}
            </p>
        </div>
    </div>
</div>

<div class="col-5">
    <div class="card  bg-secondary shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col-8">
                    <h3 class="mb-0">{{ __('Plan estandar') }}</h3>
                </div>
                <div class="col-4 text-right">
                </div>
            </div>
        </div>
        <div class="card-body">
            <p>

                    <ul>
                        <li> <a  data-toggle="modal" data-target="#modal-dash" href="http://">Dash</a></li>
                        <li> <a  data-toggle="modal" data-target="#modal-paypal" href="http://">Paypal</a></li>
                    </ul>
                                    <hr />
                          El costo mensual del servicio es de  <b> 25$</b><br><br>
                {{-- <b>{{__('Fees').": ".$restaurant->fee."% + "}} @money($restaurant->static_fee, config('settings.cashier_currency'),config('settings.do_convertion'))</b> --}}
            </p>
        </div>
    </div>
</div>




    <div class="modal fade" id="modal-paypal" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="modal-title-new-item">{{ __('Paypal') }}</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body p-0">
                    <div class="card bg-secondary shadow border-0">
                        <div class="card-body px-lg-5 py-lg-5">

                            <div id="smart-button-container">
                            <div style="text-align: center;">
                                <div style="margin-bottom: 1.25rem;">
                                <p>tienes realizar pago  correo electrónico registrado cuenta negocio  </p>
                                <select id="item-options"><option value="plan estándar" price="20">plan estándar - 20 USD</option></select>
                                <select style="visibility: hidden" id="quantitySelect"></select>
                                </div>
                            <div id="paypal-button-container"></div>
                            </div>
                            </div>

                            <script src="https://www.paypal.com/sdk/js?client-id=sb&currency=USD" data-sdk-integration-source="button-factory"></script>
                            <script>
                            function initPayPalButton() {
                                var shipping = 0;
                                var itemOptions = document.querySelector("#smart-button-container #item-options");
                                    var quantity = parseInt();
                                    var quantitySelect = document.querySelector("#smart-button-container #quantitySelect");
                                    if (!isNaN(quantity)) {
                                    quantitySelect.style.visibility = "visible";
                                    }
                                    var orderDescription = 'tienes realizar pago  correo electrónico registrado cuenta negocio  ';
                                    if(orderDescription === '') {
                                    orderDescription = 'Item';
                                    }
                                    paypal.Buttons({
                                    style: {
                                        shape: 'rect',
                                        color: 'gold',
                                        layout: 'vertical',
                                        label: 'paypal',

                                    },
                                    createOrder: function(data, actions) {
                                        var selectedItemDescription = itemOptions.options[itemOptions.selectedIndex].value;
                                        var selectedItemPrice = parseFloat(itemOptions.options[itemOptions.selectedIndex].getAttribute("price"));
                                        var tax = (0 === 0) ? 0 : (selectedItemPrice * (parseFloat(0)/100));
                                        if(quantitySelect.options.length > 0) {
                                        quantity = parseInt(quantitySelect.options[quantitySelect.selectedIndex].value);
                                        } else {
                                        quantity = 1;
                                        }

                                        tax *= quantity;
                                        tax = Math.round(tax * 100) / 100;
                                        var priceTotal = quantity * selectedItemPrice + parseFloat(shipping) + tax;
                                        priceTotal = Math.round(priceTotal * 100) / 100;
                                        var itemTotalValue = Math.round((selectedItemPrice * quantity) * 100) / 100;

                                        return actions.order.create({
                                        purchase_units: [{
                                            description: orderDescription,
                                            amount: {
                                            currency_code: 'USD',
                                            value: priceTotal,
                                            breakdown: {
                                                item_total: {
                                                currency_code: 'USD',
                                                value: itemTotalValue,
                                                },
                                                shipping: {
                                                currency_code: 'USD',
                                                value: shipping,
                                                },
                                                tax_total: {
                                                currency_code: 'USD',
                                                value: tax,
                                                }
                                            }
                                            },
                                            items: [{
                                            name: selectedItemDescription,
                                            unit_amount: {
                                                currency_code: 'USD',
                                                value: selectedItemPrice,
                                            },
                                            quantity: quantity
                                            }]
                                        }]
                                        });
                                    },
                                    onApprove: function(data, actions) {
                                        return actions.order.capture().then(function(details) {
                                        alert('Transaction completed by ' + details.payer.name.given_name + '!');
                                        });
                                    },
                                    onError: function(err) {
                                        console.log(err);
                                    },
                                    }).render('#paypal-button-container');
                                }
                                initPayPalButton();
                            </script>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>



    <div class="modal fade" id="modal-dash" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="modal-title-new-item">{{ __('Dash') }}</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body p-0">
                    <div class="card bg-secondary shadow border-0">
                        <div class="card-body px-lg-5 py-lg-5">

                                <img width="400px" src="{{ asset('') }}dash.jpg" alt="">
                                <br>
                                <p>dash:XnLvTkTaHx5hKss9k3UXG5giYLtugqHX1d?amount=0.09419314</p>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>





