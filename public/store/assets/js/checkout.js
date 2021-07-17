var stripe = Stripe('pk_test_51J9qa8KrBI5BIIZag2lszvz22TckdUYwqvZdWdaHcRnRqqAwyAcnGr1rIEBUhKf3ufdl3SF3suv1LAI5hKdd0y6V00X3j0ZNPV');

var elements = stripe.elements();

var card = elements.create('card', {
    style: style
});
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

// Handle real-time validation errors from the card Element.
card.addEventListener('change', function (event) {
    var displayError = document.getElementById('checkout-errors');
    if (event.error) {
        displayError.textContent = event.error.message;
        checkoutButton.setAttribute('disabled', true);
    } else {
        displayError.textContent = '';
        checkoutButton.disabled = false;
    }
});

form.addEventListener('submit', function (event) {
    event.preventDefault();
    checkoutButton.setAttribute('disabled', true);

    stripe.handleCardPayment(clientSecret, card, {
            payment_method_data: {
                //billing_details: { name: cardHolderName.value }
            }
        })
        .then(function (result) {
            if (result.error) {
                console.log(result);
                var errorElement = document.getElementById('checkout-errors');
                errorElement.textContent = result.error.message;
            } else {
                form.submit();
            }
        });
    return false;
});
