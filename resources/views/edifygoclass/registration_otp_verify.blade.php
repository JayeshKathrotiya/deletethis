@extends('edifygoclass.layout')
@section('contents')
<?php $reg_data = session('class_reg_session'); ?>
<?php $class_reg_mobile_session = session('class_reg_mobile_session'); ?>

<?php 
// echo "<pre>";
//     print_r($reg_data);die;
    if (!empty($reg_data)) {
       ?>
        <section class="breadcrumb-banner overlay" style="background-image: url('{{asset('edifygo_assets')}}/image/breadcrumb-banner.jpg')">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="breadcrumb-title">Join Us</h2>
                    </div>
                </div>
            </div>
        </section>
        <section class="registeration">
            <div class="container">
                <form action="/class/verifyOtp" method="POST" id="update_mobile" name="update_mobile">
                @csrf
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-10 col-sm-12">
                        <div class="reg-form-box">
                            <h4 class="text-center">Fill Up Your Details</h4>
                            <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>OTP has been sent to the number</label>
                                    <br>
                                    <p>+91 <?php echo $class_reg_mobile_session ? $class_reg_mobile_session : ""; ?>
                                        <input type="hidden" name="hd_edit" id="hd_edit" value="1">
                                        <input type="hidden" name="inserted_id" id="inserted_id" value="<?php echo $reg_data['inserted_id']; ?>">
                                        <!-- <a href="javascript:editMobile()" class="edit-number">Edit Number</a> -->
                                        <button onclick="javascript:editMobile()" class="edit-number" id="edit_number">Edit Number</button>
                                    </p>
                                </div>
                            </div>
                                    <div class="col-lg-8 col-md-8 col-8 hd_mobile">
                                        <div class="form-group">
                                            <input type="text" name="mobile" id="mobile" class="form-control" placeholder="Mobile Number*" value="" maxlength="10">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-4 hd_mobile">
                                        <div class="form-group pull-right">
                                            <!-- <button class="btn btn-submit">Update</button> -->
                                            <input class="btn btn-save" type="submit" name="btn_update" id="btn_update" value="Update">
                                        </div>
                                    </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label>Verify Your Mobile Number By OTP</label>
                                        <button onclick="javascript:resendOTP({{$class_reg_mobile_session}},{{$reg_data['inserted_id']}})" class="edit-number" id="resend_otp">Resend OTP</button>
                                        <input type="text" name="otp" id="otp" class="form-control" placeholder="OTP*" maxlength="4">
                                        
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="text-center">
                                        <!-- <button class="btn btn-submit">Submit</button> -->
                                        <input class="btn btn-submit" type="submit" name="btn_submit" id="btn_submit" value="Verify OTP">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </section>       
       <?php 
    }else
    {
        
    }
?>

<script type="text/javascript">

$.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });


$('#update_mobile').on('keyup keypress', function(e) {
  var keyCode = e.keyCode || e.which;
  if (keyCode === 13) { 
    e.preventDefault();
    return false;
  }
});

    $(document).ready(function(){
        $('.hd_mobile').hide();

        $('#update_mobile').validate({
            rules:
            {
                mobile:
                {
                    required:true,
                    remote:{
                       url:"{{route('cl.checkEditMobileExists')}}",
                       type:"POST",
                       dataType:"json",
                       data: 
                       {
                         inserted_id: function(){ return $("#inserted_id").val(); },
                         mobile: function(){ return $("#mobile").val(); }
                       }
                    },
                    number:true,
                    minlength:10,
                    maxlength:10
                },
                otp:
                {
                    required:function(element)
                    {
                        return $('#hd_edit').val()==1 ? true : false;
                    }
                }
            },
            messages:
            {
                mobile:
                {
                    remote:"Mobile already exists."
                },
            },
            submitHandler:function(form)
            {
                form.submit();
                $('#btn_submit').attr('disabled',true);
            }
        });
    });

    function editMobile()
    {
        $('#mobile-error').html('');
        $('#mobile').val('');
        $('.hd_mobile').hide();
        if ($('#hd_edit').val()==1)
        {
            $('.hd_mobile').show();
            $('#hd_edit').val(0);
        }else
        {
            $('#hd_edit').val(1);
        }

    }

    function resendOTP(mobile,id)
    {
        if (mobile!="" && id!="")
        {
            $('#resend_otp').attr('disabled',true);
            $.ajax({
                url:'{{route('class.resendOtp')}}',
                method:'POST',
                dataType:'JSON',
                data:{id:id,mobile:mobile},
                beforeSend:function()
                {
                    $('#resend_otp').attr('disabled',true);
                },
                success:function(data)
                {
                    // $('#resend_otp').attr('disabled',true);
                    location.reload();
                }
            });
        }
    }
</script>
@endsection