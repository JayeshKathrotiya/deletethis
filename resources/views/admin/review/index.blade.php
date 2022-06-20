@extends('admin.layout')
@section('content')
      
    <div class="content container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title mb-0">List All Review</h5>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="tbl_mcat" class="table table-striped table-bordered sorting-data">
                  <thead>
                      <tr>
                          <th>#</th>
                          <th>Student Name</th>
                          <th>Class Name</th>
                          <th>Course Name</th>
                          <th>Rating</th>
                          <th class="no-sort w-140">Date</th>
                          <th class="no-sort">Review</th>
                          <th class="action-group no-sort">Action</th>
                      </tr>
                      </thead>
                    <tbody>
                      @if(!empty($review)) 
                        @foreach ($review as $key => $value)
                      <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $value->firstname }} {{ $value->lastname }}</td>
                        <td>{{ $value->class_name }}</td>
                        <td>{{ $value->course_name }}</td>
                        <td>{{ $value->rating }}</td>
                        <td class="w-140">{{date("d-m-Y g:i A", strtotime($value->ratingdate))}}</td>
                        <td>{{ $value->review }}</td>
                        <td>  
                        @if($value->isapprove_review == 1)                            
                          <a onclick="javascript:statuschange({{$value->id}},{{$value->isapprove_review}})" title="Disapprove" class="circlebtn-activate"><i class="fa fa-thumbs-up"></i></a>
                        @else
                          <a onclick="javascript:statuschange({{$value->id}})" title="Approve" class="circlebtn-delete"><i class="fa fa-thumbs-down"></i></a>
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

<script>
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

function statuschange(id,status) {
  if(id != "" && status != "") {
    $.ajax({
      url:'{{ route('reviews.isapprove')}}',
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