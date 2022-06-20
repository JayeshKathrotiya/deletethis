@extends('admin.layout')
@section('content')      
    <div class="content container-fluid">

    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header">
            <input type="button" class="btn btn-primary float-right" id="btn_addcat" name="btn_addcat" value="Add Country Master" data-toggle="modal" data-target="#addshape_model" onclick="javascript:setNull()">
            <h5 class="card-title mb-0">List All Country Masters</h5>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="tbl_mcat" class="table table-striped table-bordered sorting-data">
                  <thead>
                      <tr>
                          <th>#</th>
                          <th>Country Name</th>
                          <th class="action-group no-sort">Action</th>
                      </tr>
                      </thead>
                    <tbody>
                      @if(!empty($country)) 
                        @foreach ($country as $key => $value)
                      <tr>
                        <td>{{ ++$key }}</td>
                        <td class="text-break">{{ $value->country_name }}</td>
                        <td>                              
                          <a onclick="javascript:editcountry({{ $value->id }})" title="Edit" class="circlebtn-edit" data-toggle="modal" data-target="#editcat_model">
                          <i class="fa fa-edit"></i>
                          </a>
                          <a href="javascript:deletecountry({{ $value->id }})" title="Delete" class="circlebtn-delete">
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
        <h5 class="modal-title" id="cat_countryel">Add Country Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <form action="/country" method="POST" id="country_valid" name="country_valid">
     @csrf
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Country Name</label> <span class="req-star text-danger"> *</span>
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
<div class="modal fade" id="editcountry_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cat_countryel">Edit Country Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <form action="/country/update_country" method="POST" id="editcountry_valid" name="editcountry_valid">
     @csrf
     <!-- @method('PATCH') -->
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <input type="hidden" name="country_id" id="country_id">
              <label>Country Name</label> <span class="req-star text-danger"> *</span>
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

    $('#country_valid').validate({
        rules:
        {
            name:
            {
                required:true,
                space:true,
                minlength:1,
                maxlength:100,
                remote:{
                   url:"{{ route('country.check_country_name')}}",
                   type:"POST",
                   dataType:"json",
                   data: 
                   {
                     country_name: function(){ return $("#name").val(); }
                   }
                 }
            }
        },
        messages:
        {
          name:
          {
            remote:"Country name already exists."
          }
        },
        submitHandler: function(form) {
          form.submit();
          $('#btn_submit').attr('disabled', 'disabled');
        }

    });

    $('#editcountry_valid').validate({
        rules:
        {
            edit_name:
            {
                required:true,
                space:true,
                minlength:1,
                maxlength:100,
                remote:{
                   url:"{{ route('country.check_country_name_edit')}}",
                   type:"POST",
                   dataType:"json",
                   data: 
                   {
                     country_name: function(){ return $("#edit_name").val(); },
                     id: function(){ return $("#country_id").val(); }
                   }
                 }
            }
        },
        messages:
        {
          edit_name:
          {
            remote:"Country name already exists."
          }
        },
        submitHandler: function(form) {
          form.submit();
          $('#btn_updatesubmit').attr('disabled', 'disabled');
        }
    });
});

function editcountry(id) 
{
  if (id) {
  setNull()
  $('#country_id').val(id);
    $.ajax({
          url:'{{ route('country.fetch_country_data')}}',
          method:'POST',
          dataType:'JSON',
          data:{id:id},
          success:function(data)
          {
            if (data != false) {
              $('#editcountry_model').modal('show');
              $('#edit_name').val(data.country_name);
            }
          }
        });
  }
}

function setNull()
{
    //add
    $('#name-error').html('');
    $('#name').val('');

    $('#edit_name-error').html('');
    $('#edit_name').val('');
}

function deletecountry(id)
{
  if(id) {

    $.confirm({
      title : 'Warning',
      content:"Are you sure to delete this country?",
      buttons:{
        Confirm:function(){
           $.ajax({
              url:'{{ route('country.delete_country_data')}}',
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