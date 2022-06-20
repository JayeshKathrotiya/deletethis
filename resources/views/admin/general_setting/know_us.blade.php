@extends('admin.layout')
@section('content')      
    <div class="content container-fluid">

    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header">
            <input type="button" class="btn btn-primary float-right" id="btn_addcat" name="btn_addcat" value="Add Title" data-toggle="modal" data-target="#addshape_model" onclick="javascript:setNull()">
            <h5 class="card-title mb-0">List All "How Do You Know About Us"</h5>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="tbl_mcat" class="table table-striped table-bordered sorting-data">
                  <thead>
                      <tr>
                          <th>#</th>
                          <th>Title</th>
                          <th class="action-group no-sort">Action</th>
                      </tr>
                      </thead>
                    <tbody>
                      @if(!empty($know)) 
                        @foreach ($know as $key => $value)
                      <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $value->title }}</td>
                        <td> 
                          <a href="javascript:isActive({{ $value->id }},{{ $value->isactive }})" class="{{ $value->isactive ? 'circlebtn-activate' : 'circlebtn-deactivate'}}" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="{{ $value->isactive ? 'Deactive' : 'Active'}}">
                                <i class="{{ $value->isactive ? 'fa fa-thumbs-up' : 'fa fa-thumbs-down'}}"></i>
                          </a>

                          <a onclick="javascript:editKnow({{ $value->id }})" title="Edit" class="circlebtn-edit" data-toggle="modal" data-target="#editcountry_model">
                          <i class="fa fa-edit"></i>
                          </a>

                          <a href="javascript:deleteKnow({{ $value->id }})" title="Delete" class="circlebtn-delete">
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
        <h5 class="modal-title" id="cat_countryel">Add Title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <form action="/add_know-us" method="POST" id="know_valid" name="know_valid">
     @csrf
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Title</label> <span class="req-star text-danger"> *</span>
              <input type="text" name="title" id="title" class="form-control" maxlength="50">
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
        <h5 class="modal-title" id="cat_countryel">Edit Title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <form action="/update_know-us" method="POST" id="edit_know_valid" name="edit_know_valid">
     @csrf
     <!-- @method('PATCH') -->
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <input type="hidden" name="know_id" id="know_id">
              <label>Title</label> <span class="req-star text-danger"> *</span>
              <input type="text" id="edit_title" name="edit_title" class="form-control" maxlength="100" required>
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

    $('#know_valid').validate({
        rules:
        {
            title:
            {
                required:true,
                space:true,
                minlength:1,
                maxlength:50,
                remote:{
                   url:"{{ route('know.checkAddTitle')}}",
                   type:"POST",
                   dataType:"json",
                   data: 
                   {
                     title: function(){ return $("#title").val(); }
                   }
                 }
            }
        },
        messages:
        {
          title:
          {
            remote:"Title already exists."
          }
        },
        submitHandler: function(form) {
          form.submit();
          $('#btn_submit').attr('disabled', 'disabled');
        }

    });

    $('#edit_know_valid').validate({
        rules:
        {
            edit_title:
            {
                required:true,
                space:true,
                minlength:1,
                maxlength:50,
                remote:{
                   url:"{{ route('know.checkEditTitle')}}",
                   type:"POST",
                   dataType:"json",
                   data: 
                   {
                     know_id: function(){ return $("#know_id").val(); },
                     edit_title: function(){ return $("#edit_title").val(); }
                   }
                 }
            }
        },
        messages:
        {
          edit_title:
          {
            remote:"Title already exists."
          }
        },
        submitHandler: function(form) {
          form.submit();
          $('#btn_updatesubmit').attr('disabled', 'disabled');
        }
    });
});

function editKnow(id) 
{
  if (id) {
  setNull()
  $('#know_id').val(id);
    $.ajax({
          url:'{{ route('know.editKnow')}}',
          method:'POST',
          dataType:'JSON',
          data:{id:id},
          success:function(data)
          {
            if (data != false) {
              $('#edit_title').val(data.title);
            }
          }
        });
  }
}

function setNull()
{
    //add
    $('#title-error').html('');
    $('#title').val('');

    $('#edit_title-error').html('');
    $('#edit_title').val('');
}

function isActive(id,status)
{
  if (id)
  {
    $.ajax({
      url:'{{ route('know.isActive')}}',
      method:'POST',
      dataType:'JSON',
      data:{id:id,status:status},
      success:function(data)
      {
        window.location.reload();
      }
    });
  }
}

function deleteKnow(id)
{
  if(id) {

    $.confirm({
      title : 'Warning',
      content:"Are you sure to delete this Title?",
      buttons:{
        Confirm:function(){
           $.ajax({
              url:'{{ route('know.deleteKnow')}}',
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