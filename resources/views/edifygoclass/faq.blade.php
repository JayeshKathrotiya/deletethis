@extends('edifygoclass.layout')
@section('contents')

    <section class="breadcrumb-banner overlay" style="background-image: url('{{asset('edifygo_assets')}}/image/breadcrumb-banner.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- <h2 class="breadcrumb-title">Course Class</h2> -->
                    <div class="banner-inner">
                        <div class="cls-image">
                            @if($class->class_logo)
                                <img src="{{ asset('class_logo/'.$class->class_logo.'')}}" alt="Image not available">
                            @else
                                <img src="{{ asset('edifygo_assets')}}/image/classes-logo.png" alt="Image not available">
                            @endif
                        </div>
                        <div class="cls-details">
                            <h3>{{$class->name}}</h3>
                            <p>{{$class->address}} {{$class->area_name}} {{$class->city_name}} {{$class->state_name}} {{$class->country_name}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="registeration">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 col-md-112 col-sm-12">
                    <div class="reg-form-box">
                        <button type="button" class="btn btn-primary float-right" id="btn_addcat" name="btn_addcat" value="Add FAQ" data-toggle="modal" data-target="#myModal" onclick="setnull()"><i class="fa fa-plus mr-2"> </i> Add FAQ</button>
                        <h4 class="text-center">FAQ List</h4>
                        <div class="card-body p-0">
                          <div class="table-responsive">
                            <table id="tbl_mcat" class="table table-striped table-bordered sorting-data">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Question</th>
                                        <th>Answer</th>
                                        <th class="action-group no-sort" width="67px">Action</th>
                                    </tr>
                                    </thead>
                                  <tbody>
                                    @if(!empty($faq)) 
                                      @foreach ($faq as $key => $value)
                                    <tr>
                                      <td>{{++$key}}</td>
                                      <td class="text-break">{{$value->question}}</td>
                                      <td class="text-break">{{$value->answer}}</td>
                                      <td>
                                        <a href="javascript:editfaq({{$value->id}})" title="Edit" class="circlebtn-edit"><i class="fa fa-edit"></i></a>

                                        <a href="javascript:deletefaq({{$value->id}})" title="Delete" class="circlebtn-delete"><i class="fa fa-trash"></i></a>
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
    </section>

    <!-- model -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="cat_countryel">Add FAQ</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
          </div>
          <form action="/faq/addfaq" method="POST" id="faq_add" name="faq_add">
             @csrf
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <input type="hidden" name="class_id" id="class_id" value="{{$class->id}}">
                      <label>Question</label> <span class="req-star text-danger"> *</span>
                      <textarea class="form-control resize" name="qus" id="qus" minlength="3" maxlength="200"></textarea>
                    </div>
                  </div>   
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Answer</label> <span class="req-star text-danger"> *</span>
                      <textarea class="form-control resize" name="ans" id="ans" minlength="3" maxlength="200"></textarea>
                    </div>
                  </div>   
                </div>
            </div>
            <div class="modal-footer">
            <button type="submit" id="btn_submit" class="btn btn-submit">Submit</button>
            <button type="button" class="btn btn-save" data-dismiss="modal">Close</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="modal fade" id="editfaq_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="cat_countryel">Edit FAQ</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
          </div>
          <form action="/faq/editfaq" method="POST" id="faq_edit" name="faq_edit">
             @csrf
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <input type="hidden" name="faq_id" id="faq_id">
                      <label>Question</label> <span class="req-star text-danger"> *</span>
                      <textarea class="form-control resize" name="edit_qus" id="edit_qus" minlength="3" maxlength="200"></textarea>
                    </div>
                  </div>   
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Answer</label> <span class="req-star text-danger"> *</span>
                      <textarea class="form-control resize" name="edit_ans" id="edit_ans" minlength="3" maxlength="200"></textarea>
                    </div>
                  </div>   
                </div>
            </div>
            <div class="modal-footer">
            <button type="submit" id="btn_update" class="btn btn-submit">Update</button>
            <button type="button" class="btn btn-save" data-dismiss="modal">Close</button>
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

  function  setnull()
  {
    $('#qus').val('');
    $('#qus-error').text('');
    $('#ans').val('');
    $('#ans-error').text('');
    $('#edit_ans-error').text('');
    $('#edit_qus-error').text('');
  }

  $(document).ready(function(){
    $('#faq_add').validate({
      rules:
      {
        qus:
        {
          required:true,
          space:true,
          minlength:3,
          maxlength:200
        },
        ans:
        {
          required:true,
          space:true,
          minlength:3,
          maxlength:200
        }
      },
      messages:
      {

      },
      submitHandler:function(form)
      {
        $('#btn_submit').attr('disabled',true);
        form.submit();
      }
    });

    $('#faq_edit').validate({
      rules:
      {
        edit_qus:
        {
          required:true,
          space:true,
          minlength:3,
          maxlength:200
        },
        edit_ans:
        {
          required:true,
          space:true,
          minlength:3,
          maxlength:200
        }
      },
      messages:
      {

      },
      submitHandler:function(form)
      {
        $('#btn_update').attr('disabled',true);
        form.submit();
      }
    });
  });

function deletefaq(id)
{
    $.confirm({
      title : 'Warning',
      content:"Are you sure to delete this faq?",
      buttons:{
        Confirm:function(){
           $.ajax({
              url:'{{ route('faq.deletefaq')}}',
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

function editfaq(id) 
{
  if(id != "") {
    setnull();
    $('#faq_id').val(id);
    $.ajax({
      url:'{{ route('faq.fetch_faq_data')}}',
      method:'POST',
      dataType:'JSON',
      data:{id:id},
      success:function(data)
      {
        if (data != false) {
          $('#edit_qus').val(data.question);
          $('#edit_ans').val(data.answer);
          $('#editfaq_model').modal('show');
        }
      }
    });
  } 
}
</script>
@endsection