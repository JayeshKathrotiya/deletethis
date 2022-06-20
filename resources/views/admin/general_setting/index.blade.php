@extends('admin.layout')
@section('content')      
    <div class="content container-fluid">

    <div class="row">
      <div class="col-sm-6">
        <div class="card">
          <div class="card-header">
          	@if(!$value)
            
            @endif
            <h5 class="card-title mb-0">Setting Value</h5>
          </div>
          <div class="card-body">
            @if(!$value)
            <form action="/add_value" method="POST" id="value_valid" name="value_valid">
             @csrf
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Trial Course Fee</label> <span class="req-star text-danger"> *</span>
                      <input type="text" name="trial_course_fee" id="trial_course_fee" class="form-control" maxlength="10">
                    </div>
                  </div> 
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Student Discount(%)</label> <span class="req-star text-danger"> *</span>
                      <input type="text" name="student_discount_perc" id="student_discount_perc" class="form-control" maxlength="6">
                    </div>
                  </div>        
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>GST(%)</label> <span class="req-star text-danger"> *</span>
                      <input type="text" name="GST_per" id="GST_per" class="form-control" maxlength="3">
                    </div>
                  </div> 
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Subscription Charge</label> <span class="req-star text-danger"> *</span>
                      <input type="text" name="subscription_charge" id="subscription_charge" class="form-control" maxlength="10">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Exclusive Charge(%)</label> <span class="req-star text-danger"> *</span>
                      <input type="text" name="exclusive_charge_per" id="exclusive_charge_per" class="form-control" maxlength="3">
                    </div>
                  </div> 
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Exclusive Student Discount(%)</label> <span class="req-star text-danger"> *</span>
                      <input type="text" name="ex_student_discount_perc" id="ex_student_discount_perc" class="form-control" maxlength="6">
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Offer Text</label>
                      <textarea name="offer_text" id="offer_text" class="form-control" maxlength="200"></textarea>
                    </div>
                  </div>        
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" id="btn_submit" class="btn btn-success">Submit</button>
            </div>
        </form>
        @endif

        @if($value)
            <form action="/update_value" method="POST" id="editvalue_valid" name="editvalue_valid">
             @csrf
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="hidden" name="hdvalue_id" id="hdvalue_id" value="{{ $value->id }}">
                      <label>Trial Course Fee</label> <span class="req-star text-danger"> *</span>
                      <input type="text" name="edittrial_course_fee" id="edittrial_course_fee" class="form-control" maxlength="10" value="{{ $value->trial_course_fee }}">
                    </div>
                  </div> 
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Student Discount(%)</label> <span class="req-star text-danger"> *</span>
                      <input type="text" name="editstudent_discount_perc" id="editstudent_discount_perc" class="form-control" maxlength="6" value="{{ $value->student_discount_perc }}">
                    </div>
                  </div>        
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>GST(%)</label> <span class="req-star text-danger"> *</span>
                      <input type="text" name="editGST_per" id="editGST_per" class="form-control" maxlength="3" value="{{ $value->GST_per }}">
                    </div>
                  </div> 
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Subscription Charge</label> <span class="req-star text-danger"> *</span>
                      <input type="text" name="editsubscription_charge" id="editsubscription_charge" class="form-control" maxlength="10" value="{{ $value->subscription_charge }}">
                    </div>
                  </div>        
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Exclusive Charge(%)</label> <span class="req-star text-danger"> *</span>
                      <input type="text" name="editexclusive_charge_per" id="editexclusive_charge_per" class="form-control" maxlength="3" value="{{ $value->exclusive_charge_per }}">
                    </div>
                  </div>        
                  <div class="col-md-6">
                      <div class="form-group">
                        <label>Exclusive Student Discount(%)</label> <span class="req-star text-danger"> *</span>
                        <input type="text" name="editex_student_discount_perc" id="editex_student_discount_perc" class="form-control" maxlength="6" value="{{ $value->ex_student_discount_perc }}">
                      </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Offer Text</label>
                      <textarea name="edit_offer_text" id="edit_offer_text" class="form-control" maxlength="200">{{ $value->offer_text}}</textarea>
                    </div>
                  </div> 
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" id="btn_update" class="btn btn-success">Update</button>
            </div>
          </form>
        @endif

          </div>
        </div>
      </div>
    </div>
  </div> 

<script>
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

$(document).ready(function(){

    $('#value_valid').validate({
        rules:
        {
            trial_course_fee:
            {
              required:true,
              trial_course_fee:true,
              minlength:1,
              maxlength:10
            },
            student_discount_perc:
            {
              required:true,
              minlength:1,
              double_validate:true,
              maxlength:6
            },
            GST_per:
            {
              required:true,
              minlength:1,
              offer:true,
              maxlength:3
            },
            subscription_charge:
            {
              required:true,
              price:true,
              minlength:1,
              maxlength:10
            },
            exclusive_charge_per:
            {
              required:true,
              minlength:1,
              offer:true,
              maxlength:3
            },
            ex_student_discount_perc:
            {
              required:true,
              minlength:1,
              double_validate:true,
              maxlength:6
            },
        },
        messages:
        {
          trial_course_fee:
          {
            trial_course_fee:"Invalid trial course fee."
          },
          student_discount_perc:
          {
          	double_validate:"Invalid student discount percentage."
          },
          GST_per:
          {
          	offer:"Invalid GST percentage."
          },
          subscription_charge:
          {
          	price:"Invalid subscription charge."
          },
          exclusive_charge_per:
          {
            offer:"Invalid Exclusive percentage."
          },
          ex_student_discount_perc:
          {
            double_validate:"Invalid student discount percentage."
          }
        },
        submitHandler: function(form) {
          form.submit();
          $('#btn_submit').attr('disabled', 'disabled');
        }

    });

    $('#editvalue_valid').validate({
        rules:
        {
            edittrial_course_fee:
            {
              required:true,
              trial_course_fee:true,
              minlength:1,
              maxlength:10
            },
            editstudent_discount_perc:
            {
              required:true,
              minlength:1,
              double_validate:true,
              maxlength:6
            },
            editGST_per:
            {
              required:true,
              minlength:1,
              offer:true,
              maxlength:3
            },
            editsubscription_charge:
            {
              required:true,
              price:true,
              minlength:1,
              maxlength:10
            },
            editexclusive_charge_per:
            {
              required:true,
              minlength:1,
              offer:true,
              maxlength:3
            },
            editex_student_discount_perc:
            {
              required:true,
              minlength:1,
              double_validate:true,
              maxlength:6
            },
        },
        messages:
        {
          edittrial_course_fee:
          {
            trial_course_fee:"Invalid trial course fee."
          },
          editstudent_discount_perc:
          {
          	double_validate:"Invalid student discount percentage."
          },
          editGST_per:
          {
          	offer:"Invalid GST percentage."
          },
          editsubscription_charge:
          {
          	price:"Invalid subscription charge."
          },
          editexclusive_charge_per:
          {
            offer:"Invalid Exclusive percentage."
          },
          editex_student_discount_perc:
          {
            double_validate:"Invalid student discount percentage."
          }
        },
        submitHandler: function(form) {
          form.submit();
          $('#btn_update').attr('disabled', 'disabled');
        }

    });
});

function setNull()
{
    //add
    $('#trial_course_fee-error').html('');
    $('#trial_course_fee').val('');

    $('#student_discount_perc-error').html('');
    $('#student_discount_perc').val('');

    $('#GST_per-error').html('');
    $('#GST_per').val('');

    $('#subscription_charge-error').html('');
    $('#subscription_charge').val('');


    $('#edittrial_course_fee-error').html('');
    $('#editstudent_discount_perc-error').html('');
    $('#editGST_per-error').html('');
    $('#editsubscription_charge-error').html('');
}
</script>
@endsection