@extends('admin.layout')
@section('content')
      
    <div class="content container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header">
            <input type="button" class="btn btn-primary float-right" id="btn_addcat" name="btn_addcat" value="Add Blog" data-toggle="modal" data-target="#addshape_model" onclick="javascript:setNull()">
            <h5 class="card-title mb-0">List Blogs</h5>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="tbl_mcat" class="table table-striped table-bordered sorting-data">
                  <thead>
                      <tr>
                          <th>#</th>
                          <th>Title</th>
                          <th class="no-sort">Image</th>
                          <th>Question</th>
                          <th class="no-sort">Answer</th>
                          <th class="action-group no-sort" style="width: 116px;">Action</th>
                      </tr>
                      </thead>
                    <tbody>
                      @if(!empty($blog)) 
                        @foreach ($blog as $key => $value)
                      <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $value->title }}</td>
                        <td>
                            <img src="{{ asset('blogs/'.$value->image.'')}}" hight="50px" width="70px">
                        </td>
                        <td>{{ $value->question }}</td>
                        <td><?php echo $value->description; ?></td>
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
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cat_countryel">Add Blog</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
      </div>
      <form action="/blog/insert" method="POST" id="child_category" name="child_category" enctype="multipart/form-data">
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
                  <label>Select Image</label> <span class="req-star text-danger"> *</span>(350px * 240px)
                  <input type="file" name="image" id="image" class="form-control" accept="image/*">
                </div>
              </div> 
              <div class="col-md-12">
                <div class="form-group">
                  <label>Question</label> <span class="req-star text-danger"> *</span>
                  <input type="text" name="question" id="question" class="form-control" maxlength="100">
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Answer</label> <span class="req-star text-danger"> *</span>
                  <textarea name="description" id="description" class="form-control" maxlength="10000"></textarea>
                  <label id="custome_description-error" class="error"></label>
                </div>
              </div>  
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" id="btn_submit" class="btn btn-success" onclick="check_Add_CKEditor()">Submit</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Edit Course Model -->
<div class="modal fade" id="edittesti_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cat_countryel">Edit Blog</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <form action="/blog/update" method="POST" id="editchild_category" name="editchild_category" enctype="multipart/form-data">
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
              <label>Select Image</label> <span class="req-star text-danger"> *</span>(350px * 240px)
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
              <label>Question</label> <span class="req-star text-danger"> *</span>
              <input type="text" name="edit_question" id="edit_question" class="form-control" maxlength="100">
            </div>
          </div> 
          <div class="col-md-12">
            <div class="form-group">
              <label>Answer</label> <span class="req-star text-danger"> *</span>
              <textarea name="edit_description" id="edit_description" class="form-control" maxlength="10000"></textarea>
              <label id="custome_editdescription-error" class="error"></label>
            </div>
          </div>       
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" id="btn_updatesubmit" class="btn btn-success" onclick="javascript:check_Edit_CKEditor()">Update</button>
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
    CKEDITOR.replace( 'description' );
    CKEDITOR.replace( 'edit_description' );

    $('#child_category').validate({
        ignore: [],
          debug: false,
        rules:
        {
            title:
            {
                required:true,
                space:true,
                minlength:1,
                maxlength:100,
            },
            question:
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
              required: function() 
                    {
                     CKEDITOR.instances.description.updateElement();
                    },
                    // space:true
                    maxlength:10000
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
      ignore: [],
          debug: false,
        rules:
        {
            edit_title:
            {
                required:true,
                space:true,
                minlength:1,
                maxlength:100
            },
            edit_question:
            {
                required:true,
                space:true,
                minlength:1,
                maxlength:100,
            },
            edit_image:
            {
                accept:"image/png,jpg,jpeg",
                imageSize:true
            },
            edit_description:
            {
              required:true,
              required: function() 
              {
               CKEDITOR.instances.edit_description.updateElement();
              },
              maxlength:10000
            }
        },
        messages:
        {

        },
        submitHandler: function(form) {
          form.submit();
          $('#btn_updatesubmit').attr('disabled', 'disabled');
        }
    });
});


function check_Edit_CKEditor() {
  $('#edit_description-error').html('');
    var editor_val = CKEDITOR.instances.edit_description.document.getBody().getChild(0).getText();
    editor_trim_val=$.trim(editor_val);
    if (editor_val.length>1 && editor_trim_val.length==0) {
      // console.log("in");
      $('#custome_editdescription-error').show();
      $('#custome_editdescription-error').html('Only space not allowed.');
    }else
    {
      $('#btn_update').click();
    }
}

function check_Add_CKEditor() {
  $('#description-error').html('');
    var editor_val = CKEDITOR.instances.description.document.getBody().getChild(0).getText();
    editor_trim_val=$.trim(editor_val);
    if (editor_val.length>1 && editor_trim_val.length==0) {
      // console.log("in");
      $('#custome_description-error').show();
      $('#custome_description-error').html('Only space not allowed.');
    }else
    {
      $('#btn_update').click();
    }
}

function editTesti(id) 
{
  if (id != "") {
  setNull();
  $('#hd_testi').val(id);
    $.ajax({
          url:'{{ route('blog.editTesti')}}',
          method:'POST',
          dataType:'JSON',
          data:{id:id},
          success:function(data)
          {
            // console.log(data);
            if (data != false) {
              var url = '{{ asset('blogs')}}';

              $('#edit_title').val(data.title);
              $('#edit_question').val(data.question);
              // $('#edit_description').val(data.description);
              CKEDITOR.instances['edit_description'].setData( data.description );
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
    $('#question-error').html('');
    $('#question').val('');
    $('#description').val('');
    $('#image-error').html('');
    $('#image').val('');

    $('#edit_title-error').html('');
    $('#edit_title').val('');
    $('#edit_question-error').html('');
    $('#edit_question').val('');
    $('#edit_description-error').html('');
    $('#edit_description').val('');
    $('#edit_image-error').html('');
    $('#edit_image').val('');

    $('#description-error').html('');
    $('#custome_description-error').html('');
}

function deleteTesti(id)
{
  if(id != "") {
    $.confirm({
      title : 'Warning',
      content:"Are you sure to delete this Blog?",
      buttons:{
        Confirm:function(){
           $.ajax({
              url:'{{ route('blog.isDelete')}}',
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
      url:'{{ route('blog.isActive')}}',
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