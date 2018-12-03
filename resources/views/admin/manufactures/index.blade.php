@extends('admin.layouts.master')
@section('header.css')
	<link rel="stylesheet" href="{{ asset('http://cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css') }}">
	<link rel="stylesheet" href="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
     <link rel='stylesheet' href='https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.css'>
@endsection
@section('content')
	{{-- add-modal --}}
	<a class="btn btn-lg btn-info add-modal" style="margin-bottom: 30px" href="" data-toggle="modal" data-target="#create-item"><span class="glyphicon glyphicon-plus"></a>

	<div id="addModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="title">Name:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name_add" autofocus>
                               
                                <p class="errorTitle text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                       {{--  --}}
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="content">Description:</label>
                            <div class="col-sm-10">
                                 <textarea class="form-control" name="description" id="textarea_content" placeholder="Content" class="ckeditor"  data-error="Please enter description." cols="40" rows="5" ></textarea> 
                               
                                <p class="errorContent text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success add" data-dismiss="modal">
                            <span id="" class='glyphicon glyphicon-check'></span> Add
                        </button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal">
                            <span class='glyphicon glyphicon-remove'></span> Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="data-container">
	</div>


    <!-- Modal form to show all product in category-->
    <div id="showModal" class="modal fade" role="dialog" >
        <div class="modal-dialog modal-lg" >
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <table class="table table-hover"  id="productlist-table">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Sale_price</th>
                                <th>Origin_price</th>
                                <th>Created_at</th>
                            </tr>
                            </thead>
                    </table>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">
                            <span class='glyphicon glyphicon-remove'></span> Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                                 <textarea class="form-control" name="description" id="edit_textarea_content" placeholder="Content" class="ckeditor"  data-error="Please enter description." cols="40" rows="5"></textarea> 
                               
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


	<table class="table table-hover" id="manufacture-table">
		 
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
	<script src="http://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
	<script src="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.5.6/tinymce.min.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/tinymce/4.5.6/jquery.tinymce.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
     
    <!-- toastr notifications -->
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <!-- icheck checkboxes -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js"></script>

    <!-- Delay table load until everything else is loaded -->
    <script>
        $(window).load(function(){
            $('#manufacture-table').removeAttr('style');
        })
    </script>
	<script>
	  $.widget.bridge('uibutton', $.ui.button);
	</script>

	<script>

         $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        $(function() {

            $('#manufacture-table').on('click', '.btn-detail', function(e){
                 e.preventDefault();
            })

            var colorTable = $('#manufacture-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('manufacture.anydata') !!}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'description', name: 'description' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'action', name: 'action' }
                ]
            });

            // add a category

            $(document).on('click', '.add-modal', function() {
                $('.modal-title').text('Add');
                $('#addModal').modal('show');
            });
            $('.modal-footer').on('click', '.add', function() {

                var content = tinymce.get("textarea_content").getContent();
                $.ajax({
                    type: 'POST',
                    url: '{{ route('manufacture.store') }}',
                    data: {
                        _token: $('input[name=_token]').val(),
                        name: $('#name_add').val(),
                        description: content,
                    },
                    success: function(data) {
                        $('.errorName').addClass('hidden');
                        $('.errorDescription').addClass('hidden');

                        if ((data.errors)) {
                            setTimeout(function () {
                                $('#addModal').modal('show');
                                toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
                            }, 500);

                            if (data.errors.name) {
                                $('.errorName').removeClass('hidden');
                                $('.errorName').text(data.errors.name);
                            }
                            if (data.errors.description) {
                                $('.errorDescription').removeClass('hidden');
                                $('.errorDescription').text(data.errors.description);
                            }
                        } else {
                            toastr.success('Successfully added Post!', 'Success Alert', {timeOut: 5000});
                            colorTable.ajax.reload();
                        }
                    },
                });
            });

            // show total product in category

            $(document).on('click', '.show-modal', function() {
                $('.modal-title').text('Show');
                $('#showModal').modal('show');

                var id = $(this).attr('data-id');
                var url = '{{ asset('admin/manufacture') }}'+'/' + id +'/anydataListProduct';
                $('#productlist-table').DataTable({
                    processing: true,
                    serverSide: true,
                    "destroy": true,
                    ajax: url,
                    columns: [ 
                        { data: 'id', name: 'id' },
                        { data: 'name', name: 'name' },
                        { data: 'description', name: 'description' },
                        { data: 'sale_price', name: 'sale_price' },
                        { data: 'origin_price', name: 'origin_price' },
                        { data: 'created_at', name: 'created_at' },
                    ]
                });
            });

            // fuction edit category

            $('#manufacture-table').on('click', '.edit-modal', function(e){
                e.preventDefault();
            });

            $(document).on('click', '.edit-modal', function() {
                $('.modal-title').text('Edit');
                $('#editModal').modal('show');
                var id = $(this).attr('data-id');
                var ed = tinyMCE.get('content');
                var content = tinymce.get("edit_textarea_content").getContent();
                var url = '{{ asset('admin/manufacture/edit') }}'+'/' + id;


                $.ajax({
                    type: 'get',
                    url: url,
                    success: function(response){
                        $('#name_edit').val(response.name); 
                        // $('#description_edit').val(response.description_edit); 
                       tinymce.get("edit_textarea_content").setContent(response.description);
                        
                    }
                })

                $('.modal-footer').on('click', '.edit', function() {

                    var content = tinymce.get("edit_textarea_content").getContent();

                    var url = '{{ asset('admin/manufacture/update') }}'+'/' + id;
                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: {
                            _token: $('input[name=_token]').val(),
                            name: $('#name_edit').val(),
                            description: content,
                        },
                        success: function(data) {
                            $('.errorName').addClass('hidden');
                            $('.errorDescription').addClass('hidden');

                            if ((data.errors)) {
                                setTimeout(function () {
                                    $('#editModal').modal('show');
                                    toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
                                }, 500);

                                if (data.errors.name) {
                                    $('.errorName').removeClass('hidden');
                                    $('.errorName').text(data.errors.name);
                                }
                                if (data.errors.description) {
                                    $('.errorDescription').removeClass('hidden');
                                    $('.errorDescription').text(data.errors.description);
                                }
                            } else {
                                toastr.success('Successfully edit Manufacture!', 'Success Alert', {timeOut: 5000});
                                colorTable.ajax.reload();
                            }
                        },
                    });
                });
           
            });
            $('#manufacture-table').on('click', '.delete', function(e){
                e.preventDefault();
            });

            $('#manufacture-table').on('click', '.delete', function(){
                var id = $(this).attr('data-id');
                var url = '{{ asset('admin/manufacture/delete') }}'+'/' + id;
                // console.log('aksjdflksajflksadjflk');
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
                                manufacture_id : id,
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