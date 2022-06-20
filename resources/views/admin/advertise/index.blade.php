@extends('admin.layout')
@section('content')
      
    <div class="content container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header">
            <!-- <input type="button" class="btn btn-primary float-right" id="btn_addcat" name="btn_addcat" value="Add Main Course" data-toggle="modal" data-target="#addshape_model" onclick="javascript:setNull()"> -->
            <h5 class="card-title mb-0">List All Slider Advertise</h5>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="tbl_mcat" class="table table-striped table-bordered sorting-data">
                  <thead>
                      <tr>
                          <th>#</th>
                          <th>Slider Name</th>
                          <th>Main Course</th>
                          <th>Sub Course</th>
                          <th>Child Course</th>
                          <th>Class Name</th>
                          <th>Mobile</th>
                          <th>Status</th>
                          <th>Date</th>
                          <th class="action-group no-sort">Action</th>
                      </tr>
                      </thead>
                    <tbody>
                      @if(!empty($add)) 
                        @foreach ($add as $key => $value)
                      <tr>
                        <td>{{++$key}}</td>
                        <td>{{$value->slider_name ? $value->slider_name : "-"}}</td>
                        <td>{{$value->main_course_name ? $value->main_course_name : "N/A"}}</td>
                        <td>{{$value->sub_course_name ? $value->sub_course_name : "N/A"}}</td>
                        <td>{{$value->child_course_name ? $value->child_course_name : "N/A"}}</td>
                        <td>{{$value->class_name ? $value->class_name : "-"}}</td>
                        <td>{{$value->mobile ? $value->mobile : "-"}}</td>
                        <td>
                          @if($value->isapprove==0)
                            <span class="badge badge-warning">Requested</span>
                          @elseif($value->isapprove==1)
                            <span class="badge badge-primary">Approved</span>
                          @elseif($value->isapprove==2)
                            <span class="badge badge-danger">Declined</span>
                          @endif
                        </td>
                        <td>{{$value->date ? date('d-m-Y g:i A',strtotime($value->date)) : "-"}}</td>
                        <td> 
                              @if($value->isapprove==0)
                                <a href="javascript:isApproveRequest({{ $value->id }},1)" class="circlebtn-activate" data-toggle="tooltip" data-placement="bottom" data-original-title="Approve" title="Approve">
                                  <i class="fa fa-check"></i>
                                </a>
                                <a href="javascript:isApproveRequest({{ $value->id }},2)" class="circlebtn-deactivate" data-toggle="tooltip" data-placement="bottom" data-original-title="Decline" title="Decline">
                                  <i class="fa fa-times"></i>
                                </a>
                              @elseif($value->isapprove==1)
                                <a href="javascript:isApproveRequest({{ $value->id }},2)" class="circlebtn-deactivate" data-toggle="tooltip" data-placement="bottom" data-original-title="Decline" title="Decline">
                                  <i class="fa fa-times"></i>
                                </a>
                              @elseif($value->isapprove==2)
                                <a href="javascript:isApproveRequest({{ $value->id }},1)" class="circlebtn-activate" data-toggle="tooltip" data-placement="bottom" data-original-title="Approve" title="Approve">
                                  <i class="fa fa-check"></i>
                                </a>
                              @endif
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
                  <label>Select Image</label> <span class="req-star text-danger"> *</span>
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
              <label>Select Image</label> <span class="req-star text-danger"> *</span>
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


function isApproveRequest(id,status)
{
  if (id!="")
  {
    $.ajax({
      url:'{{route('admin.isApproveRequest')}}',
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

</script>
@endsection