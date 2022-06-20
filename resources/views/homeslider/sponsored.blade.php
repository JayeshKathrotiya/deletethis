@extends('admin.layout')
@section('content')
      
    <div class="content container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header">
            <input type="button" class="btn btn-primary float-right" id="btn_addcat" name="btn_addcat" value="Add Sponsored Slider Image" data-toggle="modal" data-target="#addshape_model" onclick="javascript:setNull()">
            <h5 class="card-title mb-0">List All Sponsored Slider Image</h5>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="tbl_mcat" class="table table-striped table-bordered sorting-data">
                  <thead>
                      <tr>
                          <th>#</th>
                          <th>City</th>
                          <th>Class Name</th>
                          <th>Main Course Name</th>
                          <th>Sub Course Name</th>
                          <th>Child Course Name</th>
                          <th>Image</th>
                          <th class="action-group no-sort">Action</th>
                      </tr>
                      </thead>
                    <tbody>
                      @if(!empty($slider)) 
                        @foreach ($slider as $key => $value)
                      <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $value->city_name }}</td>
                        <td>{{ $value->name }}</td>
                        <td>{{ $value->main_course_name }}</td>
                        <td>{{ $value->sub_course_name }}</td>
                        <td>@if(!empty($value->child_course_name)){{ $value->child_course_name }}@endif</td>
                        <td>
                          <img src="@if(!empty($value->image)) {{ asset('sponsored_slider_img/'.$value->image.'')}} @else {{ asset('class_logo/'.$value->class_logo.'')}} @endif " hight="50px" width="70px">
                        </td>
                        <td> 

                          @if($value->isactive == 1)                            
                            <a onclick="javascript:statuschange({{$value->id}},'0')" title="Deactive" class="circlebtn-activate"><i class="fa fa-thumbs-up"></i></a>
                          @else
                            <a onclick="javascript:statuschange({{$value->id}},'1')" title="Active" class="circlebtn-delete"><i class="fa fa-thumbs-down"></i></a>
                          @endif

                        <a onclick="javascript:editsliderimage({{$value->id}},{{$value->class_id}},'{{$value->image}}')" title="Edit" class="circlebtn-edit" data-toggle="modal" data-target="#editshape_model"><i class="fa fa-edit"></i></a>

                          
                          <a href="javascript:deletesliderimage({{$value->id}})" title="Delete" class="circlebtn-delete"><i class="fa fa-trash"></i></a>
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
        <h5 class="modal-title" id="cat_countryel">Add Sponsored Slider Image Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
      </div>
      <form action="/sponsored_slider/insert" method="POST" id="homeslider" name="homeslider" enctype="multipart/form-data">
         @csrf
          <div class="modal-body">
            <div class="row">

              <div class="col-md-12">
                <div class="form-group">
                  <label>Select City</label> <span class="req-star text-danger"> *</span>
                  <select name="city" id="city" class="form-control" onchange="javascript:fetch_class_data()">
                    <option value="">Select</option>
                    @if(!empty($city))
                      @foreach ($city as $key => $value)
                        <option value="{{$value->id}}">{{$value->city_name}}</option>
                      @endforeach
                    @endif
                  </select>
                </div>
              </div> 

              <div class="col-md-12">
                <div class="form-group">
                  <input type="hidden" name="clss_course_id" id="clss_course_id" value="">
                  <label>Select Class Name</label> <span class="req-star text-danger"> *</span>
                  <select name="name" id="name" class="form-control" onchange="fetch_main_course(this)">
                    <option value="">Selct</option>
                    @if(!empty($class))
                      @foreach ($class as $key => $value)
                        <option value="{{$value->id}}">{{$value->name}}</option>
                      @endforeach
                    @endif
                  </select>
                </div>
              </div>   
              <div class="col-md-12">
                <div class="form-group">
                  <label>Select Main Course Name</label> <span class="req-star text-danger"> *</span>
                  <select name="maincourse" id="maincourse" class="form-control" onchange="fetch_sub_course(this)">
                    <option value="">Selct</option>
                  </select>
                </div>
              </div>    
              <div class="col-md-12">
                <div class="form-group">
                  <label>Select Sub Course Name</label> <span class="req-star text-danger"> *</span>
                  <select name="subcourse" id="subcourse" class="form-control" onchange="fetch_child_course(this)">
                    <option value="">Selct</option>
                  </select>
                </div>
              </div> 
              <div class="col-md-12 hidden" id="child">
                <div class="form-group">
                  <label>Select Child Course Name</label> <span class="req-star text-danger"> *</span>
                  <select name="childcourse" id="childcourse" class="form-control" onchange="fetch_course_id(this)">
                    <option value="">Selct</option>
                  </select>
                </div>
              </div> 
              <div class="col-md-12">
                <div class="form-group">
                  <label>Select Image</label> <span class="req-star text-danger"> *</span>(330px * 220px)
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

<!-- Edit Category Model -->
<div class="modal fade" id="editshape_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Sponsored Slider Image Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <form action="/sponsored_slider/update" method="POST" id="editslider" name="editslider" enctype="multipart/form-data">
     @csrf
      <div class="modal-body">
        <div class="row">
          <div class="col-md-8">
              <div class="form-group">
                <input type="hidden" name="id" id="id" value="">
                <input type="hidden" name="old_file" id="old_file" value="">
                <label>Select Image</label> <span class="req-star text-danger"> *</span>(330px * 220px)
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
        <button type="submit" id="update_btn" class="btn btn-success">Update</button>
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

    $('#homeslider').validate({
        rules:
        {
            city:
            {
              required:true
            },
            name:
            {
                required:true
            },
            maincourse:
            {
              required:true
            },
            subcourse:
            {
              required:true,
              remote:{
                   url:"{{route('sponsored_slider.check_class_name')}}",
                   type:"POST",
                   dataType:"json",
                   data: 
                   {
                     name: function(){ return $("#name").val(); },
                     maincourse: function(){ return $("#maincourse").val(); },
                     subcourse: function(){ return $("#subcourse").val(); },
                     childcourse: function(){ return $("#childcourse").val(); },
                     city_id: function(){ return $("#city").val(); }
                   }
                 }
            },
            childcourse:
            {
              required:true,
              remote:{
                   url:"{{route('sponsored_slider.check_class_name')}}",
                   type:"POST",
                   dataType:"json",
                   data: 
                   {
                     name: function(){ return $("#name").val(); },
                     maincourse: function(){ return $("#maincourse").val(); },
                     subcourse: function(){ return $("#subcourse").val(); },
                     childcourse: function(){ return $("#childcourse").val(); }
                   }
                 }
            },
            image:
            {
                required:true,
                accept:"image/png,jpg,jpeg",
                imageSize:true
            }
        },
        messages:
        {
          subcourse:
          {
            remote:"Class already exists."
          },
          childcourse:
          {
            remote:"Class already exists."
          }
        },
        submitHandler: function(form) {
          form.submit();
          $('#btn_submit').attr('disabled', 'disabled');
        }

    });

    $('#editslider').validate({
        rules:
        {
            edit_city:
            {
              required:true
            },
            edit_name:
            {
                required:true
                // remote:{
                //    url:"{{route('sponsored_slider.check_class_name_edit')}}",
                //    type:"POST",
                //    dataType:"json",
                //    data: 
                //    {
                //      edit_name: function(){ return $("#edit_name").val(); },

                     // edit_city: function(){ return $("#edit_city").val(); },
                //      id: function(){ return $("#id").val(); }
                //    }
                //  }
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
            remote:"Class already exists."
          }
        },
        submitHandler: function(form) {
          form.submit();
          $('#update_btn').attr('disabled', 'disabled');
        }

    });
});


function setNull()
{
    //add
    $('#name-error').html('');
    $('#name').html('');
    $('<option/>').val('').html('Select').appendTo('#name');
     $.each($("#city option:selected"), function () {
          $(this).prop('selected', false);
    });
    $('#city-error').html('');

    $.each($("#edit_city option:selected"), function () {
          $(this).prop('selected', false);
    });
    $('#edit_city-error').html('');

    $('#edit_name-error').html('');
    $.each($("#maincourse option:selected"), function () {
          $(this).prop('selected', false);
    });
    $.each($("#subcourse option:selected"), function () {
          $(this).prop('selected', false);
    });
    $.each($("#childcourse option:selected"), function () {
          $(this).prop('selected', false);
    });

    $('#maincourse').html('');
    $('<option/>').val('').html('Select').appendTo('#maincourse');

    $('#subcourse').html('');
    $('<option/>').val('').html('Select').appendTo('#subcourse');

    $('#childcourse').html('');
    $('<option/>').val('').html('Select').appendTo('#childcourse');

    $('#maincourse-error').html('');
    $('#subcourse-error').html('');
    $('#childcourse-error').html('');
    $('#child').addClass('hidden');
    $('#clss_course_id').val('');
    $('#image-error').html('');
    $('#image').val('');
    $('#edit_image-error').html('');
    $('#edit_image').val('');
}

function deletesliderimage(id)
{
  if(id != "" ) {
    $.confirm({
      title : 'Warning',
      content:"Are you sure to delete this slider image?",
      buttons:{
        Confirm:function(){
           $.ajax({
              url:'{{ route('sponsored_slider.delete_sponsored_slider_data')}}',
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

function editsliderimage(id,class_id,image) 
{
  if(id != "" && class_id != "") {
    setNull()
    $('#id').val(id);
    $('#edit_name').val(class_id);
    $('#editcountry_model').modal('show');

    var profile_url = '{{ asset('sponsored_slider_img')}}';
    $('#edit_profile').attr('src',profile_url+'/'+image);
    $('#old_file').val(image);
  }          
}

function fetch_main_course(content)
{
  $('#child').addClass('hidden');
  $('#maincourse').html('');
  $('<option/>').val('').html('Select').appendTo('#maincourse');
  $('#subcourse').html('');
  $('<option/>').val('').html('Select').appendTo('#subcourse');
  $('#clss_course_id').val('');
  if(content.value != "") {
    var class_id = content.value;
    $.ajax({
      url:'{{ route('sponsored_slider.fetch_main_course')}}',
      dataType:'JSON',
      method:'post',
      data:{class_id:class_id},
      success:function(data)
      {
        if(data != false) {
          var length = data.length;
          if(length > 0) {
            for (var i = 0; i < length; i++) {
              $('<option/>').val(data[i]['maincourse_id']).html(data[i]['main_course_name']).appendTo('#maincourse');
            }
          }
        }
      }
    }); 
  }
}

function fetch_sub_course(argument)
{
  $('#child').addClass('hidden');
  $('#subcourse').html('');
  $('<option/>').val('').html('Select').appendTo('#subcourse');
  $('#childcourse').html('');
  $('<option/>').val('').html('Select').appendTo('#childcourse');
  $('#clss_course_id').val('');
  if(argument.value != "") {
    var class_id = $('#name').val();
    var main_course_id = argument.value;
    $.ajax({
      url:'{{ route('sponsored_slider.fetch_sub_course')}}',
      dataType:'JSON',
      method:'post',
      data:{class_id:class_id,main_course_id:main_course_id},
      success:function(data)
      {
        // console.log(data);
        if(data != false) {
          var length = data.length;
          if(length > 0) {
            for (var i = 0; i < length; i++) {
              $('<option/>').val(data[i]['subcourse_id']).html(data[i]['sub_course_name']).appendTo('#subcourse');
            }
          }
        }
      }
    }); 
  }
}

function fetch_child_course(argument)
{
  $('#child').addClass('hidden');
  $('#childcourse').html('');
  $('<option/>').val('').html('Select').appendTo('#childcourse');
  $('#clss_course_id').val('');
  if(argument.value != "") {
    var class_id = $('#name').val();
    var main_course_id = $('#maincourse').val();
    var sub_course_id = argument.value;
    $.ajax({
      url:'{{ route('sponsored_slider.fetch_child_course')}}',
      dataType:'JSON',
      method:'post',
      data:{class_id:class_id,main_course_id:main_course_id,sub_course_id:sub_course_id},
      success:function(data)
      {
        if(typeof(data) == 'object') {          
          $('#child').removeClass('hidden');
          var length = data.length;
          if(length > 0) {
            for (var i = 0; i < length; i++) {
              $('<option/>').val(data[i]['childcourse_id']).html(data[i]['child_course_name']).appendTo('#childcourse');
            }
          }
        }else {
          $('#clss_course_id').val(data);
          $('#child').addClass('hidden');
        }
      }
    }); 
  }
}

function fetch_course_id(argument) {
  if(argument.value != "") {
    var class_id = $('#name').val();
    var main_course_id = $('#maincourse').val();
    var sub_course_id = $('#subcourse').val();
    var child_course_id = argument.value;

    $.ajax({
      url:'{{ route('sponsored_slider.fetch_course_id')}}',
      dataType:'JSON',
      method:'post',
      data:{class_id:class_id,main_course_id:main_course_id,sub_course_id:sub_course_id,child_course_id:child_course_id},
      success:function(data)
      {
        if(data != false) {
          $('#clss_course_id').val(data);
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
              url:'{{ route('sponsored_slider.change_sponsored_status')}}',
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

function fetch_class_data() 
{
    $('#child').addClass('hidden');
    $('#maincourse').html('');
    $('<option/>').val('').html('Select').appendTo('#maincourse');
    $('#subcourse').html('');
    $('<option/>').val('').html('Select').appendTo('#subcourse');
    $('#clss_course_id').val('');
  
    var city_id = $('#city').val();
    $('#name').html('');
    $('<option/>').val('').html('Select').appendTo('#name');
    if(city_id != "") {
    $.ajax({
      url:'{{route('sponsored_slider.fetch_class')}}',
      method:'POST',
      dataType:'JSON',
      data:{city_id:city_id},
      success:function(data)
      {
        if (data != false) {
            var len=data.length;
            for (var i =0; i<len; i++) {
                $('<option/>').val(data[i]['id']).html(data[i]['name']).appendTo('#name');    
              }
          }
      }
    });
  }
}
</script>
@endsection