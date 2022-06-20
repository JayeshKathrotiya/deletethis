@extends('admin.layout')
@section('content')    
    <div class="content container-fluid">

    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header">
            <input type="button" class="btn btn-primary float-right" id="btn_addcat" name="btn_addcat" value="Add State Master" data-toggle="modal" data-target="#addshape_model" onclick="javascript:setNull()">
          <h5 class="card-title mb-0">List All State Masters</h5>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="tbl_mcat" class="table table-striped table-bordered sorting-data">
                  <thead>
                      <tr>
                          <th>#</th>
                          <th>Country Name</th>
                          <th>State Name</th>
                          <th class="action-group no-sort">Action</th>
                      </tr>
                      </thead>
                    <tbody>
                      @if(!empty($state)) 
                        @foreach ($state as $key => $value)
                      <tr>
                        <td>{{ ++$key }}</td>
                        <td class="text-break">{{ $value->country_name }}</td>
                        <td class="text-break">{{ $value->state_name }}</td>
                        <td>                              
                          <a onclick="javascript:editstate({{ $value->id }})" title="Edit" class="circlebtn-edit" data-toggle="modal" data-target="#editcat_model">
                          <i class="fa fa-edit"></i>
                          </a>
                          <a href="javascript:deletestate({{ $value->id }})" title="Delete" class="circlebtn-delete">
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
        <h5 class="modal-title" id="cat_stateel">Add State Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <form action="/state" method="POST" id="state_valid" name="state_valid">
     @csrf
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Select Country</label> <span class="req-star text-danger"> *</span>
              <select class="form-control" id="country_id" name="country_id">
                <option value="">Select</option>
                @if(!empty($country))
                  @foreach ($country as $value)
                    <option value="{{ $value->id }}">{{ $value->country_name }}</option>
                  @endforeach
                @endif
              </select>
            </div>
          </div> 
          <div class="col-md-12">
            <div class="form-group">
              <label>State Name</label> <span class="req-star text-danger"> *</span>
              <input type="text" name="name" id="name" class="form-control" maxlength="100">
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
<div class="modal fade" id="editstate_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cat_stateel">Edit State Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <form action="/state/update_state" method="POST" id="editstate_valid" name="editstate_valid">
     @csrf
     <!-- @method('PATCH') -->
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <input type="hidden" name="state_id" id="state_id">
              <input type="hidden" name="edit_country_id" id="edit_country_id">
              <label>State Name</label> <span class="req-star text-danger"> *</span>
              <input type="text" id="edit_name" name="edit_name" class="form-control" maxlength="100" required>
            </div>
          </div>        
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" id="btn_updatesubmit" class="btn btn-success">Update</button>
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

    $('#state_valid').validate({
        rules:
        {
            country_id:
            {
              required:true
            },
            name:
            {
                required:true,
                space:true,
                minlength:1,
                maxlength:100,
                remote:{
                   url:"{{ route('state.check_state_name')}}",
                   type:"POST",
                   dataType:"json",
                   data: 
                   {
                     state_name: function(){ return $("#name").val(); },
                     country_id: function(){ return $("#country_id").val(); }
                   }
                 }
            }
        },
        messages:
        {
          name:
          {
            remote:"State name already exists."
          }
        },
        submitHandler: function(form) {
          form.submit();
          $('#btn_submit').attr('disabled', 'disabled');
        }

    });

    $('#editstate_valid').validate({
        rules:
        {
            edit_name:
            {
                required:true,
                space:true,
                minlength:1,
                maxlength:100,
                remote:{
                   url:"{{ route('state.check_state_name_edit')}}",
                   type:"POST",
                   dataType:"json",
                   data: 
                   {
                     state_name: function(){ return $("#edit_name").val(); },
                     id: function(){ return $("#state_id").val(); },
                     country_id: function(){ return $("#edit_country_id").val(); }
                   }
                 }
            }
        },
        messages:
        {
          edit_name:
          {
            remote:"State name already exists."
          }
        },
        submitHandler: function(form) {
          form.submit();
          $('#btn_updatesubmit').attr('disabled', 'disabled');
        }
    });
});

function editstate(id) 
{
  if (id) {
  setNull()
  $('#state_id').val(id);
    $.ajax({
          url:'{{ route('state.fetch_state_data')}}',
          method:'POST',
          dataType:'JSON',
          data:{id:id},
          success:function(data)
          {
            if (data != false) {
              $('#editstate_model').modal('show');
              $('#edit_name').val(data.state_name);
              $('#edit_country_id').val(data.country_id);
            }
          }
        });
  }
}

function setNull()
{
    $.each($("#country_id option:selected"), function () {
          $(this).prop('selected', false);
    });

    //add
    $('#name-error').html('');
    $('#country_id-error').html('');
    $('#name').val('');

    $('#edit_name-error').html('');
    $('#edit_name').val('');
}

function deletestate(id)
{
  if(id) {

    $.confirm({
      title : 'Warning',
      content:"Are you sure to delete this state?",
      buttons:{
        Confirm:function(){
           $.ajax({
              url:'{{ route('state.delete_state_data')}}',
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