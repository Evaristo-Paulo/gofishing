var stripe = Stripe('pk_test_51J9qa8KrBI5BIIZag2lszvz22TckdUYwqvZdWdaHcRnRqqAwyAcnGr1rIEBUhKf3ufdl3SF3suv1LAI5hKdd0y6V00X3j0ZNPV');

var elements = stripe.elements();

var card = elements.create('card', { style: style });
var checkoutButton = document.getElementById('checkout-button');

var clientSecret = checkoutButton.dataset.secret;

var style = {
    base: {
        color: 'red',
        lineHeight: '18px',
        fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
        fontSmoothing: 'antialiased',
        fontSize: '16px',
        '::placeholder': {
            color: '#aab7c4'
        }
    },
    invalid: {
        color: '#fa755a',
        iconColor: '#fa755a'
    }
};

card.mount('#card-element');

var form = document.getElementById('checkout-form');

form.addEventListener('submit', function (event) {
    event.preventDefault();
    stripe.handleCardPayment(clientSecret, card, {
            payment_method_data: {
                //billing_details: { name: cardHolderName.value }
            }
        })
        .then(function (result) {
            if (result.error) {
                console.log(result);
                form.append($('<input type="hidden" name="error"  />').val(result))
            } else {
                form.append($('<input type="hidden" name="error"  />').val(result))
                form.submit();
            }
        });
    return false;
});
