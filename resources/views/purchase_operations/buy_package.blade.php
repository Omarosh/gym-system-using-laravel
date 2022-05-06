
@extends('layouts.app')

@section('content')
    <!-- Display a payment form -->
    <form id="payment-form" >
        <h1>Purchase a package for a trainee</h1>

        @csrf
    <label for=" fname">trainee_id :</label><br>
    <input class="form-control" type="text" id="trainee_id" name="trainee_id"><br>
    
    <label for="fname">package_id :</label><br>
    <input type="text" id="package_id" name="package_id"><br><br>

    <label for="fname">gym_id :</label><br>
    <input type="text" id="gym_id" name="gym_id"><br><br>

    <label for="fname">gym_id :</label><br>
    <input type="text" id="created_by_id" name="created_by_id"><br><br>

    <label for="fname">price :</label><br>
    <input type="text" id="price" name="price"><br><br>

      <div id="payment-element">
        <!--Stripe.js injects the Payment Element-->
      </div>
      <button id="submit">
        <div class="spinner hidden" id="spinner"></div>
        <span id="button-text">Pay now</span>
      </button>
      <div id="payment-message" class="hidden"></div>
    </form>
 <script src="https://js.stripe.com/v3/"></script>
<script type="text/javascript">
    // This is a public sample test API key.
// Don’t submit any personally identifiable information in requests made with this key.
// Sign in to see your own test API key embedded in code samples.
const stripe = Stripe(
  "pk_test_51KvM1uKyzqgHTfAD7mn0tx3koYivl5AMBDEpsP33u2nh4zACFJft9qlrKE3kK5hLjX7D0vmfx8d7KXzuFhiYkmng00f3N51wlX"
);

// The items the customer wants to buy
var items;
function getFormValues(){
    const trainee_id = document.getElementById("trainee_id").value;
const package_id = document.getElementById("package_id").value;
const gym_id = document.getElementById("gym_id").value;
const created_by_id = document.getElementById("created_by_id").value;
const price = document.getElementById("price").value;

items = [{ id: "xl-tshirt", trainee_id, package_id,gym_id,created_by_id,price}];
console.log(items);
}
let elements;
initialize();
checkStatus();

document
  .querySelector("#payment-form")
  .addEventListener("submit", handleSubmit);

// Fetches a payment intent and captures the client secret
async function initialize() {
  const { clientSecret } = await fetch("{{route('stripe.payment')}}", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ items }),
  }).then((r) => r.json());

  elements = stripe.elements({ clientSecret });

  const paymentElement = elements.create("payment");
  paymentElement.mount("#payment-element");
}

async function handleSubmit(e) {
  e.preventDefault();
  setLoading(true);
  getFormValues();
  initialize();
checkStatus();
  const { error } = await stripe.confirmPayment({
    elements,
    confirmParams: {
      // Make sure to change this to your payment completion page
      return_url: "{{route('buy_package')}}",
    },
  });

  // This point will only be reached if there is an immediate error when
  // confirming the payment. Otherwise, your customer will be redirected to
  // your `return_url`. For some payment methods like iDEAL, your customer will
  // be redirected to an intermediate site first to authorize the payment, then
  // redirected to the `return_url`.
  if (error.type === "card_error" || error.type === "validation_error") {
    showMessage(error.message);
  } else {
    showMessage("An unexpected error occured.");
  }

  setLoading(false);
}

// Fetches the payment intent status after payment submission
async function checkStatus() {
  const clientSecret = new URLSearchParams(window.location.search).get(
    "payment_intent_client_secret"
  );

  if (!clientSecret) {
    return;
  }

  const { paymentIntent } = await stripe.retrievePaymentIntent(clientSecret);

  switch (paymentIntent.status) {
    case "succeeded":
      showMessage("Payment succeeded!");
      items[0].success = "success";
    console.log("AAAAAAAAAAAAAAAAAAAAAAAAAAAa");
    console.log(items);
//       const { newrequest } = await fetch("{{route('payment_success')}}", {
//     method: "POST",
//     headers: { "Content-Type": "application/json" },
//     body: JSON.stringify({ items }),
//   }).then((r) => r.json());
      break;
    case "processing":
      showMessage("Your payment is processing.");
      break;
    case "requires_payment_method":
      showMessage("Your payment was not successful, please try again.");
      break;
    default:
      showMessage("Something went wrong.");
      break;
  }
}

// ------- UI helpers -------

function showMessage(messageText) {
  const messageContainer = document.querySelector("#payment-message");

  messageContainer.classList.remove("hidden");
  messageContainer.textContent = messageText;

  setTimeout(function () {
    messageContainer.classList.add("hidden");
    messageText.textContent = "";
  }, 4000);
}

// Show a spinner on payment submission
function setLoading(isLoading) {
  if (isLoading) {
    // Disable the button and show a spinner
    document.querySelector("#submit").disabled = true;
    document.querySelector("#spinner").classList.remove("hidden");
    document.querySelector("#button-text").classList.add("hidden");
  } else {
    document.querySelector("#submit").disabled = false;
    document.querySelector("#spinner").classList.add("hidden");
    document.querySelector("#button-text").classList.remove("hidden");
  }
}

</script>
@endsection
@section('third_party_scripts')
<script script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js">
</script>
 <link href="{{ asset('css/checkout.css') }}" rel="stylesheet">
    
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js" defer></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js" defer></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js" defer></script>
<script type="text/javascript"></script>
@endsection