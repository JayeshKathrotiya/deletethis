@extends('admin.layout')
@section('content')
      
    <div class="content container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header">
            <input type="button" class="btn btn-primary float-right" id="btn_addcat" name="btn_addcat" value="Add Child Course" data-toggle="modal" data-target="#addshape_model" onclick="javascript:setNull()">
            <h5 class="card-title mb-0">List All Child Course</h5>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="tbl_mcat" class="table table-striped table-bordered sorting-data">
                  <thead>
                      <tr>
                          <th>#</th>
                          <th>Main Course Name</th>
                          <th>Sub Course Name</th>
                          <th>Child Course Name</th>
                          <th>Image</th>
                          <!-- <th>Status</th> -->
                          <th class="action-group no-sort">Action</th>
                      </tr>
                      </thead>
                    <tbody>
                      @if(!empty($child_course)) 
                        @foreach ($child_course as $key => $value)
                      <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $value->main_course_name }}</td>
                        <td>{{ $value->sub_course_name }}</td>
                        <td>{{ $value->name }}</td>
                        <td>
                        @if($value->image)
                            <img src="{{ asset('child_course/'.$value->image.'')}}" hight="50px" width="70px">
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
                          <a onclick="javascript:editchildcategory({{$value->id}},{{$value->main_id}},{{$value->sub_id}},'{{$value->main_course_name}}','{{$value->sub_course_name}}')" title="Edit" class="circlebtn-edit" data-toggle="modal" data-target="#editcat_model"><i class="fa fa-edit"></i></a>

                          <!-- <a href="javascript:deletechildcategory({{$value->id}},'{{$value->image}}')" title="Delete" class="circlebtn-delete"><i class="fa fa-trash"></i></a> -->
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
        <h5 class="modal-title" id="cat_countryel">Add Child Course Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
      </div>
      <form action="/childcategory/insert" method="POST" id="child_category" name="child_category" enctype="multipart/form-data">
         @csrf
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Main Course Name</label> <span class="req-star text-danger"> *</span>
                  <select name="main_id" id="main_id" class="form-control" required onchange="fetch_sub(this)">
                    <option value="">Select</option>
                    @if(!empty($main_course))
                         @foreach ($main_course as $key => $value)
                           <option value="{{$value->id}}">{{$value->name}}</option>
                         @endforeach
                    @endif
                  </select>
                </div>
              </div> 
              <div class="col-md-12">
                <div class="form-group">
                  <label>Sub Course Name</label> <span class="req-star text-danger"> *</span>
                  <select name="sub_id" id="sub_id" class="form-control" required>
                    <option value="">Select</option>
                  </select>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Child Course Name</label> <span class="req-star text-danger"> *</span>
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
        <h5 class="modal-title" id="cat_countryel">Edit Child Course Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <form action="/childcategory/update_childcategory" method="POST" id="editchild_category" name="editchild_category" enctype="multipart/form-data">
     @csrf
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Main Course Name</label><br>
              <label id="main_course_name"></label>
            </div>
          </div> 
          <div class="col-md-12">
            <div class="form-group">
              <label>Sub Course Name</label><br>
              <label id="sub_course_name"></label>
            </div>
          </div> 
          <div class="col-md-12">
            <div class="form-group">
              <input type="hidden" name="child_category_id" id="child_category_id">
              <input type="hidden" name="main_id1" id="main_id1">
              <input type="hidden" name="sub_id1" id="sub_id1">
              <label>Child Course Name</label> <span class="req-star text-danger"> *</span>
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

    $('#child_category').validate({
        rules:
        {
            name:
            {
                required:true,
                space:true,
                minlength:1,
                maxlength:100,
                remote:{
                   url:"{{route('childcategory.check_childcategory_name')}}",
                   type:"POST",
                   dataType:"json",
                   data: 
                   {
                     name: function(){ return $("#name").val(); },
                     main_id: function(){ return $("#main_id").val(); },
                     sub_id: function(){ return $("#sub_id").val(); }
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
            },
            sub_id:
            {
                required:true
            }
        },
        messages:
        {
          name:
          {
            remote:"Child course name already exists."
          }
        },
        submitHandler: function(form) {
          form.submit();
          $('#btn_submit').attr('disabled', 'disabled');
        }

    });

    $('#editchild_category').validate({
        rules:
        {
            edit_name:
            {
                required:true,
                space:true,
                minlength:1,
                maxlength:100,
                remote:{
                   url:"{{route('childcategory.check_childcategory_name_edit')}}",
                   type:"POST",
                   dataType:"json",
                   data: 
                   {
                     edit_name: function(){ return $("#edit_name").val(); },
                     id: function(){ return $("#child_category_id").val(); },
                     main_id: function(){ return $("#main_id1").val(); },
                     sub_id: function(){ return $("#sub_id1").val(); }
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
            remote:"Child course name already exists."
          }
        },
        submitHandler: function(form) {
          form.submit();
          $('#btn_updatesubmit').attr('disabled', 'disabled');
        }
    });
});

function editchildcategory(id,main_id,sub_id,main_course_name,sub_course_name) 
{
  if (id != "" && main_course_name != "" && sub_course_name != "") {
  setNull()
  $('#child_category_id').val(id);
  $('#main_id1').val(main_id);
  $('#sub_id1').val(sub_id);
    $.ajax({
          url:'{{ route('childcategory.fetch_childcategory_data')}}',
          method:'POST',
          dataType:'JSON',
          data:{id:id},
          success:function(data)
          {
            if (data != false) {
              var profile_url = '{{ asset('child_course')}}';
              $('#main_course_name').text(main_course_name);
              $('#sub_course_name').text(sub_course_name);
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
    $('#sub_id-error').html('');
    $.each($("#main_id option:selected"), function () {
          $(this).prop('selected', false);
    });
    $.each($("#sub_id option:selected"), function () {
          $(this).prop('selected', false);
    });

    $('#edit_name-error').html('');
    $('#edit_name').val('');
    $('#edit_image-error').html('');
    $('#edit_image').val('');
}

function deletechildcategory(id,image)
{
  if(id != "" && image != "") {
    $.confirm({
      title : 'Warning',
      content:"Are you sure to delete this child course?",
      buttons:{
        Confirm:function(){
           $.ajax({
              url:'{{ route('childcategory.delete_childcategory_data')}}',
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

function fetch_sub(data)
{
  var id = data.value;
  $('#sub_id').html('');
  $('<option/>').val('').html('Select').appendTo('#sub_id');
  if(id != "") {
    $.ajax({
          url:'{{ route('childcategory.fetch_sub_data')}}',
          method:'POST',
          dataType:'JSON',
          data:{id:id},
          success:function(data)
          {
            if (data != false) {
              var len=data.length;
              for (var i =0; i<len; i++) {
                  $('<option/>').val(data[i]['id']).html(data[i]['name']).appendTo('#sub_id');    
                }
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
      content:'Are you sure to '+msg+' this child course?',
      buttons:{
        Confirm:function(){
           $.ajax({
              url:'{{ route('childcategory.change_childcategory_status')}}',
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