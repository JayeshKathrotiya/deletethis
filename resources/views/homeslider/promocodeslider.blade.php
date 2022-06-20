@extends('admin.layout')
@section('content')
      
    <div class="content container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header">
            @if($slider->isEmpty())
              <input type="button" class="btn btn-primary float-right" id="btn_addcat" name="btn_addcat" value="Add Promocode Slider Image" data-toggle="modal" data-target="#addshape_model" onclick="javascript:setNull()">
            @endif
            <h5 class="card-title mb-0">List All Promocode Slider Image</h5>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="tbl_mcat" class="table table-striped table-bordered sorting-data">
                  <thead>
                      <tr>
                          <th>#</th>
                          <th>Image</th>
                          <th class="action-group no-sort">Action</th>
                      </tr>
                      </thead>
                    <tbody>
                      @if(!$slider->isEmpty())
                        @foreach ($slider as $key => $value)
                      <tr>
                        <td>{{ ++$key }}</td>
                        <td><img src="{{ asset('promocode_slider_img/'.$value->image.'')}}" hight="50px" width="70px"></td>
                        <td>  
                          <a onclick="javascript:editsliderimage({{$value->id}},'{{$value->image}}')" title="Edit" class="circlebtn-edit" data-toggle="modal" data-target="#editshape_model"><i class="fa fa-edit"></i></a>
                          
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



<!-- Edit Category Model -->
<div class="modal fade" id="editshape_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Promocode Slider Image Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <form action="/promocode/update" method="POST" id="editslider" name="editslider" enctype="multipart/form-data">
     @csrf
      <div class="modal-body">
        <div class="row">
          <div class="col-md-8">
              <div class="form-group">
                <input type="hidden" name="old_file" id="old_file" value="">
                <input type="hidden" name="id" id="id" value="">
                <label>Select Image</label> <span class="req-star text-danger"> *</span>(1400px * 400px)
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

<!-- model -->
<div class="modal fade" id="addshape_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cat_countryel">Add Promocode Slider Image Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
      </div>
      <form action="/promocode/insert" method="POST" id="homeslider" name="homeslider" enctype="multipart/form-data">
         @csrf
          <div class="modal-body">
            <div class="row">   
              <div class="col-md-12">
                <div class="form-group">
                  <label>Select Image</label> <span class="req-star text-danger"> *</span>(1400px * 400px)
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
            image:
            {
                required:true,
                accept:"image/png,jpg,jpeg",
                imageSize:true
            }
        },
        messages:
        {

        },
        submitHandler: function(form) {
          form.submit();
          $('#btn_submit').attr('disabled', 'disabled');
        }

    });

    $('#editslider').validate({
        rules:
        {
            edit_image:
            {
                accept:"image/png,jpg,jpeg",
                imageSize:true
            }
        },
        messages:
        {

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
    // $('#name-error').html('');
    // $('#name').val('');
    $('#image-error').html('');
    $('#image').val('');
    $('#edit_image-error').html('');
    $('#edit_image').val('');
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
              url:'{{ route('promocode.delete_promocode_slider_data')}}',
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

function editsliderimage(id,image) 
{
  if(id != "" && image != "") {
    setNull()
    $('#id').val(id);
    var profile_url = '{{ asset('promocode_slider_img')}}';
    $('#edit_profile').attr('src',profile_url+'/'+image);
    $('#old_file').val(image);
    $('#editcountry_model').modal('show');
  }          
}
</script>
@endsection