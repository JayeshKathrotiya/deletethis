@extends('admin.layout')
@section('content')
     
    <div class="content container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header">
            <input type="button" class="btn btn-primary float-right" id="btn_addcat" name="btn_addcat" value="Add Fee" data-toggle="modal" data-target="#addshape_model" onclick="javascript:setNull()">
          <h5 class="card-title mb-0">Fee Structure List</h5>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="tbl_mcat" class="table table-striped table-bordered sorting-data">
                  <thead>
                      <tr>
                          <th class="no-sort">#</th>
                          <th>Fee</th>
                          <th>Owner Charge(%)</th>
                          <th>Owner Charge Amount</th>
                          <th>GST(%)</th>
                          <th class="action-group no-sort">Action</th>
                      </tr>
                      </thead>
                    <tbody>
                      @if(!empty($fees)) 
                      @foreach($fees as $key => $fee)
                      <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $fee->fee }}</td>
                        <td>{{ $fee->owner_charge_per }}</td>
                        <td>{{ $fee->owner_charge_amount }}</td>
                        <td>{{ $setting->GST_per }}</td>
                        <td>                              
                          <a onclick="javascript:editFee({{ $fee->id }})" title="Edit" class="circlebtn-edit">
                          <i class="fa fa-edit"></i>
                          </a>

                          <a href="javascript:deleteFee({{ $fee->id }})" title="Delete" class="circlebtn-delete">
                            <i class="fa fa-trash"></i>
                          </a>
                        </td>
                      </tr>
                      @endforeach
                      @endif
                  </tbody>
                </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>  

<!-- model -->
<!-- Add Category Model -->
<div class="modal fade" id="addshape_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cat_cityel">Add Fee</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <form action="/add_fee" method="POST" id="fee_valid" name="fee_valid">
     @csrf
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Fee</label> <span class="req-star text-danger"> *</span>
              <input type="text" name="fee" id="fee" class="form-control" maxlength="6" onkeyup="javascript:setAddOwnerCharge()">
            </div>
          </div>        
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Owner Charge(%)</label> <span class="req-star text-danger"> *</span>
              <input type="text" name="owner_charge_per" id="owner_charge_per" class="form-control" maxlength="3" onkeyup="javascript:setAddOwnerCharge()">
            </div>
          </div> 
          <div class="col-md-6">
            <div class="form-group">
              <label>Owner Charge Amount</label>
              <br/>
              <input type="hidden" id="hd_owner_charge_amount" name="hd_owner_charge_amount">
              <span class="form-control" id="owner_charge_amount"></span>
            </div>
          </div>        
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" id="btn_submit" class="btn btn-success">Submit</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
</form>
</div>
</div>
</div>

<!-- Edit Category Model -->
<div class="modal fade" id="editarea_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cat_cityel">Edit Fee</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <form action="/edit_fee" method="POST" id="editfee_valid" name="editfee_valid">
     @csrf
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <input type="hidden" name="hdfee_id" id="hdfee_id">
              <label>Fee</label> <span class="req-star text-danger"> *</span>
              <input type="text" name="editfee" id="editfee" class="form-control" maxlength="6" onkeyup="javascript:setEditOwnerCharge()">
            </div>
          </div>        
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Owner Charge(%)</label> <span class="req-star text-danger"> *</span>
              <input type="text" name="editowner_charge_per" id="editowner_charge_per" class="form-control" maxlength="3" onkeyup="javascript:setEditOwnerCharge()">
            </div>
          </div> 
          <div class="col-md-6">
            <div class="form-group">
              <label>Owner Charge Amount</label>
              <br/>
              <input type="hidden" id="edithd_owner_charge_amount" name="edithd_owner_charge_amount">
              <span class="form-control" id="editowner_charge_amount"></span>
            </div>
          </div>        
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" id="btn_update" class="btn btn-success">Update</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
</form>
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

    $('#fee_valid').validate({
        rules:
        {
            fee:
            {
              required:true,
              remote:{
                  url:'{{ route('fee.checkAddExistFee') }}',
                  type:"POST",
                  dataType:"json",
                  data: 
                  { 
                      fee: function(){ return $("#fee").val(); }
                  }
              },
              price:true,
              minlength:1,
              maxlength:10
            },
            owner_charge_per:
            {
              required:true,
              minlength:1,
              offer:true,
              maxlength:3
            }
        },
        messages:
        {
          fee:
          {
            remote:"Fee already exists.",
            price:"Invalid fee."
          }
        },
        submitHandler: function(form) {
          form.submit();
          $('#btn_submit').attr('disabled', 'disabled');
        }

    });

    $('#editfee_valid').validate({
        rules:
        {
            editfee:
            {
              required:true,
              remote:{
                  url:'{{ route('fee.checkEditExistFee') }}',
                  type:"POST",
                  dataType:"json",
                  data: 
                  { 
                      editfee: function(){ return $("#editfee").val(); },
                      hdfee_id:function(){return $('#hdfee_id').val();}
                  }
              },
              price:true,
              minlength:1,
              maxlength:6
            },
            editowner_charge_per:
            {
              required:true,
              minlength:1,
              offer:true,
              maxlength:3
            }
        },
        messages:
        {
          editfee:
          {
            remote:"Fee already exists.",
            price:"Invalid fee."
          }
        },
        submitHandler: function(form) {
          form.submit();
          $('#btn_update').attr('disabled', 'disabled');
        }

    });
});


function editFee(id) 
{
  if (id) {
  setNull()
  $('#hdfee_id').val(id);
    $.ajax({
          url:'{{route('fee.getEditFee')}}',
          method:'POST',
          dataType:'JSON',
          data:{id:id},
          success:function(data)
          {
            if (data != false) {
              $('#editarea_model').modal('show');
              $('#editfee').val(data.fee);
              $('#editowner_charge_per').val(data.owner_charge_per);

              $('#editowner_charge_amount').html(data.owner_charge_amount);
              $('#edithd_owner_charge_amount').val(data.owner_charge_amount);
            }
          }
        });
  }
}


function setAddOwnerCharge()
{
  var fee = parseInt($('#fee').val());
  var owner_charge_per = parseInt($('#owner_charge_per').val());
  if (isNaN(fee)!=true && isNaN(owner_charge_per)!=true)
  {
    var total = Math.round((fee*owner_charge_per)/100);
    $('#owner_charge_amount').html(total);
    $('#hd_owner_charge_amount').val(total);
  }
}

function setEditOwnerCharge()
{
  var fee = parseInt($('#editfee').val());
  var owner_charge_per = parseInt($('#editowner_charge_per').val());
  if (isNaN(fee)!=true && isNaN(owner_charge_per)!=true)
  {
    var total = Math.round((fee*owner_charge_per)/100);
    $('#editowner_charge_amount').html(total);
    $('#edithd_owner_charge_amount').val(total);
  }
}

function setNull()
{
    //add
    $('#fee-error').html('');
    $('#fee').val('');
    $('#owner_charge_per-error').html('');
    $('#owner_charge_per').val('');
    $('#owner_charge_amount').html('');
    //edit
    $('#editfee-error').html('');
    $('#editowner_charge_per-error').html('');
}

function deleteFee(id)
{
  if(id) {

    $.confirm({
      title : 'Warning',
      content:"Are you sure to delete this fee?",
      buttons:{
        Confirm:function(){
           $.ajax({
              url:'{{ route('fee.deleteFee')}}',
              method:'POST',
              dataType:'JSON',
              data:{id:id},
              success:function(data)
              {
                window.location.reload();
              }
            });
        },
        Cancel:function(){

        }
      }
    });
  }
}
</script>
@endsection