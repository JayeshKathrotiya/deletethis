@extends('edifygoclass.layout')
@section('contents')

    <section class="breadcrumb-banner overlay" style="background-image: url('{{asset('edifygo_assets')}}/image/breadcrumb-banner.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- <h2 class="breadcrumb-title">Course Class</h2> -->
                    <div class="banner-inner">
                        <div class="cls-image">
                            @if($class->class_logo)
                                <img src="{{ asset('class_logo/'.$class->class_logo.'')}}" alt="Image not available">
                            @else
                                <img src="{{ asset('edifygo_assets')}}/image/classes-logo.png" alt="Image not available">
                            @endif
                        </div>
                        <div class="cls-details">
                            <h3>{{$class->name}}</h3>
                            <p>{{$class->address}} {{$class->area_name}} {{$class->city_name}} {{$class->state_name}} {{$class->country_name}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="registeration">
    <div class="container">
        <form action="/subscribe" id="valid_subscription" method="POST">
            @csrf
            <div class="row justify-content-center">
                <div class="col-lg-12 col-md-112 col-sm-12">
                    <div class="reg-form-box">
                        <h4 class="text-center">Class Subscription</h4>
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <input type="hidden" name="class_id" id="class_id" value="{{$class->id}}">
                                    <label>Subscription Amount:-</label>
                                    <span><b>₹ {{$subscription->subscription_charge}}</b></span>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="text-center">
                                    <button class="btn btn-save" type="submit" id="btn_submit" name="pay" value="1">Make Payment</button>
                                    <button class="btn btn-save" type="submit" id="btn_skip" name="skip" value="0">Skip</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>


<script type="text/javascript">


 $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

$(document).ready(function(){
$('#valid_subscription').validate({
        rules:
        {

        },
        messages:
        {

        },
        submitHandler: function(form) {
          form.submit();
          $('#btn_submit').attr('disabled',true);
          $('#btn_skip').attr('disabled', true);
        }
    });
});
</script>
@endsection