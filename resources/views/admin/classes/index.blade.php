@extends('admin.layout')
@section('content')
      
    <div class="content container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title mb-0">List All Classes</h5>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="tbl_mcat" class="table table-striped table-bordered sorting-data">
                  <thead>
                      <tr>
                          <th>#</th>
                          <th data-toggle="tooltip" data-placement="top" title="Class Name">CN</th>
                          <th data-toggle="tooltip" data-placement="top" title="Owner Name">ON</th>
                          <th>Email</th>
                          <th>Mobile</th>
                          <th>Area</th>
                          <!-- <th>Know About Class</th> -->
                          <th>Subscription</th>
                          <th>Status</th>
                          <th class="no-sort">Popular</th>
                          <th class="action-group no-sort">Action</th>
                      </tr>
                      </thead>
                    <tbody>
                      @if(!empty($classes)) 
                        @foreach ($classes as $key => $value)
                      <tr>
                        <td>{{ ++$key }}</td>
                        <td class="text-break width250">{{ $value->name }}</td>
                        <td class="width250">{{ $value->firstname }} {{ $value->lastname }}</td>
                        <td>{{ $value->email }}</td>
                        <td>{{ $value->mobile }}</td>
                        <td>{{ $value->area_name }}</td>
                        <!-- <td>{{ $value->title }}</td> -->
                        <td>
                          @if($value->issubscribe==0)
                            <span class="badge badge-warning">Pending</span>
                          @elseif($value->issubscribe==1)
                            <span class="badge badge-primary">Subscribed</span>
                          @else
                            <span class="badge badge-danger">Skipped</span>
                          @endif
                        </td>
                        <td>
                            @if($value->isapprove==0)
                              <span class="badge badge-warning">Requested</span>
                            @elseif($value->isapprove==1)
                              <span class="badge badge-primary">Approved</span>
                            @elseif($value->isapprove==2)
                              <span class="badge badge-danger">Declined</span>
                            @endif
                         </td>
                         <td>
                          @if($value->issubscribe==1 && $value->isapprove==1)
                           <input type="checkbox" name="ispopular" name="ispopular" {{$value->ispopular==1 ? 'checked' : ''}} onclick="javascript:isPopular({{ $value->id }},{{$value->ispopular}})">
                           @else
                           N/A
                           @endif
                         </td>
                        <td class="nowrap">  
                              @if($value->isapprove==0)
                                <a href="javascript:isApproveClass({{ $value->id }},1)" class="circlebtn-activate" data-toggle="tooltip" data-placement="bottom" data-original-title="Approve" title="Approve">
                                  <i class="fa fa-check"></i>
                                </a>
                                <a href="javascript:isApproveClass({{ $value->id }},2)" class="circlebtn-deactivate" data-toggle="tooltip" data-placement="bottom" data-original-title="Decline" title="Decline">
                                  <i class="fa fa-times"></i>
                                </a>
                              @elseif($value->isapprove==1)
                                <a href="javascript:isApproveClass({{ $value->id }},2)" class="circlebtn-deactivate" data-toggle="tooltip" data-placement="bottom" data-original-title="Decline" title="Decline">
                                  <i class="fa fa-times"></i>
                                </a>
                              @elseif($value->isapprove==2)
                                <a href="javascript:isApproveClass({{ $value->id }},1)" class="circlebtn-activate" data-toggle="tooltip" data-placement="bottom" data-original-title="Approve" title="Approve">
                                  <i class="fa fa-check"></i>
                                </a>
                              @endif
                              @if($value->issubscribe!=1)
                                <a href="javascript:isSubscribe({{ $value->id }},1)" class="circlebtn-activate" data-toggle="tooltip" data-placement="bottom" data-original-title="Subscribe" title="Subscribe">
                                  <i class="fa fa-bell-o"></i>
                                </a>
                              @endif
                              <a onclick="window.location.href='{{ url('ad_view_class/'.$value->id) }}'" class="circlebtn-view" data-toggle="tooltip" data-placement="bottom" title="View Class" data-original-title="View Class">
                                    <i class="fa fa-eye"></i>
                              </a> 
                              <a onclick="window.location.href='{{ url('admin_edit_class/'.$value->id) }}'" title="Edit" class="circlebtn-edit">
                              <i class="fa fa-edit"></i>
                              </a>
                              <a href="javascript:deleteClass({{ $value->id }})" title="Delete" class="circlebtn-delete">
                              <i class="fa fa-trash"></i>
                              </a>
                              <!-- <a href="#" class="circlebtn-activate" data-toggle="tooltip" data-placement="bottom" data-original-title="OKTAT Discount" title="OKTAT Discount">
                                  <i class="fa fa-percent"></i>
                                </a> -->
                              <a onclick="javascript:OktatDiscount({{ $value->id }})" title="OKTAT Discount" class="circlebtn-info" data-toggle="modal" data-target="#oktat_discount_Mdl"><i class="fa fa-percent"></i></a>
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


<!-- OktatDiscount Model -->
<div class="modal fade" id="oktat_discount_Mdl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cat_countryel">Oktat Discount List</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <form method="POST" id="oktat_discount_frm" name="oktat_discount_frm">
     @csrf
      <div class="modal-body">
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <input type="hidden" name="class_id" id="class_id">
              <input type="hidden" name="hd_class_fees_id" id="hd_class_fees_id">
              <label>Select Fees</label> <span class="req-star text-danger"> *</span>
              <select name="fees" id="fees" class="form-control" onchange="javascript:getFeesDetails()">
              </select>
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label>Default Owner Charge(%)</label>
              <input type="text" name="default_owner_charge" id="default_owner_charge" class="form-control" maxlength="100" disabled="true" readonly="true">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Class Owner Charge(%)</label> <span class="req-star text-danger"> *</span>
              <input type="text" name="class_owner_charge" id="class_owner_charge" class="form-control" maxlength="6">
            </div>
          </div>
          <div class="col-md-1" style="margin-top: 32px;margin-left: -26px;">
            <input type="submit" id="btn_addfees" class="btn btn-success" value="Add" onclick="validateClassFees()">
          </div>       
        </div>
        <div class="row">
          <div class="card-body">
            <div class="table-responsive">
              <table id="tbl_class_fees" class="table table-striped table-bordered sorting-data">
                  <thead>
                      <tr>
                          <th>#</th>
                          <th>Fee</th>
                          <th>Class Owner Charge(%)</th>
                          <th>GST(%)</th>
                          <th class="action-group no-sort">Action</th>
                      </tr>
                      </thead>
                    <tbody>
                    </tbody>
              </table>
            </div>
          </div>
        </div>
    </div>
</form>
    <div class="modal-footer">
        <!-- <button type="submit" id="btn_updatesubmit" class="btn btn-success">Update</button> -->
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
</div>
</div>
</div>

  <!-- Edit Class Model -->
<div class="modal fade" id="editclass_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cat_cityel">Edit Class</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <form action="/update_Adminclass" method="POST" id="editclass_valid" name="editclass_valid">
     @csrf
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <input type="hidden" name="hdclass_id" id="hdclass_id">
              <label>Mobile</label> <span class="req-star text-danger"> *</span>
              <input type="text" name="editmobile" id="editmobile" class="form-control" placeholder="Mobile No*" maxlength="10">
            </div>
          </div>        
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Email</label> <span class="req-star text-danger"> *</span>
              <input type="email" name="editemail" id="editemail" class="form-control" placeholder="Email Address*" maxlength="50">
            </div>
          </div>        
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" id="btn_update" class="btn btn-success">Update</button>
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
$('#editclass_valid').validate({
        rules:
        {
            editmobile:
            {
                required:true,
                remote:{
                   url:"{{route('admin.checkEditMobileExists')}}",
                   type:"POST",
                   dataType:"json",
                   data: 
                   {
                     class_id: function(){ return $("#hdclass_id").val(); },
                     mobile: function(){ return $("#editmobile").val(); }
                   }
                },
                number:true,
                minlength:10,
                maxlength:10
            },
            editemail:
            {
                required:true,
                remote:{
                   url:"{{route('admin.checkEditEmailExists')}}",
                   type:"POST",
                   dataType:"json",
                   data: 
                   {
                     class_id: function(){ return $("#hdclass_id").val(); },
                     email: function(){ return $("#editemail").val(); }
                   }
                },
                email:true,
                space:true,
                minlength:3,
                maxlength:50
            }
        },
        messages:
        {
          editmobile:
          {
            remote:"Mobile already exists."
          },
          editemail:
          {
            remote:"Email already exists."
          }
        },
        submitHandler: function(form) {
          form.submit();
          $('#btn_update').attr('disabled', 'disabled');
        }

    });
  });



function validateClassFees()
{
  // console.log("in");
  $('#oktat_discount_frm').validate({
        rules:
        {
            fees:
            {
              required:true
            },
            class_owner_charge:
            {
                required:true,
                minlength:1,
                double_validate:true,
                maxlength:6
            }
        },
        messages:
        {
          class_owner_charge:
          {
            double_validate:"Invalid Owner Charge percentage."
          },
        },
        submitHandler: function(form) {
          if ($('#btn_addfees').val()=='Add')
          {
            addClassFees();
          }else
          {
            updateClassFees();
          }
          $('#btn_addfees').attr('disabled', 'disabled');
        }

    });
}


function OktatDiscount(id)
{
  var tbl = $('#tbl_class_fees').DataTable();
  tbl.clear().draw();

  $('#fees').html('');

  if (id)
  {
    $('#class_id').val(id);
    $.each($("#fees option:selected"), function () {
          $(this).prop('selected', false);
    });
    $('#fees-error').html('');

    $('#default_owner_charge').val('');
    $('#class_owner_charge').val('');
    $('#class_owner_charge-error').html('');

    //get class fees data
      $.ajax({
        url:'{{route('admin.getClassFees')}}',
        method:'POST',
        dataType:'JSON',
        data:{id:id},
        success:function(data)
        {
          if (data.class_fees)
          {
            var counter = 1;
            for(var i=0;i<data.class_fees.length;i++)
            {
              var action ='';
              action+=' <a onclick="javascript:editClassFees('+data.class_fees[i].id+','+data.class_fees[i].class_id+')" title="Edit" class="circlebtn-edit" data-toggle="modal" data-target="#editattr_model">';
              action+='<i class="fa fa-edit"></i>';
              action+='</a>';

              action+=' <a href="javascript:deleteClassFees('+data.class_fees[i].id+','+data.class_fees[i].class_id+')" title="Delete" class="circlebtn-delete">';
              action+='<i class="fa fa-trash"></i>';
              action+='</a>';

              var GST_per = '{{$gst->GST_per ? $gst->GST_per : "N/A"}}'
              tbl.row.add([
                counter,
                data.class_fees[i].fee,
                data.class_fees[i].owner_charge_per,
                GST_per,
                action
              ]).draw(false);
              counter++;
            }
          }

          //options
          if (data.public_fees)
          {
            var length=Object.keys(data.public_fees).length;
            if (length>0)
              {
                $('<option/>').val('').html('Select').appendTo('#fees');

                for (var p =0; p<length; p++) {
                  $('<option/>').val(data.public_fees[p]['id']).html(data.public_fees[p]['fee']).appendTo('#fees');
                
                }
              }
          }
        }
      });
  }
}

function addClassFees()
{
  var class_id = $('#class_id').val();
  var fee = $("#fees option:selected").text();
  var owner_charge_per = $('#class_owner_charge').val();
  if (isNaN(fee)!=true && isNaN(owner_charge_per)!=true)
  {
    var owner_charge_amount = Math.round((fee*owner_charge_per)/100);
  }

  $.ajax({
      url:'{{route('admin.addClassFees')}}',
      method:'POST',
      dataType:'JSON',
      data:{class_id:class_id,fee:fee,owner_charge_per:owner_charge_per,owner_charge_amount:owner_charge_amount},
      success:function(data)
      {
        // $('#oktat_discount_Mdl').modal('close');
        OktatDiscount(class_id);
        $('#btn_addfees').removeAttr('disabled',true);
      }
    });

}


function updateClassFees()
{
    var class_fees_id = $('#hd_class_fees_id').val();
    if (class_fees_id)
    {
      var class_owner_charge = $('#class_owner_charge').val();
      $.ajax({
        url:'{{route('admin.updateClassFees')}}',
        method:'POST',
        dataType:'JSON',
        data:{class_fees_id:class_fees_id,class_owner_charge:class_owner_charge},
        success:function(data)
        {
          var class_id = $('#class_id').val();
          OktatDiscount(class_id);
          $('#btn_addfees').removeAttr('disabled',true);
          $('#btn_addfees').val('Add');
        }
      });
    }
}

// deleteClassFees
function deleteClassFees(id,class_id)
{
  if(id) {

    $.confirm({
      title : 'Warning',
      content:"Are you sure to delete this fees?",
      buttons:{
        Confirm:function(){
           $.ajax({
              url:'{{ route('admin.deleteClassFees')}}',
              method:'POST',
              dataType:'JSON',
              data:{id:id},
              success:function(data)
              {
                OktatDiscount(class_id);
              }
            });
        },
        Cancel:function(){

        }
      }
    });
  }
}

//editClassFees
function editClassFees(id,class_id)
{
  if (id!="" && class_id!="")
  {
    $('#fees').html('');
    $.ajax({
      url:'{{route('admin.editClassFees')}}',
      method:'POST',
      dataType:'JSON',
      data:{id:id,class_id:class_id},
      success:function(data)
      {
        //options
        // console.log(data);
          if (data.public_fees)
          {

            //set All Update Properties
            $('<option/>').val(data.public_fees['id']).html(data.public_fees['fee']).appendTo('#fees');
            getFeesDetails();
            $('#class_owner_charge').val(data.class_fees['owner_charge_per']);
            $('#hd_class_fees_id').val(data.class_fees['id']);
            $('#class_id').val(class_id);
            $('#btn_addfees').val('Update');
          }
      }
    });
  }
}

function isApproveClass(id,status)
{
  if (id!="")
  {
    $.ajax({
      url:'{{route('admin.isApproveClass')}}',
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

function isSubscribe(id)
{
  if (id!="")
  {
    $.ajax({
      url:'{{route('admin.isSubscribe')}}',
      method:'POST',
      dataType:'JSON',
      data:{id:id},
      success:function(data)
      {
        location.reload();
      }
    });
  }
}

function isPopular(id,status)
{
  if (id!="")
  {
    $.ajax({
      url:'{{route('admin.isPopular')}}',
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

function deleteClass(id)
{
  if(id) {

    $.confirm({
      title : 'Warning',
      content:"Are you sure to delete this class?",
      buttons:{
        Confirm:function(){
           $.ajax({
              url:'{{ route('admin.deleteClass')}}',
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

function editClass(id) 
{
  $('#editmobile-error').html('');
  $('#editemail-error').html('');
  if (id) {
  $('#hdclass_id').val(id);
    $.ajax({
          url:'{{route('admin.getEditClass')}}',
          method:'POST',
          dataType:'JSON',
          data:{id:id},
          success:function(data)
          {
            // console.log(data);
            if (data != false) {
              $('#editclass_model').modal('show');
              $('#editmobile').val(data.mobile);
              $('#editemail').val(data.email);
            }
          }
        });
  }
}

function getFeesDetails()
{
  $('#default_owner_charge').val('');
  var fees_id = $('#fees').val();
  if (fees_id)
  {
    $.ajax({
      url:'{{route('admin.getFeesDetails')}}',
      method:'POST',
      dataType:'JSON',
      data:{fees_id:fees_id},
      success:function(data)
      {
        if (data)
        {
          $('#default_owner_charge').val(data.owner_charge_per);
        }
      }
    });
  }
}
</script>
@endsection