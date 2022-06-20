@extends('admin.layout')
@section('content')
      
    <div class="content container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title mb-0">List All Students</h5>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="tbl_mcat" class="table table-striped table-bordered sorting-data">
                  <thead>
                      <tr>
                          <th>#</th>
                          <th data-toggle="tooltip" data-placement="top" title="Student Name">SN</th>
                          <th>Email</th>
                          <th>Mobile</th>
                          <th>Schoolname</th>
                          <th data-toggle="tooltip" data-placement="top" title="Know Us">KU</th>
                          <th>Country</th>
                          <th>State</th>
                          <th>City</th>
                          <th>Area</th>
                          <th>Address</th>
                      </tr>
                      </thead>
                    <tbody>
                      @if(!empty($students)) 
                        @foreach ($students as $key => $value)
                      <tr>
                        <td>{{ ++$key }}</td>
                        <td class="text-break width250">{{ $value->firstname }} {{ $value->lastname }}</td>
                        <td>{{ $value->email }}</td>
                        <td>{{ $value->mobile }}</td>
                        <td>{{ $value->schoolname }}</td>
                        <td>{{ $value->title }}</td>
                        <td>{{ $value->country_name }}</td>
                        <td>{{ $value->state_name }}</td>
                        <td>{{ $value->city_name }}</td>
                        <td>{{ $value->area_name }}</td>
                        <td>{{ $value->address }}</td>
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

  <!-- Edit Class Model -->
<div class="modal fade" id="editclass_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cat_cityel">Edit Class</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <form action="/update_Adminclass" method="POST" id="editclass_valid" name="editclass_valid">
     @csrf
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <input type="hidden" name="hdclass_id" id="hdclass_id">
              <label>Mobile</label> <span class="req-star text-danger"> *</span>
              <input type="text" name="editmobile" id="editmobile" class="form-control" placeholder="Mobile No*" maxlength="10">
            </div>
          </div>        
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Email</label> <span class="req-star text-danger"> *</span>
              <input type="email" name="editemail" id="editemail" class="form-control" placeholder="Email Address*" maxlength="50">
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
$('#editclass_valid').validate({
        rules:
        {
            editmobile:
            {
                required:true,
                remote:{
                   url:"{{route('admin.checkEditMobileExists')}}",
                   type:"POST",
                   dataType:"json",
                   data: 
                   {
                     class_id: function(){ return $("#hdclass_id").val(); },
                     mobile: function(){ return $("#editmobile").val(); }
                   }
                },
                number:true,
                minlength:10,
                maxlength:10
            },
            editemail:
            {
                required:true,
                remote:{
                   url:"{{route('admin.checkEditEmailExists')}}",
                   type:"POST",
                   dataType:"json",
                   data: 
                   {
                     class_id: function(){ return $("#hdclass_id").val(); },
                     email: function(){ return $("#editemail").val(); }
                   }
                },
                email:true,
                space:true,
                minlength:3,
                maxlength:50
            }
        },
        messages:
        {
          editmobile:
          {
            remote:"Mobile already exists."
          },
          editemail:
          {
            remote:"Email already exists."
          }
        },
        submitHandler: function(form) {
          form.submit();
          $('#btn_update').attr('disabled', 'disabled');
        }

    });
  });

function isApproveClass(id,status)
{
  if (id!="")
  {
    $.ajax({
      url:'{{route('admin.isApproveClass')}}',
      method:'POST',
      dataType:'JSON',
      data:{id:id,status:status},
      success:function(data)
      {
        location.reload();
      }
    });
  }
}

function isSubscribe(id)
{
  if (id!="")
  {
    $.ajax({
      url:'{{route('admin.isSubscribe')}}',
      method:'POST',
      dataType:'JSON',
      data:{id:id},
      success:function(data)
      {
        location.reload();
      }
    });
  }
}

function isPopular(id,status)
{
  if (id!="")
  {
    $.ajax({
      url:'{{route('admin.isPopular')}}',
      method:'POST',
      dataType:'JSON',
      data:{id:id,status:status},
      success:function(data)
      {
        location.reload();
      }
    });
  }
}

function deleteClass(id)
{
  if(id) {

    $.confirm({
      title : 'Warning',
      content:"Are you sure to delete this class?",
      buttons:{
        Confirm:function(){
           $.ajax({
              url:'{{ route('admin.deleteClass')}}',
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

function editClass(id) 
{
  $('#editmobile-error').html('');
  $('#editemail-error').html('');
  if (id) {
  $('#hdclass_id').val(id);
    $.ajax({
          url:'{{route('admin.getEditClass')}}',
          method:'POST',
          dataType:'JSON',
          data:{id:id},
          success:function(data)
          {
            // console.log(data);
            if (data != false) {
              $('#editclass_model').modal('show');
              $('#editmobile').val(data.mobile);
              $('#editemail').val(data.email);
            }
          }
        });
  }
}
</script>
@endsection