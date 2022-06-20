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
                        <h3 class="text-break">{{$class->name}}</h3>
                        <p class="text-break">{{$class->address ? $class->address.",":""}} {{$class->area_name}}, {{$class->city_name}} {{$class->state_name}}, {{$class->country_name}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="registeration">
    <div class="container">
        <form action="/update_profile" id="valid_update_profile" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row justify-content-center">
                <div class="col-lg-12 col-md-112 col-sm-12">
                    <div class="reg-form-box">
                        <h4 class="text-center">Fill Up Your Details</h4>
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <input type="hidden" name="isadmin" id="isadmin" value="0">
                                    <input type="hidden" name="hdclass_id" id="hdclass_id" value="{{$class->id}}">
                                    <label>Class Name</label> <span class="req-star text-danger"> *</span>
                                    <input type="text" name="class_name" id="class_name" class="form-control" placeholder="Class Name" value="{{$class->name}}" maxlength="50">
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Class Address</label> <span class="req-star text-danger"> *</span>
                                    <textarea name="address" rows="1" id="address" class="form-control resize" maxlength="200">{{$class->address}}</textarea>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Description</label> <span class="req-star text-danger"> *</span>
                                    <textarea name="class_overview" rows="6" id="class_overview" class="form-control resize" maxlength="2000">{{$class->overview}}</textarea>
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-lg-4 col-md-12 col-sm-12">
                                <div class=" row">
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <div class="form-group">
                                            <label>Upload Class Logo</label> <span class="req-star text-danger"> *</span>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="class_logo" id="class_logo" accept="image/*" onchange="javascript:setClassFile('class_logo','cl_logo_customFile')">
                                                <label class="custom-file-label imglbl-text-break" for="cl_logocustomFile" id="cl_logo_customFile">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12">
                                        <div class="form-group">
                                            @if($class->class_logo)
                                                <img src="{{ asset('class_logo/'.$class->class_logo.'')}}" width="70" height="70">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <p class="notes">Maximum 5 MB Allowed,(640px*640px)</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>GSTIN</label> <!-- <span class="req-star text-danger"> *</span> -->
                                    <input type="text" name="gst" id="gst" class="form-control" placeholder="GSTIN" value="{{$class->gst_no}}" maxlength="15">
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <input type="hidden" name="hdarrcls" id="hdarrcls">
                                <input type="hidden" name="hdarrcls_length" id="hdarrcls_length" value="{{ $class->class_imglist ? count($class->class_imglist) : 0}}">
                                
                                <!-- <div class="col-lg-3 col-md-6 col-sm-12">
                                    <a href="javascript:addClassImage()" class="btn btn-add">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </div> -->
                                
                                <div class="form-group row">
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <label class="control-label">Upload Class Image</label><br>
                                        <!-- <div class="table-responsive"> -->
                                            <table class="table uploadtable">
                                                <tr>
                                                    <td>
                                                        <div class="custom-file">
                                                            <input class="custom-file-input class_img_input" type="file" name="classimg1" id="classimg1" accept="image/*" onchange="javascript:setFile(1)">
                                                            <label class="custom-file-label imglbl-text-break" for="customFile1" id="customFile1">Choose file</label>
                                                        </div>
                                                    </td>
                                                    <td class="action">
                                                        <a href="javascript:addClassImage()" class="btn btn-add">
                                                            <i class="fa fa-plus"></i>
                                                        </a>
                                                    </td>
                                                    
                                                </tr>
                                                <tr>
                                                    <td colspan="2" class="p-0">
                                                        <table class="table uploadtable" id="add_cl_images"></table>
                                                    </td>
                                                </tr>
                                            </table>
                                        <!-- </div> -->
                                    </div>
                                </div>

                                <?php $a=array();$b=array();$d=array();$e=array(); ?>
                                @if(!$class->class_imglist->isEmpty())
                                    <ul class="class-image-list">    
                                  @foreach($class->class_imglist as $key => $classimg)
                                  <?php 
                                    array_push($a,$classimg->id);
                                  ?>
                                    <li>
                                        <div class="imagegrid" id="imagegrid{{$classimg->id}}" style="background-image: url('{{ asset('class_images/'.$classimg->image.'')}}">
                                            <div class="img-overlay">
                                                <div class="circlebtn-upload">
                                                    <a href="#" class="circlebtn-edit mr-1">
                                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                                    </a>
                                                    <input class="up_class_img_input" type="file" name="up_classimg{{$classimg->id}}" id="up_classimg{{$classimg->id}}" onchange="javascript:updateClassImage({{$classimg->id}},{{$class->id}})">
                                                </div>
                                                <a href="javascript:removeClassImage({{$classimg->id}},1)" class="circlebtn-delete">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                  @endforeach
                                    </ul>
                                @endif
                                

                                <p class="notes">Max 10 allowed, limit of 2MB per image,(160px*150px)</p>
                            </div>
                            <div class="col-lg-5 col-md-12 col-sm-12">
                                <div class="row">
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <div class="form-group">
                                            <label>Upload Class Video</label> <span class="req-star text-danger"> *</span><br>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="class_video" id="class_video" onchange="javascript:setClassFile('class_video','cld_video_lable')">
                                                <label class="custom-file-label imglbl-text-break" for="customFile" id="cld_video_lable">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12">
                                        <div style="display:none;" id="class_video1{{$class->id}}">
                                            <video class="lg-video-object lg-html5" controls preload="none">
                                                <source src="{{asset('class_video/'.$class->class_video.'')}}" type="video/mp4">
                                                 Your browser does not support HTML5 video.
                                            </video>
                                        </div>
                                        @if($class->class_video)
                                            <div class="group-list mt-2" id="group-video">
                                                <a href="" class="group-video" data-html="#class_video1{{$class->id}}">
                                                    <img src="{{asset('edifygo_assets')}}/image/videobanner.jpg" width="92px">
                                                </a>                                        
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <p class="notes">Limit 20MB</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12">
                                    <input type="hidden" name="hdarrpdf" id="hdarrpdf">
                                    <input type="hidden" name="hdarrpdf_length" id="hdarrpdf_length" value="{{ $class->class_pdflist ? count($class->class_pdflist) : 0}}">
                                    <div class="form-group">
                                    <label class="">Upload Files</label>
                                    <!-- <div class="col-lg-3 col-md-6 col-sm-12"> -->
                                        <a href="javascript:addCoursePdf()" class="btn btn-add ml-2">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </div>

                                    <!-- </div> -->
                                    @if(!$class->class_pdflist->isEmpty())    
                                      @foreach($class->class_pdflist as $key => $pdf)
                                      <?php 
                                        array_push($d,$pdf->id);

                                      ?>

                                        <div class="form-group col-lg-12" id="coursepdfdv{{$pdf->id}}">
                                            <div class="row align-items-center">
                                                <div class="col-lg-4 bg-lights col-md-9 col-9">
                                                    <a target="_blank" href="{{asset('class_pdf/'.$pdf->pdf.'')}}">{{$pdf->title}}</a>
                                                </div>     
                                                <div class="col-lg-3 col-md-3 col-3">
                                                    <a href="javascript:removeCoursePDF({{$pdf->id}},1)" class="btn btn-remove">
                                                    <i class="fa fa-minus"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                      @endforeach
                                    @endif
                                    <div id="add_course_pdf"></div>

                                    <p class="notes">Only PDF Files, Max 5 Files ,limit of 10MB per PDF</p>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12">
                                    <input type="hidden" name="hdarrtube" id="hdarrtube">
                                    <input type="hidden" name="hdarrtube_length" id="hdarrtube_length" value="{{ $class->class_tubelist ? count($class->class_tubelist) : 0}}">
                                   
                                    <div class="form-group">
                                        <label>Upload Youtube Videos</label>
                                        <a href="javascript:addCourseTube()" class="btn btn-add ml-2">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </div>
                                   
                                    @if(!$class->class_tubelist->isEmpty())    
                                      @foreach($class->class_tubelist as $key => $tube)
                                      <?php 
                                        array_push($e,$tube->id);
                                      ?>
                                        <div class="form-group col-md-12" id="coursetubedv{{$tube->id}}">
                                            <div class="row align-items-center">
                                                <div class="col-lg-4 bg-lights col-md-9 col-9">
                                                    <a target="_blank" href="{{$tube->url}}">{{$tube->title}}</a>
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-3">
                                                    <a href="javascript:removeCourseTube({{$tube->id}},1)" class="btn btn-remove">
                                                    <i class="fa fa-minus"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                      @endforeach
                                    @endif
                                    <div id="add_course_tube"></div>
                                    <p class="notes">Max 5 URLs</p>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <input type="hidden" name="hdarrrnk" id="hdarrrnk">
                                <input type="hidden" name="hdarrrnk_length" id="hdarrrnk_length" value="{{ $class->class_rankerlist ? count($class->class_rankerlist) : 0}}">

                                <div class="form-group row">
                                    <div class="col-lg-8 col-md-12 col-sm-12">
                                        <label class="control-label">Upload Ranker Images</label><br>
                                        <table class="table uploadtable width-uptable">
                                            <tr>
                                                <td>
                                                    <div class="custom-file">
                                                        <input class="custom-file-input class_rnk_input" type="file" name="rankerimg0" id="rankerimg0" accept="image/*" onchange="javascript:setRankerFile(0)">
                                                        <label class="custom-file-label imglbl-text-break" for="customRankerFile0" id="customRankerFile0">Choose file</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <input type="text" id="rnk_title0" name="rnk_title0" class="form-control rnk_text_class" placeholder="Enter Title" maxlengt="100" value="">
                                                </td>
                                                <!-- <td>
                                                    <input type="text" class="form-control ranker_per" placeholder="Percentage" id="ranker_per0" name="ranker_per0" maxlengt="2">
                                                </td> -->
                                                <td class="add-action">
                                                    <a href="javascript:addRankerImage()" class="btn btn-add">
                                                        <i class="fa fa-plus"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="4"  class="p-0">
                                                    <table class="table uploadtable width-uptable" id="add_rnk_images"></table>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    
                                </div>
                                @if(!$class->class_rankerlist->isEmpty())
                                    <ul class="ranker-image-list">
                                  @foreach($class->class_rankerlist as $key => $rankerimg)
                                  <?php 
                                    array_push($b,$rankerimg->id);
                                  ?>

                                    <li>
                                        <div class="imagegrid" id="rankerimgdv{{$rankerimg->id}}" style="background-image: url('{{ asset('ranker_images/'.$rankerimg->image.'')}}');">
                                            <div class="img-overlay">
                                                <div class="circlebtn-upload">
                                                    <a href="#" class="circlebtn-edit mr-1">
                                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                                    </a>
                                                    <input class="up_class_rnk_input" type="file" name="up_rankerimg{{$rankerimg->id}}" id="up_rankerimg{{$rankerimg->id}}" onchange="javascript:updateRankerImage({{$rankerimg->id}},{{$class->id}})">
                                                </div>
                                                <a href="javascript:removeRankerImage({{$rankerimg->id}},1)" class="circlebtn-delete">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <input type="text" id="rnk_title{{$rankerimg->id}}" name="rnk_title{{$rankerimg->id}}" class="form-control rnk_text_class" placeholder="Enter Title" maxlengt="100" value="{{$rankerimg->title}}">
                                        <!-- <input type="text" id="ranker_per{{$rankerimg->id}}" name="ranker_per{{$rankerimg->id}}" class="form-control ranker_per" placeholder="Percentage" maxlengt="2" value="{{$rankerimg->per}}"> -->
                                    </li>
                                  @endforeach
                                    </ul>
                                @endif
                                

                                <p class="notes">Max 5 allowed, limit of 2MB per image</p>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="text-center">
                                    <button class="btn btn-save" type="submit" id="btn_update">Update</button>
                                    <!-- <button class="btn btn-submit">Make Payment</button> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

<script type="text/javascript">
var arrCls = [];
var arrRnk = [];
var arrcoursePdf = [];
var arrcourseTube = [];

 $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });


$('#valid_update_profile').on('submit', function(event) {
    //Add validation rule for dynamically generated name fields

    $('.course_pdf_input').each(function() {
        $(this).rules("add", 
        {
            required:true,
            extension: "docx|rtf|doc|pdf",
            pdfSize10:true
        });
    });
    
    $('.pdf_text_class').each(function() {
        $(this).rules("add", 
        {
            required:true,
            space:true,
            minlength:1,
            maxlength:100
        });
    });

    
    $('.tube_url_class').each(function() {
        $(this).rules("add", 
        {
            required:true,
            space:true,
            minlength:1,
            maxlength:100
        });
    });

    $('.tube_title_class').each(function() {
        $(this).rules("add", 
        {
            required:true,
            space:true,
            minlength:1,
            maxlength:100
        });
    });
    
    $('.class_img_input').each(function() {
        $(this).rules("add", 
        {
            // required:true,
            accept:"image/png,jpg,jpeg",
            imageSize2:true
        });
    });

    $('.class_rnk_input').each(function() {
        $(this).rules("add", 
        {
            // required:true,
            accept:"image/png,jpg,jpeg",
            imageSize2:true
        });
    });

    $('.rnk_text_class').each(function() {
        $(this).rules("add", 
        {
            // required:true,
            // space:true,
            minlength:1,
            maxlength:100
        });
    });
    /*$('.ranker_per').each(function() {
        $(this).rules("add", 
        {
            // required:true,
            ranker_per:true
        });
    });*/
    
});


$(document).ready(function(){
    arrCls.push(1);
    $('#hdarrcls').val(arrCls);

    arrRnk.push(0);
    $('#hdarrrnk').val(arrRnk);
    // addClassImage();


$('#valid_update_profile').validate({
        rules:
        {
            class_name:
            {
                required:true,
                // space:true,
                minlength:1,
                maxlength:50,
                /*remote:{
                   url:"{{route('cl.checkEditClassExists')}}",
                   type:"POST",
                   dataType:"json",
                   data: 
                   {
                     hdclass_id: function(){ return $("#hdclass_id").val(); },
                     class_name: function(){ return $("#class_name").val(); }
                   }
                 }*/
            },
            address:
            {
                required:true,
                // space:true,
                minlength:3,
                maxlength:200
            },
            class_overview:
            {   
                required:true,
                // space:true,
                minlength:1,
                maxlength:2000
            },
            gst:
            {
                // required:true,
                // space:true,
                minlength:15,
                maxlength:15
            },
            class_logo:
            {
                <?php if (!$class->class_logo)
                {
                    ?>required:true,<?php
                }
                ?>
                accept:"image/png,jpg,jpeg",
                imageSize5:true
            },
            class_video:
            {
                <?php if (!$class->class_video)
                {
                    ?>required:true,<?php
                }
                ?>
                accept:"video/mp4,mov",
                videoSize20:true
            }
        },
        messages:
        {
          class_name:
          {
            remote:"Class name already exists."
          }
        },
        submitHandler: function(form) {
          form.submit();
          $('#btn_update').attr('disabled', 'disabled');
        }

    });
});
//
<?php
  if (!empty($a))
  {
    foreach ($a as $value) {
      ?>
        arrCls.push('<?php echo $value; ?>');
      <?php
    }
  }
?>
$('#hdarrcls').val('<?php echo implode(",",$a); ?>');
<?php
  if (!empty($b))
  {
    foreach ($b as $value1) {
      ?>
        arrRnk.push('<?php echo $value1; ?>');
      <?php
    }
  }
?>
$('#hdarrrnk').val('<?php echo implode(",",$b); ?>');

<?php
  if (!empty($d))
  {
    foreach ($d as $value) {
      ?>
        arrcoursePdf.push('<?php echo $value; ?>');
      <?php
    }
  }
?>
$('#hdarrpdf').val('<?php echo implode(",",$d); ?>');

<?php
  if (!empty($e))
  {
    foreach ($e as $value) {
      ?>
        arrcourseTube.push('<?php echo $value; ?>');
      <?php
    }
  }
?>
$('#hdarrtube').val('<?php echo implode(",",$e); ?>');

function addClassImage()
{
    // var hdtotalclass_img = parseInt($('#hdtotalclass_img').val());
    var arrCls_len =  arrCls.length;
    var hdarrcls_length = parseInt($('#hdarrcls_length').val());
    var random = Math.floor(Math.random() * 1000000000);
    if (hdarrcls_length<9)
    {
        $('#hdarrcls_length').val(hdarrcls_length+1);
        arrCls.push(random);
        $('#hdarrcls').val(arrCls);
        var html='';
        html+='<tr id="classimgdv'+random+'">';
        html+='<td>';
        html+='<div class="custom-file">';
        html+='<input class="custom-file-input class_img_input" type="file" name="classimg'+random+'" id="classimg'+random+'" accept="image/*" onchange="javascript:setFile('+random+')">';
        html+='<label class="custom-file-label imglbl-text-break" for="customFile'+random+'" id="customFile'+random+'">Choose file</label>';
        html+='</div>';
        html+='</td>';
        html+='<td class="action">';
        html+='<a href="javascript:removeClassImage('+random+',0)" class="btn btn-remove">';
        html+='<i class="fa fa-minus"></i>';
        html+='</a>';
        html+='</td>';
        html+='</tr>';
        $('#add_cl_images').append(html);
    }else
    {
        $.confirm({
            title: 'Warning',
            content: 'You can add only 10 images.',
            buttons: {
                ok: function () {               
                }
            }
        });
    }
}

function removeClassImage(random,type)
{
    /*{type:1='live tbl value'}
    {type:0='dummy value'}*/
    if (type==1)
    {
      $.confirm({
            title: 'Warning',
            content: 'Are you sure you want to delete this class image.',
            buttons: {
                Yes: function () {               
                  $.ajax({
                    url:'{{route('profile.delete_class_image')}}',
                    method:'POST',
                    dataType:'JSON',
                    data:{id:random},
                    success:function(data)
                    {
                      if (data==true)
                      {
                        finalremoveClassImage(random,1);
                      }
                    }
                  });
                },
                No: function () {               
                }
            }
        });
    }else
    {
        finalremoveClassImage(random,0);
    }
}

function finalremoveClassImage(random,status)
{
    var hdarrcls_length = parseInt($('#hdarrcls_length').val());
    $('#hdarrcls_length').val(hdarrcls_length-1);
    $('#classimgdv'+random).remove();
    var index = arrCls.indexOf(random);
    if (index > -1) {
       arrCls.splice(index, 1);
    }
    $('#hdarrcls').val(arrCls);
    if (status==1)
    {
        location.reload();
    }
}

function updateClassImage(id,class_id)
{
    if (id !== "" && class_id!="") {
    if ($('#up_classimg'+id).val()!=="") {

      var validImage = $('#up_classimg'+id)[0].files[0];
      //get file extension
      var extention = validImage.type.split('/').pop().toLowerCase();
      //console.log("extention "+extention);
      if (extention == "jpg" || extention == "png" || extention == "jpeg") {
        if (validImage.size <= 1024000 * 2) {
            var new_image = $('#up_classimg'+id)[0].files[0].name;

            var imageInput=$('#up_classimg'+id)[0];
            var formdata = new FormData();

              $.each(imageInput.files,function(k,file){
                formdata.append('up_classimg',file);
                formdata.append('id',id);
                formdata.append('class_id',class_id);
              });

              $.ajax({
                  url:'{{route('profile.updateclassImage')}}',
                  dataType:'JSON',
                  method:'post',
                  data:formdata,
                  contentType:false,
                  cache:false,
                  processData:false,
                  // async:false,
                  beforeSend:function()
                  {
                    $('#dataloading').removeClass('hidden');
                  },
                  success:function(image_name) 
                  {
                    var url = '{{ url('class_images')}}/';
                    $('#dataloading').addClass('hidden');
                    if (image_name !== false) {
                      $('#imagegrid'+id).attr('style','background-image: url('+url+image_name+')');
                      $.confirm({
                        title: 'Success!',
                        content: 'Image updated successfully.',
                        buttons: {
                            ok: function () {
                              $('#up_classimg'+id).val('');
                            }
                        }
                    });
                    }
                    else 
                    {
                      $.confirm({
                          title: 'Warning!',
                          content: 'Image not updated.',
                          buttons: {
                              ok: function () {
                                $('#up_classimg'+id).val('');
                              }
                          }
                      });
                    }
                  }
              });
        }
        else
        {
          $.confirm({
              title: 'Warning!',
              content: 'Image size must not exceed 2 MB.',
              buttons: {
                  ok: function () {
                    $('#up_classimg'+id).val('');
                  }
              }
          });
        }
      }
      else
      {
        $.confirm({
            title: 'Warning!',
            content: 'Please enter a value with a valid mimetype.',
            buttons: {
                ok: function () {
                  $('#up_classimg'+id).val('');
                }
            }
        });
      }
    }
    else
    {
      $.confirm({
        title: 'Warning!',
        content: 'Please Select Image.',
        buttons: {
            ok: function () {
              $('#up_classimg'+id).val('');
            }
        }
    });
    }
  }
}

function setFile(random) 
{
  if($('#classimg'+random).val()!=="")
  {
    var file = $('#classimg'+random)[0].files[0].name;
    $('#customFile'+random).text(file);
  }else
  {
    $('#customFile'+random).text('Choose file');
  }
}

function setClassFile(file_name,span_name) 
{
  if($('#'+file_name).val()!=="")
  {
    var file = $('#'+file_name)[0].files[0].name;
    $('#'+span_name).text(file);
  }else
  {
    $('#'+span_name).text('Choose file');
  }
}

function addCourseTube()
{
    // var hdtotalclass_img = parseInt($('#hdtotalclass_img').val());
    var arrcourseTube_len =  arrcourseTube.length;
    var hdarrtube_length = parseInt($('#hdarrtube_length').val());
    var random = Math.floor(Math.random() * 1000000000);
    if (hdarrtube_length<5)
    {
        $('#hdarrtube_length').val(hdarrtube_length+1);
        arrcourseTube.push(random);
        $('#hdarrtube').val(arrcourseTube);
        var html='';
        html+='<div class="form-group" id="coursetubedv'+random+'">';
        html+='<div class="row">';
        html+='<div class="col-lg-5 col-md-6 col-sm-12">';
        html+='<input type="text" class="form-control tube_url_class" placeholder="Enter URL" name="tube_url'+random+'" id="tube_url'+random+'" maxlength="100">';
        html+='</div>';
        html+='<div class="col-lg-3 col-md-6 col-sm-12">';
        html+='<input type="text" class="form-control tube_title_class" placeholder="Enter Title" name="tube_title'+random+'" id="tube_title'+random+'" maxlength="100">';
        html+='</div>';
        html+='<div class="col-lg-3 col-md-6 col-sm-12">';
        html+='<a href="javascript:removeCourseTube('+random+',0)" class="btn btn-remove">';
        html+='<i class="fa fa-minus"></i>';
        html+='</a>';
        html+='</div>';
        html+='</div>';
        html+='</div>';
        $('#add_course_tube').append(html);
    }else
    {
        $.confirm({
            title: 'Warning',
            content: 'You can add only 5 you tube link.',
            buttons: {
                ok: function () {               
                }
            }
        });
    }
}

function removeCourseTube(random,type)
{
    /*{type:1='live tbl value'}
    {type:0='dummy value'}*/
    if (type==1)
    {
      $.confirm({
            title: 'Warning',
            content: 'Are you sure you want to delete this you tube link.',
            buttons: {
                Yes: function () {               
                  $.ajax({
                    url:'{{route('class.deleteTube')}}',
                    method:'POST',
                    dataType:'JSON',
                    data:{id:random},
                    success:function(data)
                    {
                      if (data==true)
                      {
                        finalremoveCourseTube(random,1);
                      }
                    }
                  });
                },
                No: function () {               
                }
            }
        });
    }else
    {
        finalremoveCourseTube(random,0);
    }
}

function finalremoveCourseTube(random,status)
{
        console.log(arrcourseTube);
    var hdarrtube_length = parseInt($('#hdarrtube_length').val());
    $('#hdarrtube_length').val(hdarrtube_length-1);
    $('#coursetubedv'+random).remove();
    var index = arrcourseTube.indexOf(random);
        console.log("index="+index);
    if (index > -1) {
       arrcourseTube.splice(index, 1);
    }
    $('#hdarrtube').val(arrcourseTube);
    if(status == 1) {
        location.reload();
    }
}

function addRankerImage()
{
    // var hdtotalclass_img = parseInt($('#hdtotalclass_img').val());
    var arrRnk_len =  arrRnk.length;
    var hdarrrnk_length = parseInt($('#hdarrrnk_length').val());
    var random = Math.floor(Math.random() * 1000000000);
    if (hdarrrnk_length<=3)
    {
        $('#hdarrrnk_length').val(hdarrrnk_length+1);
        arrRnk.push(random);
        $('#hdarrrnk').val(arrRnk);
        var html='';
        html+='<tr id="rankerimgdv'+random+'">';
        html+='<td>';
        html+='<div class="custom-file">';
        html+='<input class="custom-file-input class_rnk_input" type="file" name="rankerimg'+random+'" id="rankerimg'+random+'" accept="image/*" onchange="javascript:setRankerFile('+random+')">';
        html+='<label class="custom-file-label imglbl-text-break" for="customRankerFile'+random+'" id="customRankerFile'+random+'">Choose file</label>';
        html+='</div>';
        html+='</td>';
        html+='<td>';
        html+='<input type="text" id="rnk_title'+random+'" name="rnk_title'+random+'" class="form-control rnk_text_class" placeholder="Enter Title" maxlengt="100">';
        html+='</td>';
        /*html+='<td>';
        html+='<input type="text" class="form-control ranker_per" placeholder="Percentage" id="ranker_per'+random+'" name="ranker_per'+random+'" maxlengt="2">';
        html+='</td>';*/
        html+='<td class="add-action">';
        html+='<a href="javascript:removeRankerImage('+random+',0)" class="btn btn-remove">';
        html+='<i class="fa fa-minus"></i>';
        html+='</a>';
        html+='</td>';
        html+='</tr>';

        $('#add_rnk_images').append(html);
    }else
    {
        $.confirm({
            title: 'Warning',
            content: 'You can add only 5 images.',
            buttons: {
                ok: function () {               
                }
            }
        });
    }
}

function removeRankerImage(random,type)
{
    /*{type:1='live tbl value'}
    {type:0='dummy value'}*/
    if (type==1)
    {
      $.confirm({
            title: 'Warning',
            content: 'Are you sure you want to delete this ranker image.',
            buttons: {
                Yes: function () {               
                  $.ajax({
                    url:'{{route('profile.delete_ranker_image')}}',
                    method:'POST',
                    dataType:'JSON',
                    data:{id:random},
                    success:function(data)
                    {
                      if (data==true)
                      {
                        finalremoveRankerImage(random,1);
                      }
                    }
                  });
                },
                No: function () {               
                }
            }
        });
    }else
    {
        finalremoveRankerImage(random,0);
    }
}

function finalremoveRankerImage(random,status)
{
    var hdarrrnk_length = parseInt($('#hdarrrnk_length').val());
    $('#hdarrrnk_length').val(hdarrrnk_length-1);
    $('#rankerimgdv'+random).remove();
    var index = arrRnk.indexOf(random);
    if (index > -1) {
       arrRnk.splice(index, 1);
    }
    $('#hdarrrnk').val(arrRnk);
    if (status==1)
    {
        location.reload();
    }
}

function updateRankerImage(id,class_id)
{
    if (id !== "" && class_id!="") {
    if ($('#up_rankerimg'+id).val()!=="") {

      var validImage = $('#up_rankerimg'+id)[0].files[0];
      //get file extension
      var extention = validImage.type.split('/').pop().toLowerCase();
      //console.log("extention "+extention);
      if (extention == "jpg" || extention == "png" || extention == "jpeg") {
        if (validImage.size <= 1024000 * 2) {
            var new_image = $('#up_rankerimg'+id)[0].files[0].name;

            var imageInput=$('#up_rankerimg'+id)[0];
            var formdata = new FormData();

              $.each(imageInput.files,function(k,file){
                formdata.append('up_rankerimg',file);
                formdata.append('id',id);
                formdata.append('class_id',class_id);
              });

              $.ajax({
                  url:'{{route('profile.updaterankerImage')}}',
                  dataType:'JSON',
                  method:'post',
                  data:formdata,
                  contentType:false,
                  cache:false,
                  processData:false,
                  // async:false,
                  beforeSend:function()
                  {
                    $('#dataloading').removeClass('hidden');
                  },
                  success:function(image_name) 
                  {
                    var url = '{{ url('ranker_images')}}/';
                    $('#dataloading').addClass('hidden');
                    if (image_name !== false) {
                      // $('#rnk_pre'+id).attr('src',url+image_name);
                      $('#rankerimgdv'+id).attr('style','background-image: url('+url+image_name+')');
                      $.confirm({
                        title: 'Success!',
                        content: 'Image updated successfully.',
                        buttons: {
                            ok: function () {
                              $('#up_rankerimg'+id).val('');
                            }
                        }
                    });
                    }
                    else 
                    {
                      $.confirm({
                          title: 'Warning!',
                          content: 'Image not updated.',
                          buttons: {
                              ok: function () {
                                $('#up_rankerimg'+id).val('');
                              }
                          }
                      });
                    }
                  }
              });
        }
        else
        {
          $.confirm({
              title: 'Warning!',
              content: 'Image size must not exceed 2 MB.',
              buttons: {
                  ok: function () {
                    $('#up_rankerimg'+id).val('');
                  }
              }
          });
        }
      }
      else
      {
        $.confirm({
            title: 'Warning!',
            content: 'Please enter a value with a valid mimetype.',
            buttons: {
                ok: function () {
                  $('#up_rankerimg'+id).val('');
                }
            }
        });
      }
    }
    else
    {
      $.confirm({
        title: 'Warning!',
        content: 'Please Select Image.',
        buttons: {
            ok: function () {
              $('#up_rankerimg'+id).val('');
            }
        }
    });
    }
  }
}

function setRankerFile(random) 
{
  if($('#rankerimg'+random).val()!=="")
  {
    var file = $('#rankerimg'+random)[0].files[0].name;
    $('#customRankerFile'+random).text(file);
  }else
  {
    $('#customRankerFile'+random).text('Choose file');
  }
}

function addCoursePdf()
{
    // var hdtotalclass_img = parseInt($('#hdtotalclass_img').val());
    var arrcoursePdf_len =  arrcoursePdf.length;
    var hdarrpdf_length = parseInt($('#hdarrpdf_length').val());
    var random = Math.floor(Math.random() * 1000000000);
    if (hdarrpdf_length<5)
    {
        $('#hdarrpdf_length').val(hdarrpdf_length+1);
        arrcoursePdf.push(random);
        $('#hdarrpdf').val(arrcoursePdf);
        var html='';
        html+='<div class="form-group" id="coursepdfdv'+random+'">';
        html+='<div class="row">';
        html+='<div class="col-lg-4 col-md-4 col-sm-12">';
        html+='<div class="custom-file">';
        html+='<input class="custom-file-input course_pdf_input" type="file" name="coursepdf'+random+'" id="coursepdf'+random+'" onchange="javascript:setPdfFile('+random+')">';
        html+='<label class="custom-file-label" for="customPdfFile'+random+'" id="customPdfFile'+random+'">Choose file</label>';
        html+='</div>';
        html+='</div>';
        html+='<div class="col-lg-3 col-md-6 col-sm-12">';
        html+='<input type="text" id="pdf_title'+random+'" name="pdf_title'+random+'" class="form-control pdf_text_class" placeholder="Enter Title" maxlength="100">';
        html+='</div>';        
        html+='<div class="col-lg-3 col-md-6 col-sm-12">';
        html+='<a href="javascript:removeCoursePDF('+random+',0)" class="btn btn-remove">';
        html+='<i class="fa fa-minus"></i>';
        html+='</a>';
        html+='</div>';
        html+='</div>';
        html+='</div>';
        $('#add_course_pdf').append(html);
    }else
    {
        $.confirm({
            title: 'Warning',
            content: 'You can add only 5 pdf.',
            buttons: {
                ok: function () {               
                }
            }
        });
    }
}

function removeCoursePDF(random,type)
{
    /*{type:1='live tbl value'}
    {type:0='dummy value'}*/
    if (type==1)
    {
        // alert(random);
      $.confirm({
            title: 'Warning',
            content: 'Are you sure to delete this pdf ?',
            buttons: {
                Yes: function () {               
                  $.ajax({
                    url:'{{route('class.deletePdf')}}',
                    method:'POST',
                    dataType:'JSON',
                    data:{id:random},
                    success:function(data)
                    {
                      if (data==true)
                      {
                        finalremoveCoursePDF(random,1);
                      }
                    }
                  });
                },
                No: function () {               
                }
            }
        });
    }else
    {
        finalremoveCoursePDF(random,0);
    }
}

function finalremoveCoursePDF(random,status)
{
    var hdarrpdf_length = parseInt($('#hdarrpdf_length').val());
    $('#hdarrpdf_length').val(hdarrpdf_length-1);
    $('#coursepdfdv'+random).remove();
    var index = arrcoursePdf.indexOf(random);
    if (index > -1) {
       arrcoursePdf.splice(index, 1);
    }
    $('#hdarrpdf').val(arrcoursePdf);
    if(status == 1) {
        location.reload();
    }
}

function setPdfFile(random) 
{
  if($('#coursepdf'+random).val()!=="")
  {
    var file = $('#coursepdf'+random)[0].files[0].name;
    $('#customPdfFile'+random).text(file);
  }else
  {
    $('#customPdfFile'+random).text('Choose file');
  }
}
</script>
@endsection