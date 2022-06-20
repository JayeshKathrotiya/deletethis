@extends('admin.layout')
@section('content')
      
    <div class="content container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header">
            <input type="button" class="btn btn-primary float-right" id="btn_addcat" name="btn_addcat" value="Add Sub Course" data-toggle="modal" data-target="#addshape_model" onclick="javascript:setNull()">
            <h5 class="card-title mb-0">List All Sub Course</h5>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="tbl_mcat" class="table table-striped table-bordered sorting-data">
                  <thead>
                      <tr>
                          <th>#</th>
                          <th>Main Course Name</th>
                          <th>Sub Course Name</th>
                          <th>Image</th>
                          <!-- <th>Status</th> -->
                          <th class="action-group no-sort">Action</th>
                      </tr>
                      </thead>
                    <tbody>
                      @if(!empty($sub_course)) 
                        @foreach ($sub_course as $key => $value)
                      <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $value->main_course_name }}</td>
                        <td>{{ $value->name }}</td>
                        <td>
                          <!-- dd($value->image); -->
                        @if($value->image)
                            <img src="{{ asset('sub_course/'.$value->image.'')}}" hight="50px" width="70px">
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
                          <a onclick="javascript:editsubcategory({{$value->id}},{{$value->main_id}},'{{$value->main_course_name}}')" title="Edit" class="circlebtn-edit" data-toggle="modal" data-target="#editcat_model"><i class="fa fa-edit"></i></a>

                          <!-- <a href="javascript:deletesubcategory({{$value->id}},'{{$value->image}}')" title="Delete" class="circlebtn-delete"><i class="fa fa-trash"></i></a> -->
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
        <h5 class="modal-title" id="cat_countryel">Add Sub Course Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
      </div>
      <form action="/subcategory/insert" method="POST" id="sub_category" name="sub_category" enctype="multipart/form-data">
         @csrf
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Main Course Name</label> <span class="req-star text-danger"> *</span>
                  <select name="main_id" id="main_id" class="form-control myselect" required>
                    <option value="">Select</option>
                    @if(!empty($main_course))
                         @foreach ($main_course as $key => $value)
                           <option class="text-break" value="{{$value->id}}">{{$value->name}}</option>
                         @endforeach
                    @endif
                  </select>
                </div>
              </div> 
              <div class="col-md-12">
                <div class="form-group">
                  <label>Sub Course Name</label> <span class="req-star text-danger"> *</span>
                  <input type="text" name="name" id="name" class="form-control" maxlength="100">
                </div>
              </div>      
              <div class="col-md-12">
                <div class="form-group">
                  <label>Select Image</label>
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
        <h5 class="modal-title" id="cat_countryel">Edit Sub Course Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <form action="/subcategory/update_subcategory" method="POST" id="editsub_category" name="editsub_category" enctype="multipart/form-data">
     @csrf
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Main Course Name</label><br>
              <label class="text-break" id="main_course_name"></label>
            </div>
          </div> 
          <div class="col-md-12">
            <div class="form-group">
              <input type="hidden" name="sub_category_id" id="sub_category_id">
              <input type="hidden" name="main_category_id" id="main_category_id">
              <label>Sub Course Name</label> <span class="req-star text-danger"> *</span>
              <input type="text" id="edit_name" name="edit_name" class="form-control" maxlength="100" required>
            </div>
          </div> 
          <div class="col-md-8">
            <div class="form-group">
              <input type="hidden" name="old_file" id="old_file" value="">
              <label>Select Image</label>
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

<script>
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

$(document).ready(function(){

    $('#sub_category').validate({
        rules:
        {
            name:
            {
                required:true,
                space:true,
                minlength:1,
                maxlength:100,
                remote:{
                   url:"{{route('subcategory.check_subcategory_name')}}",
                   type:"POST",
                   dataType:"json",
                   data: 
                   {
                     name: function(){ return $("#name").val(); },
                     main_id: function(){ return $("#main_id").val(); }
                   }
                 }
            },
            image:
            {
                // required:true,
                accept:"image/png,jpg,jpeg",
                imageSize:true
            },
            main_id:
            {
                required:true
            }
        },
        messages:
        {
          name:
          {
            remote:"Sub course name already exists."
          }
        },
        submitHandler: function(form) {
          form.submit();
          $('#btn_submit').attr('disabled', 'disabled');
        }

    });

    $('#editsub_category').validate({
        rules:
        {
            edit_name:
            {
                required:true,
                space:true,
                minlength:1,
                maxlength:100,
                remote:{
                   url:"{{route('subcategory.check_subcategory_name_edit')}}",
                   type:"POST",
                   dataType:"json",
                   data: 
                   {
                     edit_name: function(){ return $("#edit_name").val(); },
                     id: function(){ return $("#sub_category_id").val(); },
                     main_id: function(){ return $("#main_category_id").val(); },
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
            remote:"Sub course name already exists."
          }
        },
        submitHandler: function(form) {
          form.submit();
          $('#btn_updatesubmit').attr('disabled', 'disabled');
        }
    });
});

function editsubcategory(id,main_category_id,main_course_name) 
{
  if (id != "" && main_category_id != "" && main_course_name != "") {
  setNull()
  $('#sub_category_id').val(id);
  $('#main_category_id').val(main_category_id);  
    $.ajax({
          url:'{{ route('subcategory.fetch_subcategory_data')}}',
          method:'POST',
          dataType:'JSON',
          data:{id:id},
          success:function(data)
          {
            if (data != false) {
              var profile_url = '{{ asset('sub_course')}}';
              $('#main_course_name').text(main_course_name);
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
    $('#main_id-error').html('');
    $.each($("#main_id option:selected"), function () {
          $(this).prop('selected', false);
    });

    $('#edit_name-error').html('');
    $('#edit_name').val('');
    $('#edit_image-error').html('');
    $('#edit_image').val('');
}

function deletesubcategory(id,image)
{
  if(id != "" && image != "") {
    $.confirm({
      title : 'Warning',
      content:"Are you sure to delete this sub course?",
      buttons:{
        Confirm:function(){
           $.ajax({
              url:'{{ route('subcategory.delete_subcategory_data')}}',
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
      content:'Are you sure to '+msg+' this sub course?',
      buttons:{
        Confirm:function(){
           $.ajax({
              url:'{{ route('subcategory.change_subcategory_status')}}',
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
</script>
@endsection