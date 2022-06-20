@extends('admin.layout')
@section('content')
    
    <div class="content container-fluid">

    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header">
            <input type="button" class="btn btn-primary float-right" id="btn_addcat" name="btn_addcat" value="Add City Master" data-toggle="modal" data-target="#addshape_model" onclick="javascript:setNull()">
          <h5 class="card-title mb-0">List All City</h5>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="tbl_mcat" class="table table-striped table-bordered sorting-data">
                  <thead>
                      <tr>
                          <th>#</th>
                          <th>Country Name</th>
                          <th>State Name</th>
                          <th>City Name</th>
                          <th>Postal Code</th>
                          <th class="action-group no-sort">Action</th>
                      </tr>
                      </thead>
                    <tbody>
                      @if(!empty($city)) 
                        @foreach ($city as $key => $value)
                      <tr>
                        <td>{{ ++$key }}</td>
                        <td class="text-break">{{ $value->country_name }}</td>
                        <td class="text-break">{{ $value->state_name }}</td>
                        <td class="text-break">{{ $value->city_name }}</td>
                        <td class="text-break">{{ $value->postalcode }}</td>
                        <td>                              
                          @if($value->isactive == 1)                            
                           <a onclick="javascript:cityChange({{$value->id}},{{$value->isactive}})" title="Deactive" class="circlebtn-activate"><i class="fa fa-thumbs-up"></i></a>
                          @else
                            <a onclick="javascript:cityChange({{$value->id}},{{$value->isactive}})" title="Active" class="circlebtn-delete"><i class="fa fa-thumbs-down"></i></a>
                          @endif
                          <a onclick="javascript:editcity({{ $value->id }})" title="Edit" class="circlebtn-edit" data-toggle="modal" data-target="#editcat_model">
                          <i class="fa fa-edit"></i>
                          </a>
                          <a href="javascript:deletecity({{ $value->id }})" title="Delete" class="circlebtn-delete">
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
        <h5 class="modal-title" id="cat_cityel">Add City Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <form action="/city" method="POST" id="city_valid" name="city_valid">
     @csrf
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Select Country</label> <span class="req-star text-danger"> *</span>
              <select class="form-control" id="country_id" name="country_id" onchange="fetch_state(this)">
                <option value="">Select</option>
                @if(!empty($country))
                  @foreach ($country as $value)
                    <option value="{{ $value->id }}">{{ $value->country_name }}</option>
                  @endforeach
                @endif
              </select>
            </div>
          </div> 
          <div class="col-md-12">
            <div class="form-group">
              <label>Select State</label> <span class="req-star text-danger"> *</span>
              <select class="form-control" id="state_id" name="state_id">
                <option value="">Select</option>
              </select>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>City Name</label> <span class="req-star text-danger"> *</span>
              <input type="text" name="name" id="name" class="form-control" maxlength="100">
            </div>
          </div> 
          <div class="col-md-12">
            <div class="form-group">
              <label>Postal Code</label> <span class="req-star text-danger"> *</span>
              <input type="text" name="postalcode" id="postalcode" class="form-control" maxlength="3">
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
<div class="modal fade" id="editcity_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cat_cityel">Edit City Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <form action="/city/update_city" method="POST" id="editcity_valid" name="editcity_valid">
     @csrf
     <!-- @method('PATCH') -->
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <input type="hidden" name="city_id" id="city_id">
              <input type="hidden" name="edit_country_id" id="edit_country_id">
              <input type="hidden" name="edit_state_id" id="edit_state_id">
              <label>City Name</label> <span class="req-star text-danger"> *</span>
              <input type="text" id="edit_name" name="edit_name" class="form-control" maxlength="100" required>
            </div>
          </div>  
          <div class="col-md-12">
            <div class="form-group">
              <label>Postal Code</label> <span class="req-star text-danger"> *</span>
              <input type="text" name="editpostalcode" id="editpostalcode" class="form-control" maxlength="3">
            </div>
          </div>      
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" id="btn_updatesubmit" class="btn btn-success">Submit</button>
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

    $('#city_valid').validate({
        rules:
        {
            country_id:
            {
              required:true
            },
            state_id:
            {
              required:true
            },
            name:
            {
                required:true,
                space:true,
                minlength:1,
                maxlength:100,
                remote:{
                   url:"{{ route('city.check_city_name')}}",
                   type:"POST",
                   dataType:"json",
                   data: 
                   {
                     city_name: function(){ return $("#name").val(); },
                     state_id: function(){ return $("#state_id").val(); },
                     country_id: function(){ return $("#country_id").val(); }
                   }
                 }
            },
            postalcode:
            {
              required:true,
              remote:{
                 url:"{{ route('city.checkPostalcode')}}",
                 type:"POST",
                 dataType:"json",
                 data: 
                 {
                   postalcode: function(){ return $("#postalcode").val(); },
                   state_id: function(){ return $("#state_id").val(); },
                   country_id: function(){ return $("#country_id").val(); }
                 }
               },
              number:true,
              minlength:1,
              maxlength:3
            }
        },
        messages:
        {
          name:
          {
            remote:"City name already exists."
          },
          postalcode:
          {
            remote:"Postal code already exists."
          }
        },
        submitHandler: function(form) {
          form.submit();
          $('#btn_submit').attr('disabled', 'disabled');
        }

    });

    $('#editcity_valid').validate({
        rules:
        {
            edit_name:
            {
                required:true,
                space:true,
                minlength:1,
                maxlength:100,
                remote:{
                   url:"{{ route('city.check_city_name_edit')}}",
                   type:"POST",
                   dataType:"json",
                   data: 
                   {
                     city_name: function(){ return $("#edit_name").val(); },
                     id: function(){ return $("#city_id").val(); },
                     state_id: function(){ return $("#edit_state_id").val(); },
                     country_id: function(){ return $("#edit_country_id").val(); }
                   }
                 }
            },
            editpostalcode:
            {
                required:true,
                number:true,
                minlength:1,
                maxlength:3,
                remote:{
                   url:"{{ route('city.checkPosatalcodeEdit')}}",
                   type:"POST",
                   dataType:"json",
                   data: 
                   {
                     editpostalcode: function(){ return $("#editpostalcode").val(); },
                     id: function(){ return $("#city_id").val(); },
                     state_id: function(){ return $("#edit_state_id").val(); },
                     country_id: function(){ return $("#edit_country_id").val(); }
                   }
                 }
            }
        },
        messages:
        {
          edit_name:
          {
            remote:"City name already exists."
          },
          editpostalcode:
          {
            remote:"Postal code already exists."
          }
        },
        submitHandler: function(form) {
          form.submit();
          $('#btn_updatesubmit').attr('disabled', 'disabled');
        }
    });
});

function fetch_state(data)
{
  var id = data.value;
  $('#state_id').html('');
  $('<option/>').val('').html('Select').appendTo('#state_id');
  if(id != "") {
    $.ajax({
          url:'{{ route('city.fetch_state_data')}}',
          method:'POST',
          dataType:'JSON',
          data:{id:id},
          success:function(data)
          {
            if (data != false) {
              var len=data.length;
              for (var i =0; i<len; i++) {
                  $('<option/>').val(data[i]['id']).html(data[i]['state_name']).appendTo('#state_id');    
                }
            }
          }
        });
  }
}


function cityChange(id,status)
{
  $.ajax({
    url:'{{ route('city.cityChange')}}',
    method:'POST',
    dataType:'JSON',
    data:{id:id,status:status},
    success:function(data)
    {
      location.reload();
    }
  });
}

function editcity(id) 
{
  // console.log(id);
  if (id) {
  setNull()
  $('#city_id').val(id);
    $.ajax({
          url:'{{ route('city.fetch_city_data')}}',
          method:'POST',
          dataType:'JSON',
          data:{id:id},
          success:function(data)
          {
            if (data != false) {
              $('#editcity_model').modal('show');
              $('#edit_name').val(data.city_name);
              $('#editpostalcode').val(data.postalcode);
              $('#edit_country_id').val(data.country_id);
              $('#edit_state_id').val(data.state_id);
            }
          }
        });
  }
}

function setNull()
{
    $.each($("#country_id option:selected"), function () {
          $(this).prop('selected', false);
    });

    $.each($("#state_id option:selected"), function () {
          $(this).prop('selected', false);
    });

    $('#state_id').html('');
    $('<option/>').val('').html('Select').appendTo('#state_id');

    //add
    $('#country_id-error').html('');
    $('#state_id-error').html('');
    $('#name-error').html('');
    $('#name').val('');
    $('#postalcode-error').html('');
    $('#postalcode').val('');

    $('#edit_name-error').html('');
    $('#edit_name').val('');

    $('#editpostalcode-error').html('');
    $('#editpostalcode').val('');
}

function deletecity(id)
{
  if(id) {

    $.confirm({
      title : 'Warning',
      content:"Are you sure to delete this city?",
      buttons:{
        Confirm:function(){
           $.ajax({
              url:'{{ route('city.delete_city_data')}}',
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