@extends('admin.layouts.master')
@section('header.css')
	<link rel="stylesheet" href="{{ asset('http://cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css') }}">
	<link rel="stylesheet" href="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
     <link rel='stylesheet' href='https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.css'>
@endsection
@section('content')
	
    <!-- Modal form to edit a categoty -->
    <div id="editModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">

                     <form class="form-horizontal" role="form">
                        @csrf
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="title" value="{{ old('name') }}">Name:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name_edit" value="" autofocus>
                               
                                <p class="errorTitle text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                          <div class="form-group">
                            <label class="control-label col-sm-2" for="content">Description:</label>
                            <div class="col-sm-10">
                                 <textarea class="form-control" name="description" id="edit_textarea_content" placeholder="Content" class="ckeditor"  data-error="Please enter description." cols="40" rows="5" ></textarea> 
                               
                                <p class="errorContent text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary edit" data-dismiss="modal">
                            <span class='glyphicon glyphicon-check'></span> Edit
                        </button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal">
                            <span class='glyphicon glyphicon-remove'></span> Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>


	<table class="table table-hover" id="category-table">
		 
		<thead>
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Description</th>
				<th>Created_at</th>
				<th>Action</th>
			</tr>
		</thead>

	
	</table>
	{{-- <div class="fb-customerchat"
	 	page_id="<PAGE_ID>">
	</div>
		 --}}
@endsection
@section('footer.js')
	<script>

            $('#category-table').on('click', '.delete', function(e){
                e.preventDefault();
            });
             $('#category-table').on('click', '.btn-danger', function(e){
                e.preventDefault();
                var id = $(this).attr('data-id');
                var url = '{{ asset('admin/category/delete') }}'+'/' + id;
                swal({
                  dangerMode: true,
                  title: "Bạn có muốn xóa viết này không?",
                  icon: "warning",
                  buttons: {
                    cancel: 'Hủy',
                    confirm: 'Xóa'
                  }
                })
                .then((willDelete) => {
                    if (willDelete) {
                       
                        $.ajax({
                            type: "delete",
                            url: url,
                            data: {
                                category_id : id,
                            },
                            success: function(res)
                            {
                                if(!res.error) {
                                     
                                    toastr.success('Bài viết đã được xóa!');
                                    colorTable.ajax.reload();   
                                }
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                toastr.error(thrownError);

                            }
                        });
                    } else {
                        swal("Bạn đã hủy xóa bài viết!");
                    }
                });

       
            });
        });
             // --------------------------------
       


	</script>
	
	<script>

	    tinymce.init({
	    selector: 'textarea',
	    height: 200,
	    theme: 'modern',
	    menubar: false,
	    autosave_ask_before_unload: false,
	    plugins: [
	      "advlist autolink link image lists charmap print preview hr anchor pagebreak",
	      "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
	      "table contextmenu directionality emoticons template textcolor paste textcolor colorpicker textpattern codesample"
	    ],
	    toolbar1: "newdocument | forecolor backcolor cut copy paste bullist numlist bold italic underline strikethrough| alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect  | searchreplace  | outdent indent | undo redo | link unlink anchor code | insertdatetime preview | table | hr removeformat | subscript superscript | charmap emoticons | print fullscreen | codesample",
	    image_advtab: true,
	    content_css: [
	      '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
	      '//www.tinymce.com/css/codepen.min.css'
	    ],
	    setup: function (ed) {
	        ed.on('init', function (e) {
	            ed.execCommand("fontName", false, "Tahoma");
	        });
	    },
	    relative_urls: false,
	    remove_script_host : false,
	    file_browser_callback : function(field_name, url, type, win) {
	      var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
	      var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

	      var cmsURL = route_prefix + 'laravel-filemaneger?field_name=' + field_name;
	      if (type == 'image') {
	        cmsURL = cmsURL + "&type=Images";
	      } else {
	        cmsURL = cmsURL + "&type=Files";
	      }

	      tinyMCE.activeEditor.windowManager.open({
	        file : cmsURL,
	        title : 'Image manager',
	        width : x * 0.9,
	        height : y * 0.9,
	        resizable : "yes",
	        close_previous : "no"
	      });
	    }
   });
   
    $('#post-create').on('keyup keypress', function(e) {
      var keyCode = e.keyCode || e.which;
      if (keyCode === 13) { 
        e.preventDefault();
        return false;
      }
    });

    

    
</script>
@endsection