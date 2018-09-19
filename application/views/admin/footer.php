<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar bg-light border-left logs" style="top: 57px;">
  <!-- Control sidebar content goes here -->
  <div class="container-fluid">
    <div class="row">
      <div class="col-12 pl-2 mt-2">

        <ul class="list-group list-group-flush w-100">
          <li class="list-group-item bg-light pl-0 pr-0">
            <a href="#" class="d-flex justify-content-between align-content-center">
              <span class="text-span"><i class="far fa-file-word mr-2"></i> 4 new document</span>
              <span class="float-right text-muted text-sm">1:30 AM</span>
            </a>
          </li>
          <li class="list-group-item bg-light pl-0 pr-0">
            <a href="#" class="d-flex justify-content-between align-content-center">
              <span class="text-span"><i class="far fa-file-audio mr-2"></i> 8 new meeting recordings</span>
              <span class="float-right text-muted text-sm">3:55 PM</span>
            </a>
          </li>
          <li class="list-group-item bg-light pl-0 pr-0">
            <a href="#" class="d-flex justify-content-between align-content-center">
              <span class="text-spant"><i class="far fa-file-image mr-2"></i> 3 new images</span>
              <span class="float-right text-muted text-sm">JUL 19</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</aside>
<!-- /.control-sidebar -->

<?php if($this->router->fetch_method()!='user_list'){ ?>

</body>


</div>
<!-- The blueimp Gallery widget -->
<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls" data-filter=":even">
  <div class="slides"></div>
  <h3 class="title"></h3>
  <a class="prev">‹</a>
  <a class="next">›</a>
  <a class="close">×</a>
  <a class="play-pause"></a>
  <ol class="indicator"></ol>
</div>
<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
<tr class="template-upload fade">
<td>
<span class="preview"></span>
</td>
<td>
<p class="name">{%=file.name%}</p>
<strong class="error text-danger"></strong>
</td>
<td>
<p class="size">Processing...</p>
<div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
</td>
<td>
{% if (!i && !o.options.autoUpload) { %}
/<button class="btn btn-primary start" >
<i class="glyphicon glyphicon-upload"></i>
<span>Start</span>
</button>
{% } %}
{% if (!i) { %}
<button class="btn btn-warning cancel">
<i class="glyphicon glyphicon-ban-circle"></i>
<span>Cancel</span>
</button>
{% } %}
</td>
</tr>
{% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
<tr class="template-download fade">
<td>
<span class="preview">
{% if (file.thumbnailUrl) { %}
<a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
{% } %}
</span>
</td>
<td>
<p class="name">
{% if (file.url) { %}
<a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
{% } else { %}
<span>{%=file.name%}</span>
{% } %}
</p>
{% if (file.error) { %}
<div><span class="label label-danger">Error</span> {%=file.error%}</div>
{% } %}
</td>
<td>
<span class="size">{%=o.formatFileSize(file.size)%}</span>
</td>
<td>
{% if (file.deleteUrl) { %}
<button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
<i class="far fa-trash-alt"></i>
<span>Delete</span>
</button>
<input type="checkbox" name="delete" value="1" class="toggle">
{% } else { %}
<button class="btn btn-warning cancel">
<i class="glyphicon glyphicon-ban-circle"></i>
<span>Cancel</span>
</button>
{% } %}
</td>
</tr>
{% } %}
</script>
<!--upload  -->

<?php } ?>




<!-- Main Footer -->
<footer class="main-footer bg-light border-0 fixed-bottom">

  <!-- Default to the left -->
  <strong>Copyright &copy; <?php echo date(" Y"); ?></strong> All rights reserved. Developed by <a href="#" class="text-success" target="_blank">ekr@mul</a>
</footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script type="text/javascript">
var site_url = '<?= site_url();?>';

var session_data=JSON.parse('<?=$_SESSION['folder_root_id']?>');


</script>



<!-- AdminLTE App -->
<script src="<?php echo base_url();?>assets/admin/dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<!-- <script src="dist/js/demo.js"></script> -->

<!-- PAGE PLUGINS -->
<!-- SparkLine -->
<script src="<?php  echo base_url();?>assets/admin/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jVectorMap -->
<script src="<?php echo base_url();?>assets/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo base_url();?>assets/admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="<?php echo base_url();?>assets/admin/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS 1.0.2 -->
<script src="<?php echo base_url();?>assets/admin/plugins/chartjs-old/Chart.min.js"></script>


<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="<?php echo base_url();?>assets/js/vendor/jquery.ui.widget.js"></script>
<!-- The Templates plugin is included to render the upload/download listings -->
<script src="https://blueimp.github.io/JavaScript-Templates/js/tmpl.min.js"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="https://blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="https://blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>

<!-- blueimp Gallery script -->
<script src="https://blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="<?php echo base_url();?>assets/js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="<?php echo base_url();?>assets/js/jquery.fileupload.js"></script>
<!-- The File Upload processing plugin -->
<script src="<?php echo base_url();?>assets/js/jquery.fileupload-process.js"></script>
<!-- The File Upload image preview & resize plugin -->
<script src="<?php echo base_url();?>assets/js/jquery.fileupload-image.js"></script>
<!-- The File Upload audio preview plugin -->
<script src="<?php echo base_url();?>assets/js/jquery.fileupload-audio.js"></script>
<!-- The File Upload video preview plugin -->
<script src="<?php echo base_url();?>assets/js/jquery.fileupload-video.js"></script>
<!-- The File Upload validation plugin -->
<script src="<?php echo base_url();?>assets/js/jquery.fileupload-validate.js"></script>
<!-- The File Upload user interface plugin -->
<script src="<?php echo base_url();?>assets/js/jquery.fileupload-ui.js"></script>
<!-- The main application script -->


<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url();?>assets/js/dataTables.listView.js"></script>

<script src="<?php echo base_url();?>assets/js/bootstrapValidator.js"></script>
<!-- The main application script -->

<script src="<?php echo base_url();?>assets/js/main.js"></script>
<!-- PAGE SCRIPTS -->

<script type="text/javascript">
jQuery(document).ready(function() {
  $('#userlist').DataTable({
    "ajax": {
      url : "<?php echo site_url("user/show_user") ?>",
      type : 'GET'
    },
  });


});

/*jslint unparam: true */
/*global window, $ */
// $(function () {
//   'use strict';
//   var url = "<?= site_url("files/do_upload");?>";
//   // Change this to the location of your server-side upload handler:
//   // var url = window.location.hostname === 'blueimp.github.io' ?
//   //             '//jquery-file-upload.appspot.com/' : ' site_url("files/do_upload") ';
//   $('#fileupload').fileupload({
//     url:"<?=site_url("files/do_upload"); ?>",
//     dataType: 'json',
//     done: function (e, data) {
//       $.each(data.result.files, function (index, file) {
//         $('<p/>').text(file.name).appendTo('#files');
//       });
//     },
//     progressall: function (e, data) {
//       var progress = parseInt(data.loaded / data.total * 100, 10);
//       $('#progress .progress-bar').css(
//         'width',
//         progress + '%'
//       );
//     }
//   }).prop('disabled', !$.support.fileInput)
//   .parent().addClass($.support.fileInput ? undefined : 'disabled');
//
//   $('#fileupload').fileupload('option', { autoUpload:true	});
//   // $('#fileupload').fileupload({
//   //     url: 'server/php/'
//   // }).on('fileuploadsubmit', function (e, data) {
//   //     data.formData = data.context.find(':input').serializeArray();
//   // });
// });


/*
 * jQuery File Upload Plugin JS Example
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

/* global $, window */

$(function () {
    'use strict';

    // Initialize the jQuery File Upload widget:
    $('#fileupload').fileupload({
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
        url: "<?=site_url("files/json"); ?>",
        previewMaxWidth: 50,
        previewMaxHeight: 50,
        maxFileSize: 1024*102400000,
        done: function(e, data) {
         //hide completed upload element in queue
         $(data.context[0]).fadeOut(700);

         //here isoutput of uploaded objects
         console.log(data.result);
     }
});
  $('#fileupload').fileupload('option', { autoUpload:true	});
    // Load existing files:
    $('#fileupload').addClass('fileupload-processing');
    $.ajax({
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
        url: $('#fileupload').fileupload('option', 'url'),
        dataType: 'json',
        context: $('#fileupload')[0]
    }).always(function () {
        $(this).removeClass('fileupload-processing');
    }).done(function (result) {
        $(this).fileupload('option', 'done')
            .call(this, $.Event('done'), {result: result});
    });

    $('#fileupload').on('fileuploaddone', function (e, data) { // invoke callback method on success
        $.each(data.result.files, function (index, file) { //loop though each file
            if (file.url){ //successful upload returns a file url
                var link = $('<a>') .attr('target', '_blank') .prop('href', file.url);
                $(data.context.children()[index]).addClass('file-uploaded');
                $(data.context.children()[index]).find('canvas').wrap(link); //create a link to uploaded file url
                $(data.context.children()[index]).find('.file-remove').hide(); //hide remove button
                var done = $('<span class="text-success"/>').text('Uploaded!'); //show success message
                $(data.context.children()[index]).append(done); //add everything to data context
            } else if (file.error) {
                var error = $('<span class="text-danger"/>').text(file.error); //error text
                $(data.context.children()[index]).append(error); //add to data context
            }
        });
    });


$('#fileupload').bind('fileuploadend', function (e, data){
  // var str='<div class=" alert alert-success" role="alert">'+
  //   '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
  //   '<strong>uploaded!</strong> '+'</div>';
  // $('.alert-container').html(str).fadeOut(5000);
});

// function upload(e,data){
//   var str='<div class="alert alert-success" role="alert">'+
//     '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
//     '<strong>uploaded!</strong> '+'</div>';
//   $('.alert-container').html(str).fadeOut(5000);
// };
//     $('#fileupload').bind('fileuploaddestroyed', function(e, data) {
//
//     // If you edit the default template, you can acquire some other
//     // information about the uploaded file (for example the file size)
//     var fileName = data.context.find('a[download]').attr('download');
//
//     $.post(
//         '/removePictureFromDatabase.php',
//         {
//             fileName: fileName
//         },
//         function(data, textStatus) {
//             // Process result
//         },
//         'json'
//     );
//
// });
});


</script>


</body>
</html>
