@extends('layouts.app')

@section('content')

<div class="container">  
    
            <div class="panel mt-5 p-5">
                <div class="panel-heading">
                    <div class="row text-center">
                        <h3 class="panel-heading">Payment Details</h3>
                    </div>                    
                </div>
                <div class="panel-body">
  
                    @if (Session::has('success'))
                        <div class="alert alert-success text-center">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <p>{{ Session::get('success') }}</p>
                        </div>
                    @endif
                    @if (Session::has('fail'))
                        <div class="alert alert-danger text-center">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <p>{{ Session::get('fail') }}</p>
                        </div>
                    @endif
  
                    <form role="form" action="{{ route('stripe.payment') }}" method="post" class="validation"
                                                     data-cc-on-file="false"
                                                    data-stripe-publishable-key="pk_test_51KvM1uKyzqgHTfAD7mn0tx3koYivl5AMBDEpsP33u2nh4zACFJft9qlrKE3kK5hLjX7D0vmfx8d7KXzuFhiYkmng00f3N51wlX"
                                                    id="payment-form">
                        @csrf
                        

                        <div class='form-row row'>
                            <div class='col-xs-12 form-group required'>
                                <label for="trainee_email" class='control-label'>Trainee Email</label>
                                <input class="form-control" type="text" id="trainee_email" name="trainee_email">
                            </div>
                        </div>
                        
                        <?php function price($price){
                            if(strlen($price)>=3){
                                return substr_replace($price, ".", 2, 0);
                            }else if(strlen($price)==2){
                                return '0.'.$price;
                            }else if(strlen($price)==1){
                                return '0.0'.$price;
                            }else{
                                return "???";
                            }
                            } ?>
                        <div class='form-row row'>
                            <div class='col-xs-12 form-group required'>
                                <label for="package_id" class='control-label'>package_id :</label> 
                                {{-- <input class="form-control" type="text" id="package_id" name="package_id"> --}}
                                <select class="form-control" id="package_id" name="package_id">
                                    @foreach ($packages as $item)
                                        <option value="{{$item[0]}}">{{$item[1]}} - {{price($item[2])}}$ - ( {{$item[3]}} Sessions)</option>
                                    @endforeach
            
                                </select>
                            </div>
                        </div>

                        {{-- @hasanyrole('city_manager|admin') --}}
                        {{-- @hasrole('city_manager') --}}

                        <div class='form-row row'>
                            <div class='col-xs-12 form-group required'>
                                <label for="gym_id" class='control-label'>gym_id :</label>
                                {{-- <input class="form-control" type="text" id="gym_id" name="gym_id"> --}}
                                <select class="form-control" id="gym_id" name="gym_id">
    
                                    @foreach ($gyms as $item)
                                        <option value="{{$item[0]}}">{{$item[1]}} - {{$item[2]}}</option>
                                    @endforeach
            
                                </select>
                            </div>
                        </div>
                        {{-- @endhasrole --}}
                        {{-- @endhasanyrole --}}


                        {{-- <div class='form-row row'>
                            <div class='col-xs-12 form-group required'>
                                <label for="created_by_id" class='control-label'>created_by_id :</label>
                                <input class="form-control" type="text" id="created_by_id" name="created_by_id">
                            </div>
                        </div> --}}
                        <input class="form-control" type="hidden" id="created_by_id" value="{{1}}" name="created_by_id">


                        {{-- <div class='form-row row'>
                            <div class='col-xs-12 form-group required'>
                                <label for="price" class='control-label'>price</label>
                                <input class="form-control" type="text" id="price" name="price">
                            </div>
                        </div> --}}




                        <div class='form-row row'>
                            <div class='col-xs-12 form-group required'>
                                <label class='control-label'>Name on Card</label> <input
                                    class='form-control' size='4' type='text'>
                            </div>
                        </div>
  
                        <div class='form-row row'>
                            <div class='col-xs-12 form-group card required'>
                                <label class='control-label'>Card Number</label> <input
                                    autocomplete='off' class='form-control card-num' size='20'
                                    type='text'>
                            </div>
                        </div>
  
                        <div class='form-row row'>
                            <div class='col-xs-12 col-md-4 form-group cvc required'>
                                <label class='control-label'>CVC</label> 
                                <input autocomplete='off' class='form-control card-cvc' placeholder='e.g 415' size='4'
                                    type='text'>
                            </div>
                            <div class='col-xs-12 col-md-4 form-group expiration required'>
                                <label class='control-label'>Expiration Month</label> <input
                                    class='form-control card-expiry-month' placeholder='MM' size='2'
                                    type='text'>
                            </div>
                            <div class='col-xs-12 col-md-4 form-group expiration required'>
                                <label class='control-label'>Expiration Year</label> <input
                                    class='form-control card-expiry-year' placeholder='YYYY' size='4'
                                    type='text'>
                            </div>
                        </div>
  
                        <div class='form-row row'>
                            <div class='col-md-12 hide error form-group'>
                                <div class='alert-danger alert'>Fix the errors before you begin.</div>
                            </div>
                        </div>
  
                        <div class="row">
                            <div class="col-xs-12">
                                <button class="btn btn-info btn-lg btn-block" type="submit">Pay Now</button>
                            </div>
                        </div>
                          
                    </form>
                </div>
            </div>        
        
</div>


@endsection

@section('third_party_scripts')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <style type="text/css">
        .container {
            margin-top: 40px;
        }
        .panel-heading {
        display: inline;
        font-weight: bold;
        }
        .flex-table {
            display: table;
        }
        .display-tr {
            display: table-row;
        }
        .display-td {
            display: table-cell;
            vertical-align: middle;
            width: 55%;
        }
    </style>

<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
  
<script type="text/javascript">
$(function() {
    var $form         = $(".validation");
  $('form.validation').bind('submit', function(e) {
    var $form         = $(".validation"),
        inputVal = ['input[type=email]', 'input[type=password]',
                         'input[type=text]', 'input[type=file]',
                         'textarea'].join(', '),
        $inputs       = $form.find('.required').find(inputVal),
        $errorStatus = $form.find('div.error'),
        valid         = true;
        $errorStatus.addClass('hide');
 
        $('.has-error').removeClass('has-error');
    $inputs.each(function(i, el) {
      var $input = $(el);
      if ($input.val() === '') {
        $input.parent().addClass('has-error');
        $errorStatus.removeClass('hide');
        e.preventDefault();
      }
    });
  
    if (!$form.data('cc-on-file')) {
      e.preventDefault();
      Stripe.setPublishableKey($form.data('stripe-publishable-key'));
      Stripe.createToken({
        number: $('.card-num').val(),
        cvc: $('.card-cvc').val(),
        exp_month: $('.card-expiry-month').val(),
        exp_year: $('.card-expiry-year').val()
      }, stripeHandleResponse);
    }
  
  });
  
  function stripeHandleResponse(status, response) {
        if (response.error) {
            $('.error')
                .removeClass('hide')
                .find('.alert')
                .text(response.error.message);
        } else {
            var token = response['id'];
            $form.find('input[type=text]').empty();
            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            $form.get(0).submit();
        }
    }
  
});
</script>
@endsection