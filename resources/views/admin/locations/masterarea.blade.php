@extends('admin.layout')
@section('content')
     
    <div class="content container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header">
            <input type="button" class="btn btn-primary float-right" id="btn_addcat" name="btn_addcat" value="Add Area" data-toggle="modal" data-target="#addshape_model" onclick="javascript:setNull()">
          <h5 class="card-title mb-0">List All Area</h5>
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
                          <th>Area Name</th>
                          <th class="action-group no-sort">Action</th>
                      </tr>
                      </thead>
                    <tbody>
                      @if(!empty($area)) 
                        @foreach ($area as $key => $value)
                      <tr>
                        <td>{{ ++$key }}</td>
                        <td class="text-break">{{ $value->country_name }}</td>
                        <td class="text-break">{{ $value->state_name }}</td>
                        <td class="text-break">{{ $value->city_name }}</td>
                        <td class="text-break">{{ $value->area_name }}</td>
                        <td>                              
                          <a onclick="javascript:editArea({{ $value->id }})" title="Edit" class="circlebtn-edit" data-toggle="modal" data-target="#editcat_model">
                          <i class="fa fa-edit"></i>
                          </a>
                          <a href="javascript:deleteArea({{ $value->id }})" title="Delete" class="circlebtn-delete">
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
        <h5 class="modal-title" id="cat_cityel">Add Area Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <form action="/add_area" method="POST" id="area_valid" name="area_valid">
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
              <select class="form-control" id="state_id" name="state_id" onchange="fetch_city(this)">
                <option value="">Select</option>
              </select>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Select City</label> <span class="req-star text-danger"> *</span>
              <select class="form-control" id="city_id" name="city_id">
                <option value="">Select</option>
              </select>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Area Name</label> <span class="req-star text-danger"> *</span>
              <input type="text" name="name" id="name" class="form-control" maxlength="100">
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
<div class="modal fade" id="editarea_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cat_cityel">Edit Area Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <form action="/area/update_area" method="POST" id="editarea_valid" name="editarea_valid">
     @csrf
     <!-- @method('PATCH') -->
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <input type="hidden" name="hdarea_id" id="hdarea_id">
              <input type="hidden" name="hdcountry_id" id="hdcountry_id">
              <input type="hidden" name="hdstate_id" id="hdstate_id">
              <input type="hidden" name="hdcity_id" id="hdcity_id">
              <label>Area Name</label> <span class="req-star text-danger"> *</span>
              <input type="text" id="edit_name" name="edit_name" class="form-control" maxlength="100" required>
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

    $('#area_valid').validate({
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
            city_id:
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
                   url:"{{route('area.checkAddAreaExists')}}",
                   type:"POST",
                   dataType:"json",
                   data: 
                   {
                     area_name: function(){ return $("#name").val(); },
                     city_id: function(){ return $("#city_id").val(); },
                     state_id: function(){ return $("#state_id").val(); },
                     country_id: function(){ return $("#country_id").val(); }
                   }
                 }
            }
        },
        messages:
        {
          name:
          {
            remote:"Area name already exists."
          }
        },
        submitHandler: function(form) {
          form.submit();
          $('#btn_submit').attr('disabled', 'disabled');
        }

    });

    $('#editarea_valid').validate({
        rules:
        {
            edit_name:
            {
                required:true,
                space:true,
                minlength:1,
                maxlength:100,
                remote:{
                   url:"{{route('area.checkEditAreaExists')}}",
                   type:"POST",
                   dataType:"json",
                   data: 
                   {
                     area_name: function(){ return $("#edit_name").val(); },
                     id: function(){ return $("#hdarea_id").val(); },
                     country_id: function(){ return $("#hdcountry_id").val(); },
                     state_id: function(){ return $("#hdstate_id").val(); },
                     city_id: function(){ return $("#hdcity_id").val(); },
                   }
                 }
            }
        },
        messages:
        {
          edit_name:
          {
            remote:"Area name already exists."
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
          url:'{{route('area.fetch_state')}}',
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

function fetch_city(data)
{
  var id = data.value;
  $('#city_id').html('');
  $('<option/>').val('').html('Select').appendTo('#city_id');
  if(id != "") {
    $.ajax({
          url:'{{route('area.fetch_city')}}',
          method:'POST',
          dataType:'JSON',
          data:{id:id},
          success:function(data)
          {
            if (data != false) {
              var len=data.length;
              for (var i =0; i<len; i++) {
                  $('<option/>').val(data[i]['id']).html(data[i]['city_name']).appendTo('#city_id');    
                }
            }
          }
        });
  }
}

function editArea(id) 
{
  if (id) {
  setNull()
  $('#hdarea_id').val(id);
    $.ajax({
          url:'{{route('area.getEditArea')}}',
          method:'POST',
          dataType:'JSON',
          data:{id:id},
          success:function(data)
          {
            if (data != false) {
              $('#editarea_model').modal('show');
              $('#edit_name').val(data.area_name);
              $('#hdcountry_id').val(data.country_id);
              $('#hdstate_id').val(data.state_id);
              $('#hdcity_id').val(data.city_id);
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
    $('#city_id-error').html('');
    $('#name-error').html('');
    $('#name').val('');

    $('#edit_name-error').html('');
    $('#edit_name').val('');
}

function deleteArea(id)
{
  if(id) {

    $.confirm({
      title : 'Warning',
      content:"Are you sure to delete this area?",
      buttons:{
        Confirm:function(){
           $.ajax({
              url:'{{ route('area.deleteArea')}}',
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