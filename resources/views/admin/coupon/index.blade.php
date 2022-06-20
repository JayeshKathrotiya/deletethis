@extends('admin.layout')
@section('content')      
    <div class="content container-fluid">

    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header">
            <input type="button" class="btn btn-primary float-right" id="btn_addcat" name="btn_addcat" value="Add Coupon" data-toggle="modal" data-target="#addshape_model" onclick="javascript:setNull()">
            <h5 class="card-title mb-0">List All Coupon</h5>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="tbl_mcat" class="table table-striped table-bordered sorting-data">
                  <thead>
                      <tr>
                          <th>#</th>
                          <th>Code</th>
                          <th>Discount(%)</th>
                          <th>Start Date</th>
                          <th>End Date</th>
                          <th>Coupon Type</th>
                          <th>Courses</th>
                          <th class="action-group no-sort">Action</th>
                      </tr>
                      </thead>
                    <tbody>
                      @if(!empty($coupon)) 
                        @foreach ($coupon as $key => $value)
                      <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $value->code }}</td>
                        <td>{{ $value->perc }}</td>
                        <td>{{ date('d-m-Y',strtotime($value->start_date)) }}</td>
                        <td>{{ date('d-m-Y',strtotime($value->end_date)) }}</td>
                        <td>{{ $value->coupon_type ? "Selective":"All" }}</td>
                        <td>
                          @if($value->coupon_type==1 && !empty($value->course))
                            <div class="form-group">
                                <select class="form-control">
                                  @foreach($value->course as $key1 => $value1)
                                    <option>{{$value1->name}}</option>
                                  @endforeach
                                </select>
                            </div>
                          @else
                          {{"N/A"}}
                          @endif
                        </td>
                        <td>
                              <a href="javascript:isActive({{ $value->id }},{{ $value->isactive }})" class="{{ $value->isactive ? 'circlebtn-activate' : 'circlebtn-deactivate'}}" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="{{ $value->isactive ? 'Deactive' : 'Active'}}">
                                <i class="{{ $value->isactive ? 'fa fa-thumbs-up' : 'fa fa-thumbs-down'}}"></i>
                              </a>
                                    
                              <a onclick="javascript:editCoupon({{ $value->id }})" title="Edit" class="circlebtn-edit" data-toggle="modal" data-target="#editshape_model">
                                <i class="fa fa-edit"></i>
                              </a>
                              <a href="javascript:deleteCoupon({{ $value->id }})" title="Delete" class="circlebtn-delete">
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
<!-- Add Category Model -->
<div class="modal fade" id="addshape_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cat_countryel">Add Coupon</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <form action="/add_coupon" method="POST" id="coupon_valid" name="coupon_valid">
     @csrf
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Coupon Code</label> <span class="req-star text-danger"> *</span>
              <input type="text" name="code" id="code" class="form-control" maxlength="20" onkeyup="javascript:toUpperCase(this)">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Discount(%)</label> <span class="req-star text-danger"> *</span>
              <input type="text" name="perc" id="perc" class="form-control" maxlength="3">
            </div>
          </div>        
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="end_time">Coupon Type : </label> <span class="req-star text-danger">*</span>
              <br>
              <div class="radio radio-primary radio-inline form-check-inline">
                <input class="form-check-input" type="radio" name="coupon_type" id="time_slot" value="0" checked="">
                <label class="form-check-label" for="time_slot">All</label>
              </div>
              <div class="radio radio-primary radio-inline form-check-inline">
                <input class="form-check-input" type="radio" name="coupon_type" id="number_slot" value="1">
                <label class="form-check-label" for="number_slot">Selective</label>
              </div>
            </div>
          </div>       
        </div>
        <div class="row" id="coupon_time">
          <div class="col-md-12">
            <div class="form-group">
                <label for="course">Select Course : </label> <span class="req-star text-danger">*</span>
                <select class="form-control select2" multiple="multiple" name="course[]" id="course" data-placeholder=" Select" style="width: 98%;">
                    <?php
                    if (!empty($courses)) {
                      foreach ($courses as $key => $course) {
                        ?>
                        <option class="op_cls" id="pro_<?php echo $course->id; ?>" value="<?php echo $course->id; ?>"><?php echo $course->name; ?></option>
                        <?php
                      }
                    }
                    ?>
                </select>
              </div>
          </div>       
        </div>
        <div class="row mt-2">
          <div class="col-md-6">
            <div class="form-group">
              <label for="datetime1">From Date</label> <span class="req-star text-danger">*</span>
              <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                  <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker1" id="datetime1" name="datetime1"/>
                  <div class="input-group-append one_date" data-target="#datetimepicker1" data-toggle="datetimepicker">
                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                  </div>
              </div>

            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label for="datetime2">To Date</label> <span class="req-star text-danger">*</span>
              <div class="input-group date" id="datetimepicker2" data-target-input="nearest">
                  <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker2" id="datetime2" name="datetime2" />
                  <div class="input-group-append two_date" data-target="#datetimepicker2" data-toggle="datetimepicker">
                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                  </div>
              </div>
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
        <h5 class="modal-title" id="cat_countryel">Add Coupon</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <form action="/update_coupon" method="POST" id="editcoupon_valid" name="editcoupon_valid">
     @csrf
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <input type="hidden" name="coupon_id" id="coupon_id">
              <label>Coupon Code</label> <span class="req-star text-danger"> *</span>
              <input type="text" name="editcode" id="editcode" class="form-control" maxlength="20" onkeyup="javascript:toUpperCase(this)">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Discount(%)</label> <span class="req-star text-danger"> *</span>
              <input type="text" name="editperc" id="editperc" class="form-control" maxlength="3">
            </div>
          </div>        
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="end_time">Coupon Type : </label> <span class="req-star text-danger">*</span>
              <br>
              <div class="radio radio-primary radio-inline form-check-inline">
                <input class="form-check-input" type="radio" name="editcoupon_type" id="editall" value="0" checked="">
                <label class="form-check-label" for="editall">All</label>
              </div>
              <div class="radio radio-primary radio-inline form-check-inline">
                <input class="form-check-input" type="radio" name="editcoupon_type" id="editselective" value="1">
                <label class="form-check-label" for="editselective">Selective</label>
              </div>
            </div>
          </div>       
        </div>
        <div class="row" id="editcoupon_time">
          <div class="col-md-12">
            <div class="form-group">
                <label for="course">Select Course : </label> <span class="req-star text-danger">*</span>
                <select class="form-control select2" multiple="multiple" name="editcourse[]" id="editcourse" data-placeholder=" Select" style="width: 98%;">
                    <?php
                    if (!empty($courses)) {
                      foreach ($courses as $key => $course) {
                        ?>
                        <option class="op_cls" id="editpro_<?php echo $course->id; ?>" value="<?php echo $course->id; ?>"><?php echo $course->name; ?></option>
                        <?php
                      }
                    }
                    ?>
                </select>
              </div>
          </div>       
        </div>
        <div class="row mt-2">
          <div class="col-md-6">
            <div class="form-group">
              <label for="datetime1">From Date</label> <span class="req-star text-danger">*</span>
              <div class="input-group date" id="editdatetimepicker1" data-target-input="nearest">
                  <input type="text" class="form-control datetimepicker-input" data-target="#editdatetimepicker1" id="editdatetime1" name="editdatetime1"/>
                  <div class="input-group-append one_date" data-target="#editdatetimepicker1" data-toggle="datetimepicker">
                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                  </div>
              </div>

            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label for="datetime2">To Date</label> <span class="req-star text-danger">*</span>
              <div class="input-group date" id="editdatetimepicker2" data-target-input="nearest">
                  <input type="text" class="form-control datetimepicker-input" data-target="#editdatetimepicker2" id="editdatetime2" name="editdatetime2" />
                  <div class="input-group-append two_date" data-target="#editdatetimepicker2" data-toggle="datetimepicker">
                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                  </div>
              </div>
            </div>
          </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" id="update_btn" class="btn btn-success">Submit</button>
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

function toUpperCase(code)
{
  $('#code').val(code.value.toUpperCase());
  $('#editcode').val(code.value.toUpperCase());
}

$(document).ready(function(){
  $('#coupon_time').hide();

    //Add date time
  $(function () {
      $('#datetime1').on('click', function() {
          $('.one_date').click();
      });
      $('#datetime2').on('click', function() {
          $('.two_date').click();
      });

      $('#datetime1').keydown(function() {  return false; });
      $('#datetime2').keydown(function() {  return false; });

      $('#datetimepicker1').datetimepicker({ //defaultDate: new Date(),minDate: new Date(),
        format: 'YYYY-MM-DD'
      });
      $('#datetimepicker2').datetimepicker({ //defaultDate: new Date(),minDate: new Date()
          format: 'YYYY-MM-DD'
      });
  });

  //Edit date time
  $(function () {
      $('#editdatetime1').on('click', function() {
          $('.editone_date').click();
      });
      $('#editdatetime2').on('click', function() {
          $('.edittwo_date').click();
      });

      $('#editdatetime1').keydown(function() {  return false; });
      $('#editdatetime2').keydown(function() {  return false; });

      $('#editdatetimepicker1').datetimepicker({ //defaultDate: new Date(),minDate: new Date(),
        format: 'YYYY-MM-DD'
      });
      $('#editdatetimepicker2').datetimepicker({ //defaultDate: new Date(),minDate: new Date()
          format: 'YYYY-MM-DD'
      });
  });

  $('#coupon_valid').validate({
        rules:
        {
            code:
            {
              required:true,
              maxlength:20,
              remote:
              {
                url:'{{route('coupon.checkExists')}}',
                method:'POST',
                dataType:'JSON',
                data:
                {
                  code:function(){return $('#code').val();}
                }
              }
            },
            'course[]':
            {
              required:'#number_slot[value="1"]:checked'
            },
            datetime1:
            {
              required:true,
              greaterThanToday:true
            },
            datetime2:
            {
              required:true,
              greaterThan: "#datetime1"
            },
            perc:
            {
              required:true,
              offer:true,
              maxlength:3
            }
        },
        messages:
        {
            code:
            {
              remote:'Code aleready exists.'
            },
            per:
            {
             offer:'Invalid discount.' 
            }
        },
        submitHandler:function(form)
        {
          form.submit();
          $('#btn_submit').attr('disabled','true');
        }
    });

  $('#editcoupon_valid').validate({
        rules:
        {
            editcode:
            {
              required:true,
              maxlength:20,
              remote:
              {
                url:'{{route('coupon.checkExists')}}',
                method:'POST',
                dataType:'JSON',
                data:
                {
                  editcode:function(){return $('#editcode').val();},
                  coupon_id:function(){return $('#coupon_id').val();}
                }
              }
            },
            'editcourse[]':
            {
              required:'#editselective[value="1"]:checked'
            },
            editdatetime1:
            {
              required:true,
              greaterThanToday:true
            },
            editdatetime2:
            {
              required:true,
              greaterThan: "#editdatetime1"
            },
            editperc:
            {
              required:true,
              offer:true,
              maxlength:3
            }
        },
        messages:
        {
            editcode:
            {
              remote:'Code aleready exists.'
            },
            editper:
            {
             offer:'Invalid discount.' 
            }
        },
        submitHandler:function(form)
        {
          form.submit();
          $('#update_btn').attr('disabled','true');
        }
    });
});


$("input[name='coupon_type']").change(function(){
  $('#coupon_time').hide();
  if ($(this).val()==1)
  {
    $('#coupon_time').show();
  }
});

$("input[name='editcoupon_type']").change(function(){
  $('#editcoupon_time').hide();
  if ($(this).val()==1)
  {
    $('#editcoupon_time').show();
  }
});


function editCoupon(id)
{
  setNull();
  $('#coupon_id').val(id);
  $.ajax({
    url:'{{ route('coupon.editCoupon') }}',
    method:'POST',
    dataType:'JSON',
    data:{id,id},
    success:function(data)
    {
      // console.log(data);
      if(data)
      {

        var db_course = [];

        $('#editcode').val(data.code);
        $('#editperc').val(data.perc);
        $("#editall").prop("checked", true);
        $('#editcoupon_time').hide();
        if (data.coupon_type==1)
        {
          $("#editselective").prop("checked", true);
          $('#editcoupon_time').show();
        }

        if (data.course)
        {
          for(var i =0;i<data.course.length;i++)
          {
            db_course.push(data.course[i].course_id);
          }
        }

        $('#editcourse').val(db_course);
        $('#editcourse').trigger('change');

        $('#editdatetime1').val(data.start_date);
        $('#editdatetime2').val(data.end_date);
      }
    }
  });
}


function isActive(id,status)
{
  if(id)
  {
    $.ajax({
      url:'{{ route('coupon.isActive') }}',
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

function setNull()
  {


    //add
    $('#code-error').html('');
    $('#perc-error').html('');
    // $('#per1-error').html('');
    $('#datetime1-error').html('');
    $('#datetime2-error').html('');
    $('#course-error').html('');

    $('#code').val('');
    $('#perc').val('');
    $("#course").val(null).trigger("change");
    // $('#per1').val('');
    $('#datetime1').val('');
    $('#datetime2').val('');

    //edit
    $('#editcode-error').html('');
    $('#editcode-error').html('');
    $('#editcourse-error').html('');
    // $('#editper1-error').html('');
    $('#editdatetime1-error').html('');
    $('#editdatetime2-error').html('');
  }

function deleteCoupon(id)
{
  if(id) {

    $.confirm({
      title : 'Warning',
      content:"Are you sure to delete this Coupon?",
      buttons:{
        Confirm:function(){
           $.ajax({
              url:'{{ route('coupon.deleteCoupon')}}',
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
</script>
@endsection