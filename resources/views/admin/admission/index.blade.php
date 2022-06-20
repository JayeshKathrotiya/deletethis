@extends('admin.layout')
@section('content')
     
    <div class="content container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header">
            <input type="button" class="btn btn-primary float-right" id="btn_addcat" name="btn_addcat" value="Add Amount" data-toggle="modal" data-target="#addshape_model" onclick="javascript:setNull()">
          <h5 class="card-title mb-0">Admission Amount List</h5>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="tbl_mcat" class="table table-striped table-bordered sorting-data">
                  <thead>
                      <tr>
                          <th class="no-sort">#</th>
                          <th>Amount</th>
                          <th class="action-group no-sort">Action</th>
                      </tr>
                      </thead>
                    <tbody>
                      @if(!empty($amounts)) 
                      @foreach($amounts as $key => $amount)
                      <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $amount->amount }}</td>
                        <td>                              
                          <a onclick="javascript:editAmount({{ $amount->id }})" title="Edit" class="circlebtn-edit">
                          <i class="fa fa-edit"></i>
                          </a>

                          <a href="javascript:deleteAmount({{ $amount->id }})" title="Delete" class="circlebtn-delete">
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
        <h5 class="modal-title" id="cat_cityel">Add Amount</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <form action="/add_amount" method="POST" id="amount_valid" name="amount_valid">
     @csrf
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Amount</label> <span class="req-star text-danger"> *</span>
              <input type="text" name="amount" id="amount" class="form-control" maxlength="10">
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
<div class="modal fade" id="editamount_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cat_cityel">Edit Amount</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <form action="/update_amount" method="POST" id="editamount_valid" name="editamount_valid">
     @csrf
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <input type="hidden" name="hdamount_id" id="hdamount_id">
              <label>Amount</label> <span class="req-star text-danger"> *</span>
              <input type="text" name="editamount" id="editamount" class="form-control" maxlength="10">
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

    $('#amount_valid').validate({
        rules:
        {
            amount:
            {
              required:true,
              remote:{
                  url:'{{ route('admission.checkAddExistAmount') }}',
                  type:"POST",
                  dataType:"json",
                  data: 
                  { 
                      amount: function(){ return $("#amount").val(); }
                  }
              },
              price:true,
              minlength:1,
              maxlength:10
            }
        },
        messages:
        {
          amount:
          {
            remote:"Amount already exists.",
            price:"Invalid amount."
          }
        },
        submitHandler: function(form) {
          form.submit();
          $('#btn_submit').attr('disabled', 'disabled');
        }

    });

    $('#editamount_valid').validate({
        rules:
        {
            editamount:
            {
              required:true,
              remote:{
                  url:'{{ route('admission.checkEditExistAmount') }}',
                  type:"POST",
                  dataType:"json",
                  data: 
                  { 
                      editamount: function(){ return $("#editamount").val(); },
                      hdamount_id:function(){return $('#hdamount_id').val();}
                  }
              },
              price:true,
              minlength:1,
              maxlength:10
            }
        },
        messages:
        {
          editamount:
          {
            remote:"Amount already exists.",
            price:"Invalid amount."
          }
        },
        submitHandler: function(form) {
          form.submit();
          $('#btn_update').attr('disabled', 'disabled');
        }

    });
});


function editAmount(id) 
{
  if (id) {
  setNull()
  $('#hdamount_id').val(id);
    $.ajax({
          url:'{{route('admission.editAmount')}}',
          method:'POST',
          dataType:'JSON',
          data:{id:id},
          success:function(data)
          {
            if (data != false) {
              $('#editamount_model').modal('show');
              $('#editamount').val(data.amount);
            }
          }
        });
  }
}

function setNull()
{
    //add
    $('#amount-error').html('');
    $('#amount').val('');
    //edit
    $('#editamount-error').html('');
}

function deleteAmount(id)
{
  if(id) {

    $.confirm({
      title : 'Warning',
      content:"Are you sure to delete this amount?",
      buttons:{
        Confirm:function(){
           $.ajax({
              url:'{{ route('admission.deleteAmount')}}',
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