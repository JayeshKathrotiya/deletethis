@extends('admin.layout')
@section('content')
      
    <div class="content container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header">
            <input type="button" class="btn btn-primary float-right" id="btn_addcat" name="btn_addcat" value="Add Exclusive Slider Image" data-toggle="modal" data-target="#addshape_model" onclick="javascript:setNull()">
            <h5 class="card-title mb-0">List All Exclusive Slider Image</h5>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="tbl_mcat" class="table table-striped table-bordered sorting-data">
                  <thead>
                      <tr>
                          <th>#</th>
                          <!-- <th>Id</th> -->
                          <th>City</th>
                          <th>Class Name</th>
                          <th class="no-sort">Image</th>
                          <!-- <th class="no-sort">Is Available</th> -->
                          <th class="action-group no-sort">Action</th>
                      </tr>
                      </thead>
                    <tbody>
                      @if(!empty($slider)) 
                        @foreach ($slider as $key => $value)
                      <tr>
                        <td>{{ ++$key }}</td>
                        <!-- <td>{{ $value->id }}</td> -->
                        <td>{{ $value->city_name }}</td>
                        <td>{{ $value->name }}</td>
                        <td><img src="{{ asset('home_slider_img/'.$value->image.'')}}" hight="50px" width="70px"></td>
                        <!-- <td><input type="checkbox" name="isview" id="isview" {{$value->isview==1 ? "checked":""}} onchange="javascript:isViewSlider({{$value->id}},{{$value->isview}},'tbl_home_slider')"></td> -->
                        <td>  
                          <a onclick="javascript:editsliderimage({{$value->id}},{{$value->class_id}},'{{$value->image}}',{{$value->city_id}})" title="Edit" class="circlebtn-edit" data-toggle="modal" data-target="#editshape_model"><i class="fa fa-edit"></i></a>
                          <a href="javascript:deletesliderimage({{$value->id}},'{{$value->image}}')" title="Delete" class="circlebtn-delete"><i class="fa fa-trash"></i></a>
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
        <h5 class="modal-title" id="cat_countryel">Add Exclusive Slider Image Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
      </div>
      <form action="/home_slider/insert" method="POST" id="homeslider" name="homeslider" enctype="multipart/form-data">
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
                  <label>Select Class Name</label> <span class="req-star text-danger"> *</span>
                  <select name="name" id="name" class="form-control">
                    <option value="">Select</option>
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
                  <label>Select Image</label> <span class="req-star text-danger"> *</span>(1400px * 520px)
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
        <h5 class="modal-title">Edit Exclusive Slider Image Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <form action="/home_slider/update" method="POST" id="editslider" name="editslider" enctype="multipart/form-data">
     @csrf
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Select City</label> <span class="req-star text-danger"> *</span>
              <select name="edit_city" id="edit_city" class="form-control" onchange="javascript:fetch_class_data1()">
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
              <label>Select Class Name</label> <span class="req-star text-danger"> *</span>
              <select name="edit_name" id="edit_name" class="form-control">
                <option value="">Select</option>
                @if(!empty($class))
                  @foreach ($class as $key => $value)
                    <option value="{{$value->id}}">{{$value->name}}</option>
                  @endforeach
                @endif
              </select>
            </div>
          </div>

          <div class="col-md-8">
              <div class="form-group">
                <input type="hidden" name="old_file" id="old_file" value="">
                <input type="hidden" name="id" id="id" value="">
                <label>Select Image</label> <span class="req-star text-danger"> *</span>(1400px * 520px)
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
                required:true,
                remote:{
                   url:"{{route('home_slider.check_class_name')}}",
                   type:"POST",
                   dataType:"json",
                   data: 
                   {
                     name: function(){ return $("#name").val(); },
                     city: function(){ return $("#city").val(); }
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
          name:
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
                required:true,
                remote:{
                   url:"{{route('home_slider.check_class_name_edit')}}",
                   type:"POST",
                   dataType:"json",
                   data: 
                   {
                     edit_name: function(){ return $("#edit_name").val(); },
                     edit_city: function(){ return $("#edit_city").val(); },
                     id: function(){ return $("#id").val(); }
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
    $('#image-error').html('');
    $('#image').val('');
    $.each($("#city option:selected"), function () {
          $(this).prop('selected', false);
    });
    $('#city-error').html('');

    $.each($("#edit_city option:selected"), function () {
          $(this).prop('selected', false);
    });
    $('#edit_city-error').html('');
    $('#edit_name').html('');
    $('#edit_name-error').html('');
    $('#edit_image-error').html('');
    $('#edit_image').val('');
}


function isViewSlider(id,isview,tbl)
{
  if (id!="" && tbl!="")
  {
    $.ajax({
      url:'{{route('slider.isViewSlider')}}',
      method:'POST',
      dataType:'JSON',
      data:{id:id,isview:isview,tbl:tbl},
      success:function(data)
      {
        location.reload();
      }
    });
  }
}

function deletesliderimage(id,image)
{
  if(id != "" && image != "") {
    $.confirm({
      title : 'Warning',
      content:"Are you sure to delete this slider image?",
      buttons:{
        Confirm:function(){
           $.ajax({
              url:'{{ route('home_slider.delete_home_slider_data')}}',
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

function editsliderimage(id,class_id,image,city_id) 
{
  if(id != "" && class_id != "" && image != "" && city_id != "") {
    setNull()
    $('#edit_city').val(city_id);
    $('#id').val(id);
    $('<option/>').val('').html('Select').appendTo('#edit_name');
    var profile_url = '{{ asset('home_slider_img')}}';
    $('#edit_profile').attr('src',profile_url+'/'+image);
    $('#old_file').val(image);
    $('#editcountry_model').modal('show');

    if(city_id != "") {
    $.ajax({
      url:'{{route('home_slider.fetch_class')}}',
      method:'POST',
      dataType:'JSON',
      data:{city_id:city_id},
      success:function(data)
      {
        if (data != false) {
            var len=data.length;
            for (var i =0; i<len; i++) {
                $('<option/>').val(data[i]['id']).html(data[i]['name']).appendTo('#edit_name');    
              }
            $('#edit_name').val(class_id);
          }
      }
    });
  }

  }          
}

function fetch_class_data() 
{
    var city_id = $('#city').val();
    $('#name').html('');
    $('<option/>').val('').html('Select').appendTo('#name');
    if(city_id != "") {
    $.ajax({
      url:'{{route('home_slider.fetch_class')}}',
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

function fetch_class_data1() 
{
    var city_id = $('#edit_city').val();
    $('#edit_name').html('');
    $('<option/>').val('').html('Select').appendTo('#edit_name');
    if(city_id != "") {
    $.ajax({
      url:'{{route('home_slider.fetch_class')}}',
      method:'POST',
      dataType:'JSON',
      data:{city_id:city_id},
      success:function(data)
      {
        if (data != false) {
            var len=data.length;
            for (var i =0; i<len; i++) {
                $('<option/>').val(data[i]['id']).html(data[i]['name']).appendTo('#edit_name');    
              }
          }
      }
    });
  }
}
</script>
@endsection