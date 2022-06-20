$(document).ready(function () {
  $('.myvideo-grid').lightGallery();

  //Active tooltip
  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  });

  //menu
  /*jQuery(function ($) {
      $('.sidebar-menu').click(function(){
          $(this).find('ul li').removeClass('active');
          $(this).addClass('active');
      });
    });*/
});



  /*$('.sidebar-menu').on('click', 'li', function() {
    $('li.active').removeClass('active');
    $(this).addClass('active');
  });*/

window.setTimeout(function() {
    $(".close-alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
  }, 3000);

jQuery(function($) {
	$.validator.addMethod("space",function(value, element) {
	      return /^[^\s]+(\s+[^\s]+)*$/.test(value);
	},"Please remove space before text and after text.");
});

jQuery(function($) {
  $.validator.addMethod("passwdspace",function(value, element) {
        return /^\S*$/.test(value);
  },"Please remove space.");
});

//Class Side "timeValidH"
jQuery(function($) {
  $.validator.addMethod("timeValidH",function(value, element) {
        if (value <1 || value >24)
        {
          return false;
        }
        return true;
  },"Invalid Time.");
});

//Class Side "timeValidM"
jQuery(function($) {
  $.validator.addMethod("timeValidM",function(value, element) {
        if (value!="" && (value <0 || value >60))
        {
          return false;
        }
        return true;
  },"Invalid Time.");
});


jQuery(function($) {
  $.validator.addMethod("schoolspace",function(value, element) {
      if (value!="")
      {
        return /^[^\s]+(\s+[^\s]+)*$/.test(value);
      }
      return true;
  },"Please remove space before text and after text.");
});

$(window).on('load', function () {
    // $('.loading').hide();
    $(".loading").fadeOut(1000);
});


//validation addMethods stat
jQuery.validator.addMethod("imageSize", function (value, element) {

      var q = element.id;

      var numFiles = $("#"+q)[0].files.length;

      var iSize = 0;

      for (var i = 0; i < numFiles; i++) {

        iSize = ($("#"+q)[0].files[0].size / 1024 / 1024); 

        if (Math.round(iSize * 100) / 100 > 2.0) {

          return false;    

        }

      }

    return true;

}, "Image size must not exceed 2 MB.");

//validation addMethods stat
jQuery.validator.addMethod("imageSize5", function (value, element) {

      var q = element.id;

      var numFiles = $("#"+q)[0].files.length;

      var iSize = 0;

      for (var i = 0; i < numFiles; i++) {

        iSize = ($("#"+q)[0].files[0].size / 1024 / 1024); 

        if (Math.round(iSize * 100) / 100 > 5.0) {

          return false;    

        }

      }

    return true;

}, "Image size must not exceed 5 MB.");


jQuery.validator.addMethod("imageSize2", function (value, element) {

      var q = element.id;

      var numFiles = $("#"+q)[0].files.length;

      var iSize = 0;

      for (var i = 0; i < numFiles; i++) {

        iSize = ($("#"+q)[0].files[0].size / 1024 / 1024); 

        if (Math.round(iSize * 100) / 100 > 2.0) {

          return false;    

        }

      }

    return true;

}, "Image size must not exceed 2 MB.");


jQuery.validator.addMethod("pdfSize10", function (value, element) {
      var q = element.id;
      var numFiles = $("#"+q)[0].files.length;
      var iSize = 0;
      for (var i = 0; i < numFiles; i++) {
        iSize = ($("#"+q)[0].files[0].size / 1024 / 1024); 
        if (Math.round(iSize * 100) / 100 > 10.0) {
          return false;
        }
      }
    return true;
}, "Pdf size must not exceed 10 MB.");

//validation addMethods stat
jQuery.validator.addMethod("videoSize20", function (value, element) {

      var q = element.id;

      var numFiles = $("#"+q)[0].files.length;

      var iSize = 0;

      for (var i = 0; i < numFiles; i++) {

        iSize = ($("#"+q)[0].files[0].size / 1024 / 1024); 

        if (Math.round(iSize * 100) / 100 > 20.0) {

          return false;    

        }

      }

    return true;

}, "Video size must not exceed 20 MB.");

jQuery.validator.addMethod("offer", function (value, element) {
      return /^[1-9][0-9]?$|^100$/.test(value);

}, "Invalid offer.");

jQuery.validator.addMethod("validname", function (value, element) {
      if(!/[^a-zA-Z0-9]/.test(value)) {
          return true;
      }
      return false;

}, "Invalid name.");

jQuery.validator.addMethod("double_validate", function (value, element) {
    /*if (value>0)
    {
      return /^[1-9][0-9]?$|^100$/.test(value);
    }
    return true;*/

    if (value>0)
    {
       var parts = value.split(".");
      if (typeof parts[1] == "string" && (parts[1].length == 0 || parts[1].length > 2))
          return false;
      var n = parseFloat(value);
      if (isNaN(n))
          return false;
      if (n < 0 || n > 100)
          return false;
      
      return true;
    }
      return false;


}, "Invalid percentage.");

jQuery.validator.addMethod("student_discount_perc_offer", function (value, element) {
      if (value!=0)
      {
        return /^[1-9][0-9]?$|^100$/.test(value);
      }
      return true;

}, "Invalid offer.");

jQuery.validator.addMethod("client_descount_offer", function (value, element) {
      if (value.length>=1)
      {
        return /^[1-9][0-9]?$|^100$/.test(value);
      }
      return true;

}, "Invalid client descount.");

jQuery.validator.addMethod("price", function (value, element) {
    if (value<1 || value>1000000 || value % 1 != 0)
    {
      return false;
    }else
    {
      return true;
    }

}, "Invalid price.");

jQuery.validator.addMethod("trial_course_fee", function (value, element) {
    if (value<0 || value>1000000 || value % 1 != 0)
    {
      return false;
    }else
    {
      return true;
    }

}, "Invalid price.");


  jQuery.validator.addMethod("greaterThanToday",function(value) {
      // console.log(value);
      var currentdate = today_date();
      if (value < currentdate) {
       return false;
      }
        return true;
  }, "Don't select less then today date.");


  function today_date() 
  {
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!

    var yyyy = today.getFullYear();
    if (dd < 10) {
      dd = '0' + dd;
    } 
    if (mm < 10) {
      mm = '0' + mm;
    } 
    var today = yyyy + '-' + mm + '-' + dd;
    return today;
  }

  jQuery.validator.addMethod("greaterThan", 
    function(value, element, params) {

        if (!/Invalid|NaN/.test(new Date(value))) {
            return new Date(value) >= new Date($(params).val());
        }

        return isNaN(value) && isNaN($(params).val()) 
            || (Number(value) >= Number($(params).val())); 
    },'Must be greater than from date.');
//validation addMethods end