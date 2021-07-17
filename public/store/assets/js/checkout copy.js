Stripe.setPublishableKey('pk_test_51J9qa8KrBI5BIIZag2lszvz22TckdUYwqvZdWdaHcRnRqqAwyAcnGr1rIEBUhKf3ufdl3SF3suv1LAI5hKdd0y6V00X3j0ZNPV');

var $form = $('checkout-form')

$form.submit(function (event) {
    Stripe.card.createToken({
        number: $('#checkout-number-card').val(),
        cvc: $('#checkout-cvc').val(),
        exp_month: $('#checkout-month').val(),
        exp_year: $('#checkout-year').val(),
        name: $('#checkout-name').val(),
    }, stripeResponseHandler);
    return false;
})

function stripeResponseHandler(status, response) {
    if (response.error) {
        console.log('error')
    }
    else {
        var token = response.id;
        $form.append($('<input type="hidden" name="stripeToken"  />').val(token))

        $form.get(0).submit();
    }
}
