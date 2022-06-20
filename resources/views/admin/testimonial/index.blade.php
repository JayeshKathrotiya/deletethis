@extends('admin.layout')
@section('content')
      
    <div class="content container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header">
            <input type="button" class="btn btn-primary float-right" id="btn_addcat" name="btn_addcat" value="Add Testimonial" data-toggle="modal" data-target="#addshape_model" onclick="javascript:setNull()">
            <h5 class="card-title mb-0">List Testimonial</h5>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="tbl_mcat" class="table table-striped table-bordered sorting-data">
                  <thead>
                      <tr>
                          <th>#</th>
                          <th>Title</th>
                          <th class="no-sort">Image</th>
                          <th class="no-sort">Description</th>
                          <th class="action-group no-sort" style="width: 116px;">Action</th>
                      </tr>
                      </thead>
                    <tbody>
                      @if(!empty($testi)) 
                        @foreach ($testi as $key => $value)
                      <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $value->title }}</td>
                        <td>
                            <img src="{{ asset('testimonial/'.$value->image.'')}}" hight="50px" width="70px">
                        </td>
                        <td>{{ $value->description }}</td>
                        <td>  
                        @if($value->isactive == 1)                            
                          <a onclick="javascript:statuschange({{$value->id}},'0')" title="Deactive" class="circlebtn-activate"><i class="fa fa-thumbs-up"></i></a>
                        @else
                          <a onclick="javascript:statuschange({{$value->id}},'1')" title="Active" class="circlebtn-delete"><i class="fa fa-thumbs-down"></i></a>
                        @endif
                          <a onclick="javascript:editTesti({{$value->id}})" title="Edit" class="circlebtn-edit" data-toggle="modal" data-target="#edittesti_model"><i class="fa fa-edit"></i></a>
                          <a href="javascript:deleteTesti({{$value->id}})" title="Delete" class="circlebtn-delete">
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
<div class="modal fade" id="addshape_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cat_countryel">Add Testimonial</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
      </div>
      <form action="/testimonial/insert" method="POST" id="child_category" name="child_category" enctype="multipart/form-data">
         @csrf
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Title</label> <span class="req-star text-danger"> *</span>
                  <input type="text" name="title" id="title" class="form-control" maxlength="100">
                </div>
              </div>                    
              <div class="col-md-12">
                <div class="form-group">
                  <label>Select Image</label> <span class="req-star text-danger"> *</span>(254px * 250px)
                  <input type="file" name="image" id="image" class="form-control" accept="image/*">
                </div>
              </div> 
              <div class="col-md-12">
                <div class="form-group">
                  <label>Description</label> <span class="req-star text-danger"> *</span>
                  <textarea name="description" id="description" class="form-control" maxlength="10000"></textarea>
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
<div class="modal fade" id="edittesti_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cat_countryel">Edit Testimonial</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <form action="/testimonial/update" method="POST" id="editchild_category" name="editchild_category" enctype="multipart/form-data">
     @csrf
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Title</label> <span class="req-star text-danger"> *</span>
              <input type="hidden" name="hd_testi" id="hd_testi">
              <input type="text" name="edit_title" id="edit_title" class="form-control" maxlength="100">
            </div>
          </div>  
          <div class="col-md-8">
            <div class="form-group">
              <input type="hidden" name="old_file" id="old_file" value="">
              <label>Select Image</label> <span class="req-star text-danger"> *</span>(254px * 250px)
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
          <div class="col-md-12">
            <div class="form-group">
              <label>Description</label> <span class="req-star text-danger"> *</span>
              <textarea name="edit_description" id="edit_description" class="form-control" maxlength="10000"></textarea>
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
            title:
            {
                required:true,
                space:true,
                minlength:1,
                maxlength:100,
            },
            image:
            {
                required:true,
                accept:"image/png,jpg,jpeg",
                imageSize:true
            },
            description:
            {
                required:true,
                space:true,
                minlength:1,
                maxlength:10000,
            },
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
            edit_title:
            {
                required:true,
                space:true,
                minlength:1,
                maxlength:100
            },
            edit_image:
            {
                accept:"image/png,jpg,jpeg",
                imageSize:true
            },
            edit_description:
            {
                required:true,
                space:true,
                minlength:1,
                maxlength:10000
            },
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

function editTesti(id) 
{
  if (id != "") {
  setNull();
  $('#hd_testi').val(id);
    $.ajax({
          url:'{{ route('testimonial.editTesti')}}',
          method:'POST',
          dataType:'JSON',
          data:{id:id},
          success:function(data)
          {
            // console.log(data);
            if (data != false) {
              var url = '{{ asset('testimonial')}}';

              $('#edit_title').val(data.title);
              $('#edit_description').val(data.description);
              $('#edit_profile').attr('src',url+'/'+data.image);
              $('#old_file').val(data.image);
              // $('#editcountry_model').modal('show');
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
    $('#description-error').html('');
    $('#description').val('');
    $('#image-error').html('');
    $('#image').val('');

    $('#edit_title-error').html('');
    $('#edit_title').val('');
    $('#edit_description-error').html('');
    $('#edit_description').val('');
    $('#edit_image-error').html('');
    $('#edit_image').val('');
}

function deleteTesti(id)
{
  if(id != "") {
    $.confirm({
      title : 'Warning',
      content:"Are you sure to delete this Testimonial?",
      buttons:{
        Confirm:function(){
           $.ajax({
              url:'{{ route('testimonial.isDelete')}}',
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

function statuschange(id,status) {
  if(id != "" && status != "") {
    $.ajax({
      url:'{{ route('testimonial.isActive')}}',
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
</script>
@endsection