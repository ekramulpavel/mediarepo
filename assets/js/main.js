/*
* jQuery File Upload Plugin JS Example
* https://github.com/blueimp/jQuery-File-Upload
*
* Copyright 2010, Sebastian Tschan
* https://blueimp.net
*
* Licensed under the MIT license:
* https://opensource.org/licenses/MIT
*/

/* global $, window */


$(function () {
  'use strict';

  // Initialize the jQuery File Upload widget:
  $('#fileupload').fileupload({
    // Uncomment the following to send cross-domain cookies:
    //xhrFields: {withCredentials: true},
    url: '#'
  });

  // Enable iframe cross-domain access via redirect option:
  $('#fileupload').fileupload(
    'option',
    'redirect',
    window.location.href.replace(
      /\/[^\/]*$/,
      '/cors/result.html?%s'
    )
  );

  if (window.location.hostname === 'blueimp.github.io') {
    // Demo settings:
    $('#fileupload').fileupload('option', {
      url: '//jquery-file-upload.appspot.com/',
      // Enable image resizing, except for Android and Opera,
      // which actually support image resizing, but fail to
      // send Blob objects via XHR requests:
      disableImageResize: /Android(?!.*Chrome)|Opera/
      .test(window.navigator.userAgent),
      maxFileSize: 999000,
      acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i
    });
    // Upload server status check for browsers with CORS support:
    if ($.support.cors) {
      $.ajax({
        url: '//jquery-file-upload.appspot.com/',
        type: 'HEAD'
      }).fail(function () {
        $('<div class="alert alert-danger"/>')
        .text('Upload server currently unavailable - ' +
        new Date())
        .appendTo('#fileupload');
      });
    }
  } else {
    // Load existing files:
    // $('#fileupload').addClass('fileupload-processing');
    // $.ajax({
    //     // Uncomment the following to send cross-domain cookies:
    //     //xhrFields: {withCredentials: true},
    //     url: $('#fileupload').fileupload('option', 'url'),
    //     dataType: 'json',
    //     context: $('#fileupload')[0]
    // }).always(function () {
    //     $(this).removeClass('fileupload-processing');
    // }).done(function (result) {
    //     $(this).fileupload('option', 'done')
    //         .call(this, $.Event('done'), {result: result});
    // });
  }

});


$(function(){

  /***********************************************************
  *  data-tables config
  ***********************************************************/

  $('body').on('click','.delete', function(e){
    var base_url = $(this).data("value");
    var del = confirm('Are you sure you want to delete this entry!!');
    if (del == true) {
      window.location.href = base_url;
    }

  });
  $('body').on('click','.editmodal', function(e){
    // event.preventDefault();
    var email = $(this).data("email");
    var id = $(this).data("id");
    var name=$(this).data("name");

    $('#user_id').val(id);
    $('#edit_txt_email').val(email);
    $('#edit_txt_name').val(name);

  });

  // $('#new-user-form').bootstrapValidator({
  //       feedbackIcons: {
  //           valid: 'glyphicon glyphicon-ok',
  //           invalid: 'glyphicon glyphicon-remove',
  //           validating: 'glyphicon glyphicon-refresh'
  //       },
  //       fields: {
  //           txt_password: {
  //               validators: {
  //                   identical: {
  //                       field: 'txt_confirm_password',
  //                       message: 'The password and its confirm are not the same'
  //                   }
  //               }
  //           },
  //           txt_confirm_password: {
  //               validators: {
  //                   identical: {
  //                       field: 'txt_password',
  //                       message: 'The password and its confirm are not the same'
  //                   }
  //               }
  //           }
  //       }
  //   });

  var my_fileurl=site_url+"files/displayMyFile";
  var tablemyfiles = $('#my-files').DataTable({
    listView: {
      checkbox: false,
      columnFilters: false,
    },
    ajax: my_fileurl,
    columns: [
      { "data": null },
      { "data": null },
      { "data": "Date" },
      { "data": null }
    ],
    "columnDefs": [
      {
        "targets": 0,
        "bSortable" : false,
        "render": function (data, type, full, meta) {
          var file = data.File_Name.toLowerCase().split('.');
// console.log(file);
          if(file.length>0){
            var icon = file[file.length - 1];
          }else{
            var icon ='dir';
          }
// console.log(icon);
          return '<div class="thumbnail icon">'+
          '<div class="folder_container" data-id="'+data.ID+'"><img src="'+site_url+'assets/icon/svg/'+icon+'.svg"/></div>'+
          '</div>'+
          '<div class="dropdown action_btns">'+
          '<a class="btn btn-sm text-dark" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'+
          '<i class="fas fa-ellipsis-v"></i>'+
          '</a>'+
          '<div class="dropdown-menu">'+
          '<a class="dropdown-item" href="#"><i class="fas fa-pencil-alt text-info"></i> Edit</a>'+
          '<a class="dropdown-item" href="#"><i class="fas fa-times text-danger"></i> Delete</a>'+
          ' </div>'+
          '</div>';
        }
      },
      {
        "targets": 1,
        "render": function (data, type, full, meta) {
          return '<h4  title="'+data.File_Name+'"  data-toggle="tooltip" data-placement="bottom" alt="'+data.File_Name+'">'+data.File_Name+'</h4>';
        }
      },
      {
        "targets": 3,
        "bSortable" : false,
        "render": function (data, type, full, meta) {
          return '<div class="dropdown">'+
          '<a class="btn btn-sm text-dark" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'+
          '<i class="fas fa-ellipsis-v"></i>'+
          '</a>'+
          '<div class="dropdown-menu">'+
          '<a class="dropdown-item" href="#"><i class="fas fa-pencil-alt text-info"></i> Edit</a>'+
          '<a class="dropdown-item" href="#"><i class="fas fa-times text-danger"></i> Delete</a>'+
          ' </div></div>';
        }
      }
    ],
    "fnCreatedRow": function(nRow, aData, iDataIndex) {
      $('td:eq(0)', nRow)
      .attr('data-search', aData.User_Name)
      .attr('data-display', aData.User_Name)
      .addClass('remove-padding icon-only content-fill');

      $('td:eq(1)', nRow)
      .attr('data-search', aData.File_Name)
      .attr('data-display', aData.File_Name)
      .addClass('fade-edge');

      var columns = [
        null,
        null,
        aData.Date,
        null
      ];
      for (i = 2; i < 3; i++) {
        $('td:eq('+i+')', nRow)
        .attr('data-search', columns[i])
        .attr('data-display', columns[i])
        .attr('title', columns[i])
        .attr('title', 'tooltip')
        .attr('data-placement', 'bottom')
        .addClass('fade-edge remove-padding-top');
      }

      $('td:eq(3)', nRow).addClass('text-center content-fill text-left-on-grid-view no-wrap');
    },
    initComplete: function (){

    }
  });



  var all_fileurl=site_url+"files/displayallfile";
  var tableallfiles = $('#all-files').DataTable({
    listView: {
      checkbox: false,
      columnFilters: false,
    },
    ajax: all_fileurl,

    columns: [
      { "data": null },
      { "data": null },
      { "data": 'User_Name' },
      { "data": "Date" },
      { "data": null }
    ],
    "columnDefs": [
      {
        // '+icon[1]+'
        "targets": 0,
        "bSortable" : false,
        "render": function (data, type, full, meta) {
          var file = data.File_Name.toLowerCase().split('.');
// console.log(file);
          if(file.length>1){
            var icon = file[file.length - 1];
          }else{
            var icon ='dir';
          }
// console.log(icon);
          return '<div class="thumbnail icon">'+
          '<div class="folder_container" data-func="push" data-func="push" data-name="'+data.File_Name+'" data-id="'+data.ID+'"><img src="'+site_url+'assets/icon/svg/'+icon+'.svg"/></div>'+
          '</div>'+
          '<div class="dropdown action_btns">'+
          '<a class="btn btn-sm text-dark" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'+
          '<i class="fas fa-ellipsis-v"></i>'+
          '</a>'+
          '<div class="dropdown-menu">'+
          '<a class="dropdown-item" href="#"><i class="fas fa-pencil-alt text-info"></i> Edit</a>'+
          '<a class="dropdown-item" href="#"><i class="fas fa-times text-danger"></i> Delete</a>'+
          ' </div>'+
          '</div>';
        }
      },
      {
        "targets": 1,
        "render": function (data, type, full, meta) {
          return '<h4  class="folder_container" data-func="push" data-func="push" data-name="'+data.File_Name+'" data-id="'+data.ID+'" title="'+data.File_Name+'" data-toggle="tooltip" data-placement="bottom" alt="'+data.File_Name+'">'+data.File_Name+'</h4>';
        }
      },
      {
        "targets": 4,
        "bSortable" : false,
        "render": function (data, type, full, meta) {
          return '<div class="dropdown">'+
          '<a class="btn btn-sm text-dark" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'+
          '<i class="fas fa-ellipsis-v"></i>'+
          '</a>'+
          '<div class="dropdown-menu">'+
          '<a class="dropdown-item" href="#"><i class="fas fa-pencil-alt text-info"></i> Edit</a>'+
          '<a class="dropdown-item" href="#"><i class="fas fa-times text-danger"></i> Delete</a>'+
          ' </div></div>';
        }
      }
    ],
    "fnCreatedRow": function(nRow, aData, iDataIndex) {
      $('td:eq(0)', nRow)
      .attr('data-search', aData.File_Name)
      .attr('data-display', aData.File_Name)
      .addClass('remove-padding icon-only content-fill');

      $('td:eq(1)', nRow)
      .attr('data-search', aData.File_Name)
      .attr('data-display', aData.File_Name)
      .addClass('fade-edge');

      var columns = [
        null,
        null,
        aData.User_Name,
        aData.Date,
        null
      ];
      for (i = 2; i < 4; i++) {
        $('td:eq('+i+')', nRow)
        .attr('data-search', columns[i])
        .attr('data-display', columns[i])
        .attr('title', columns[i])
        .attr('title', 'tooltip')
        .attr('data-placement', 'bottom')
        .addClass('fade-edge remove-padding-top');
      }

      $('td:eq(4)', nRow).addClass('text-center content-fill text-left-on-grid-view no-wrap');
    },
    initComplete: function (){

    }
  });

  $('body').on('click','.folder_container',function(){
    var id= $(this).data('id');
    var func= $(this).data('func');
    var name= $(this).data('name');
    my_fileurl=site_url+'files/displaymyfile/'+ func+'/'+id;
    all_fileurl=site_url+'files/displayallfile/'+ func+'/'+id;
    if(func == 'pop'){
      for (var i=0; i<session_data.length;i++){
        if(session_data[i]['id']==id){
          session_data=session_data.slice(0,i+1);
        }
      }
      update_breadcrumb(session_data);

    }
    else if(func == 'push'){
      var end=session_data.length;
      var temp =   {"id":id,"name":name} ;
      session_data.push(temp);
      update_breadcrumb(session_data);

    }
    tablemyfiles.ajax.url(my_fileurl).load();
    tableallfiles.ajax.url(all_fileurl).load();

  });
  update_breadcrumb(session_data);
  function update_breadcrumb(session){
    var home='<i class="fas fa-home"></i>';
    var str='';
    for(var i =0;i<session.length;i++){
      if(session[i]['name']=='uploads'){
        str += '<li class="breadcrumb-item folder_container" data-func="pop" data-id="'+session[i]['id']+'" ><i class="fas fa-home"></i></li>'
      }else{
        str += '<li class="breadcrumb-item folder_container" data-func="pop" data-id="'+session[i]['id']+'"><a href="#">'+ session[i]['name']+'</a></li>';
      }


    }
    $('.breadcrumb').html(str);
    console.log(session);
  }

});


(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();


$(document).ready(function() {

  $(".file-upload").on('change', function(){
    readURL(this);
  });

  $(".upload-button").on('click', function() {
    $(".file-upload").click();
  });
});
