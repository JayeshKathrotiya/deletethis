@extends('admin.layout')
@section('content')
      
    <div class="content container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header">
            <input type="button" class="btn btn-primary float-right" id="btn_addcat" name="btn_addcat" value="Add Main Course" data-toggle="modal" data-target="#addshape_model" onclick="javascript:setNull()">
            <h5 class="card-title mb-0">List All Main Course</h5>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="tbl_mcat" class="table table-striped table-bordered sorting-data">
                  <thead>
                      <tr>
                          <th>#</th>
                          <th>Position</th>
                          <th>Main Course Name</th>
                          <th>Image</th>
                          <!-- <th>Status</th> -->
                          <th class="action-group no-sort">Action</th>
                      </tr>
                      </thead>
                    <tbody>
                      @if(!empty($main_course)) 
                        @foreach ($main_course as $key => $value)
                      <tr>
                        <td>{{ ++$key }}</td>
                        <td style="cursor: pointer;" onclick="javascript:setPriority({{ $value->id }},{{ $value->position!=9999 ? $value->position : "" }})">{{ $value->position!=9999 ? $value->position : "" }}</td>
                        <td>{{ $value->name }}</td>
                        <td>
                          @if($value->image!="")
                            <img src="{{ asset('main_course/'.$value->image.'')}}" hight="50px" width="70px">
                          @else
                            <img src="{{ asset('assets/img/default_category.jpg')}}" hight="50px" width="70px">
                          @endif
                        </td>
                        <!-- <td>@if($value->status == 1){{'Active'}} @else {{'Deactive'}} @endif</td> -->
                        <td>  
                        @if($value->status == 1)                            
                          <a onclick="javascript:statuschange({{$value->id}},'0')" title="Deactive" class="circlebtn-activate"><i class="fa fa-thumbs-up"></i></a>
                        @else
                          <a onclick="javascript:statuschange({{$value->id}},'1')" title="Active" class="circlebtn-delete"><i class="fa fa-thumbs-down"></i></a>
                        @endif
                          <a onclick="javascript:editmaincategory({{$value->id}})" title="Edit" class="circlebtn-edit" data-toggle="modal" data-target="#editcat_model"><i class="fa fa-edit"></i></a>

                          <!-- <a href="javascript:deletemaincategory({{$value->id}},'{{$value->image}}')" title="Delete" class="circlebtn-delete"><i class="fa fa-trash"></i></a> -->
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
<div class="modal fade" id="addshape_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cat_countryel">Add Main Course Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
      </div>
      <form action="/maincategory/insert" method="POST" id="main_category" name="main_category" enctype="multipart/form-data">
         @csrf
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Main Course Name</label> <span class="req-star text-danger"> *</span>
                  <input type="text" name="name" id="name" class="form-control" maxlength="100">
                </div>
              </div>      
              <div class="col-md-12">
                <div class="form-group">
                  <label>Select Image</label>(350px * 200px)
                  <input type="file" name="image" id="image" class="form-control" accept="image/*">
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

<!-- Edit Course Model -->
<div class="modal fade" id="editcountry_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cat_countryel">Edit Main Course Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <form action="/maincategory/update_maincategory" method="POST" id="editmain_category" name="editmain_category" enctype="multipart/form-data">
     @csrf
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <input type="hidden" name="main_category_id" id="main_category_id">
              <label>Main Course Name</label> <span class="req-star text-danger"> *</span>
              <input type="text" id="edit_name" name="edit_name" class="form-control" maxlength="100" required>
            </div>
          </div> 
          <div class="col-md-8">
            <div class="form-group">
              <input type="hidden" name="old_file" id="old_file" value="">
              <label>Select Image</label>(350px * 200px)
              <input type="file" name="edit_image" id="edit_image" class="form-control" accept="image/*">
            </div>
          </div> 
          <div class="col-md-2">
            <div class="form-group">
                <label></label>
                <div class="custom-file">
                <img id="edit_profile" src="" height="50px" width="70px" alt="image not available.">
                </div>
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



<!-- priority model -->
<div class="modal fade" id="priority_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cat_countryel">Update Position</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
      </div>
      <form action="/maincategory/insert/priority" method="POST" id="position_frm" name="position_frm" enctype="multipart/form-data">
         @csrf
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Position</label> <span class="req-star text-danger"> *</span>
                  <input type="hidden" name="cat_id" id="cat_id" class="form-control" maxlength="4">
                  <input type="text" name="position" id="position" class="form-control" maxlength="4">
                </div>
              </div>  
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" id="btn_submit" class="btn btn-success">Update</button>
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

    $('#position_frm').validate({
      rules:
      {
        position:
        {
          required:true,
          remote:{
             url:"{{route('maincategory.checkPosition')}}",
             type:"POST",
             dataType:"json",
             data: 
             {
               position: function(){ return $("#position").val(); },
               cat_id: function(){ return $("#cat_id").val(); }
             }
          }
        }
      },
      messages:
      {
        position:
        {
          remote:'Position already exists.'
        }
      }

    });

    $('#main_category').validate({
        rules:
        {
            name:
            {
                required:true,
                space:true,
                minlength:1,
                maxlength:100,
                remote:{
                   url:"{{route('maincategory.check_maincategory_name')}}",
                   type:"POST",
                   dataType:"json",
                   data: 
                   {
                     name: function(){ return $("#name").val(); }
                   }
                 }
            },
            image:
            {
                // required:true,
                accept:"image/png,jpg,jpeg",
                imageSize:true
            }
        },
        messages:
        {
          name:
          {
            remote:"Main course name already exists."
          }
        },
        submitHandler: function(form) {
          form.submit();
          $('#btn_submit').attr('disabled', 'disabled');
        }

    });

    $('#editmain_category').validate({
        rules:
        {
            edit_name:
            {
                required:true,
                space:true,
                minlength:1,
                maxlength:100,
                remote:{
                   url:"{{route('maincategory.check_maincategory_name_edit')}}",
                   type:"POST",
                   dataType:"json",
                   data: 
                   {
                     edit_name: function(){ return $("#edit_name").val(); },
                     id: function(){ return $("#main_category_id").val(); }
                   }
                 }
            },
            edit_image:
            {
                accept:"image/png,jpg,jpeg",
                imageSize:true
            }
        },
        messages:
        {
          edit_name:
          {
            remote:"Main course name already exists."
          }
        },
        submitHandler: function(form) {
          form.submit();
          $('#btn_updatesubmit').attr('disabled', 'disabled');
        }
    });
});

function editmaincategory(id) 
{
  if (id) {
  setNull()
  $('#main_category_id').val(id);
    $.ajax({
          url:'{{ route('maincategory.fetch_maincategory_data')}}',
          method:'POST',
          dataType:'JSON',
          data:{id:id},
          success:function(data)
          {
            if (data != false) {
              var profile_url = '{{ asset('main_course')}}';

              $('#edit_name').val(data.name);
              if (data.image!="")
              {
                $('#edit_profile').show();
                $('#edit_profile').attr('src',profile_url+'/'+data.image);
              }else
              {
                $('#edit_profile').hide();
              }
              $('#old_file').val(data.image);
              $('#editcountry_model').modal('show');
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
    $('#image-error').html('');
    $('#image').val('');

    $('#edit_name-error').html('');
    $('#edit_name').val('');
    $('#edit_image-error').html('');
    $('#edit_image').val('');
}

function deletemaincategory(id,image)
{
  if(id != "" && image != "") {
    $.confirm({
      title : 'Warning',
      content:"Are you sure to delete this main course?",
      buttons:{
        Confirm:function(){
           $.ajax({
              url:'{{ route('maincategory.delete_maincategory_data')}}',
              method:'POST',
              dataType:'JSON',
              data:{id:id,image:image},
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

function statuschange(id,status) {
  if(id != "" && status != "") {
    var msg='';
    if(status == 1) {
      msg = 'active';
    } else {
      msg = 'deactive';
    }
    $.confirm({
      title : 'Warning',
      content:'Are you sure to '+msg+' this main course?',
      buttons:{
        Confirm:function(){
           $.ajax({
              url:'{{ route('maincategory.change_maincategory_status')}}',
              method:'POST',
              dataType:'JSON',
              data:{id:id,status:status},
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


//setPriority
function setPriority(id,position)
{
    $('#position').val(position);
    $('#cat_id').val(id);
    $('#priority_model').modal('show');
}
</script>
@endsection