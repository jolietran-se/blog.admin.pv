
@extends('admin.layouts.master')
@section('header.css')
    {{-- <link rel="stylesheet" href='http://cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css'> --}}
    <link rel='stylesheet' href='https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.css'>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
      <style type="text/css">
        .main-section{
            margin:0 auto;
            padding: 20px;
            margin-top: 100px;
            background-color: #fff;
            box-shadow: 0px 0px 20px #c1c1c1;
        }
        .fileinput-remove,
        .fileinput-upload{
            display: none;
        }

    </style>
@endsection

@section('content')
<datalist id="list_colors">
    @foreach ($colors as $colors)
        <option value="{{$colors->name}}"></option> 
    @endforeach
</datalist>
    <a class="btn btn-lg btn-info add-modal" style="margin-bottom: 30px" href="" data-toggle="modal" data-target="#create-item"><span class="glyphicon glyphicon-plus"></a>

    <div id="modal_add_abc" class="modal fade" role="dialog">
        <div class="modal-dialog" style="width: 1100px">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form">
                        {{-- <div class="container"> --}}
                        <div style="margin-left:30px;margin-right: 30px">
                            <div class="portlet-body">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="">Name (<span style="color: red">*</span>)</label>
                                            <input type="text" class="form-control" id="name" placeholder="Name" name="name">
                                            @if ($errors->has('name'))
                                                <span class="errors">{{$errors->first('name')}}</span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="">Origin Price (<span style="color: red">*</span>)</label>
                                            <input type="number" class="form-control" id="origin_price" placeholder="Origin Price" name="origin_price">
                                            @if ($errors->has('origin_price'))
                                                <span class="errors">{{$errors->first('origin_price')}}</span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="">Description (<span style="color: red">*</span>)</label>
                                            <textarea class="form-control" name="description" id="description" cols="30" rows="4" placeholder="Description"></textarea> 
                                             @if ($errors->has('description'))
                                                <span class="errors">{{$errors->first('description')}}</span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                                <label for="">Content (<span style="color: red">*</span>)</label>
                                                 <textarea name="txtContent" class="form-control " id="editor1"></textarea>
                                                @if ($errors->has('content'))
                                                    <span class="errors">{{$errors->first('content')}}</span>
                                                @endif
                                        </div>
                                        
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                      
                                      {{-- categories --}}
                                        <div class="portlet light bordered">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="fa fa-list font-green" aria-hidden="true"></i>
                                                    <span class="caption-subject font-green bold">Category</span>
                                                </div>
                                            </div>
                                            <div class="portlet-body">
                                                <select class="form-control category" name="category_id" >
                                                    {{-- <option value=""></option> --}}
                                                  @if (count($categories)>0) @foreach ($categories as $category)
                                                      <option value="{{$category->id}}">{{$category->name}}</option>
                                                  @endforeach @endif
                                                </select>
                                             </div>
                                        </div>
                                        {{-- manufacture --}}
                                        <div class="portlet light bordered">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="fa fa-list font-green" aria-hidden="true"></i>
                                                    <span class="caption-subject font-green bold">Manufacture</span>
                                                </div>
                                            </div>
                                            <div class="portlet-body">
                                                <select class="form-control manufacture" name="manufacture_id">
                                                    {{-- <option value=""></option> --}}
                                                  @if (count($manufactures)>0) @foreach ($manufactures as $manufacture)
                                                      <option value="{{$manufacture->id}}">{{$manufacture->name}}</option>
                                                  @endforeach @endif
                                                </select>
                                             </div>
                                        </div>
                                    
                                            
                                        {{-- image --}}
                                        {{-- <div class="row"> --}}
                                        <div class=" main-section" style="width: 440px ; margin-left: 30px; margin-top: 30px; margin-bottom: 30px">
                                            {{-- <h1 class="text-center text-danger">File Input Example</h1><br>
                                            
                                                {!! csrf_field() !!} --}}
                                                <div class="form-group">
                                                    <div class="file-loading">
                                                        <input id="file-1" type="file" name="file[]" multiple class="file" data-overwrite-initial="false" data-min-file-count="2">
                                                    </div>
                                                </div>
                                            
                                        </div>
                                    </div>  

                                        {{-- size color quantity --}}
                                        <div class="alert alert-danger print-error-msg" style="display:none">
                                            <ul></ul>
                                        </div>
                                        <div class="alert alert-success print-success-msg" style="display:none">
                                            <ul></ul>
                                        </div>
                                        <div class="table-responsive">  
                                            <table class="table table-bordered" style="border: none;" id="dynamic_field">
                                                <thead> 
                                                    <tr>
                                                        <th>Size</th>
                                                        <th>Color</th>
                                                        <th>Quantity</th>
                                                        <td><button type="button" name="add" id="add" class="btn btn-success">
                                                            <span class="glyphicon glyphicon-plus"></span>
                                                        </button></td> 
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="dynamic-added" id="row-1" data-number ="1">
                                                        <td>                                                
                                                            <input type="number" class="form-control size name_list" id="size_1_id">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control color name_list" id="color_1_id" list="list_colors">
                                                        </td>
                                                        <td>
                                                            <input type="number" name="quantity[]" id="quantity_1" placeholder="Enter your Quantity" class="form-control name_list" />
                                                        </td>
                                                        <td><button type="button" name="remove" class="btn btn-danger btn_remove1" id="remove-tr'+i+'" data-id="'+i+'"><span class="glyphicon glyphicon-minus" id="remove-tr'+i+'"></span></button></td>
                                                    </tr>
                                                </tbody>
                                            </table>  
                                        </div>
                                       {{--  <div>
                                             <input type="checkbox" class="published" data-id="" checked="">
                                        </div> --}} 
                                    </div>
                                </div>
                          
                            </div>
                        </div>
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success add" data-dismiss="modal" id="submit">
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
      <!-- Modal form to show all product detail -->
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
                                <th>Size</th>
                                <th>Color</th>
                                <th>Quantity</th>
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
    <!-- Modal form to edit a product -->
 
    <table class="table table-hover" id="products-table">

        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Description</th>
                <th>Origin_price</th>
                <th>Created_at</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
        
@endsection
@section('footer.js')
    <script src="http://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
  <!-- toastr notifications -->
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/js/fileinput.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/themes/fa/theme.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" type="text/javascript"></script>
       {{-- <script src="{{ asset('/vendor/laravel-filemanager/js/lfm.js') }}"></script> --}}
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script> 
         CKEDITOR.replace( 'editor1', {
        filebrowserBrowseUrl: '{{ asset('ckfinder/ckfinder.html') }}',
        filebrowserImageBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Images') }}',
        filebrowserFlashBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Flash') }}',
        filebrowserUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
        filebrowserImageUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
        filebrowserFlashUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
    } );
    </script>
     {{-- <script type="text/javascript">
        $('#lfm').filemanager('image');
     </script> --}}
    <script type="text/javascript">
        $("#file-1").fileinput({
            theme: 'fa',
            uploadUrl: "/image-view",
            uploadExtraData: function() {
                return {
                    _token: $("input[name='_token']").val(),
                };
            },
            allowedFileExtensions: ['jpg', 'png', 'gif'],
            overwriteInitial: false,
            maxFileSize:200,
            maxFilesNum: 10,
            slugCallback: function (filename) {
                return filename.replace('(', '_').replace(']', '_');
            }
        });
    </script>


    {{-- <script type="text/javascript" src="{{ asset('js/product.js') }}"></script> --}}
    <script>
        $(function() {
            // datatable laravel
            var colorTable = $('#products-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('product.anydata') !!}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'slug', name: 'slug' },
                    { data: 'description', name: 'description' },
                    { data: 'origin_price', name: 'origin_price' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'action', name: 'action' }
                ]
            });

            // add a product"

            $(document).on('click', '.add-modal', function() {
                $('.modal-title').text('Add');
                $('#modal_add_abc').modal('show');
            });
            $('.modal-footer').on('click', '.add', function() {
                var newPost = new FormData();
                var files = document.getElementById('file-1').files;

                for (var i = 0; i < files.length; i++) {
                    newPost.append('image[]',files[i]);

                }   

                var detail = [];
                $('.dynamic-added').each(function(){
                    var number = $(this).data('number');
                    var size_id = $('#size_'+ number +'_id').val();
                    var color_id = $('#color_'+ number +'_id').val();
                    var qty = $('#quantity_'+ number).val();
                    var details = {
                        size: size_id,
                        color : color_id,
                        qty : qty,
                    };
                    detail.push(details);
                });
                $('textarea.editor').ckeditor(function() {
                    }, { toolbar : [
                        ['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print', 'SpellChecker', 'Scayt'],
                        ['Undo','Redo'],
                        ['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
                        ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote'],
                        ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
                        ['Link','Unlink','Anchor', 'Image', 'Smiley'],
                        ['Table','HorizontalRule','SpecialChar'],
                        ['Styles','BGColor']
                    ], toolbarCanCollapse:false, height: '300px', scayt_sLang: 'pt_PT', uiColor : '#EBEBEB' } );
                console.log(detail);
                console.log(files);
                console.log(CKEDITOR.instances["editor1"].getData());
                editor1
                newPost.append('details',detail);
                newPost.append('name', $('#name').val());
                newPost.append('origin_price', $('#origin_price').val());
                newPost.append('description',jQuery("textarea#description").val());
                newPost.append('content',$( 'textarea.editor' ).val());
                newPost.append('category_id',$(".category option:selected").val());
                newPost.append('manufacture_id',$(".manufacture option:selected").val());
                // newPost.append('size_id',$('#size_1_id').val());
                // console.log($('#thumbnail').val());
                $.ajax({
                    type: 'POST',
                    url: '{{ route('product.store') }}',
                    data:newPost,
                    dataType:'json',
                    async:false,
                    processData: false,
                    contentType: false,
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
            // show detail product
             $(document).on('click', '.show-modal', function() {
                $('.modal-title').text('Show');
                $('#showModal').modal('show');

                var id = $(this).attr('data-id');
                console.log(id);
                var url = '{{ asset('admin/product') }}'+'/' + id +'/anydataListProduct';
                $('#productlist-table').DataTable({
                    
                    processing: true,
                    serverSide: true,
                    "destroy": true,
                    ajax: url,
                    columns: [ 
                        { data: 'id', name: 'id' },
                        { data: 'size.size', name: 'size' },
                        { data: 'color.code', name: 'color' },
                        { data: 'quantity', name: 'quantity' },
                        { data: 'created_at', name: 'created_at' },
                    ]
                });
            });
             // edit product
              $('#category-table').on('click', '.edit-modal', function(e){
                e.preventDefault();
            });

            $(document).on('click', '.edit-modal', function() {
                $('.modal-title').text('Edit');
                $('#editModal').modal('show');
                var id = $(this).attr('data-id');
                var description = jQuery("textarea#description_edit").val();
                var content = tinymce.get("content_edit").getContent();
                var selectedCategory = $("#category_id_edit option:selected").val();
                var selectedManufacture = $("#manufacture_id_edit  option:selected").val();
                var selectedSize = $("#size_edit option:selected").val();
                var selectedColor = $("#color_edit option:selected").val();
                var url = '{{ asset('admin/product/edit') }}'+'/' + id;
         

                $.ajax({
                    type: 'get',
                    url: url,
                    success: function(response){
                        $('#name_edit').val(response.name); 
                        $('#thumbnail_edit').val(response.image); 
                        $('#origin_price_edit').val(response.name); 
                        $(description).val(response.description); 
                        $(selectedCategory).val(response.category); 
                        $(selectedManufacture).val(response.manufacture); 
                        $(selectedSize).val(response.size); 
                        $(selectedColor).val(response.color); 
                        $(description).val(response.description); 
                       tinymce.get("edit_textarea_content").setContent(response.content);
                        
                    }
                })

                $('.modal-footer').on('click', '.edit', function() {

                    var content = tinymce.get("edit_textarea_content").getContent();

                    var url = '{{ asset('admin/category/update') }}'+'/' + id;
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
                                toastr.success('Successfully edit Category!', 'Success Alert', {timeOut: 5000});
                                colorTable.ajax.reload();
                            }
                        },
                    });
                });
           
            });

             // delete product
            $('#products-table').on('click', '.delete', function(e){
                e.preventDefault();
            });
            $('#products-table').on('click', '.btn-danger', function(e){
                e.preventDefault();
                var id = $(this).attr('data-id');
                var url = '{{ asset('admin/product/delete') }}'+'/' + id;
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
                                product_id : id,
                            },
                            success: function(res)
                            {
                                if(!res.error) {
                                     
                                    toastr.success('Sản Phẩm đã được xóa!');
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
    </script>

    <script type="text/javascript">
        $(document).ready(function(){      
          
          var i=1;  


          $('#add').click(function(){  
               i++;  

            
              

               $('#dynamic_field').append('<tr class="dynamic-added" id="row-'+ i +'" data-number="'+ i +'"><td><input type="number" class="form-control size name_list" id="size_'+ i +'_id"></td><td><input type="text" class="form-control color name_list" id="color_'+ i +'_id" list="list_colors"></td><td><input type="number" name="quantity[]" id="quantity_'+ i +'" placeholder="Enter your Quantity" class="form-control name_list" /></td><td><button type="button" name="remove" class="btn btn-danger btn_remove1" id="remove-tr'+i+'" data-id="'+i+'"><span class="glyphicon glyphicon-minus" id="remove-tr'+i+'"></span></button></td></tr>');   
          });  

            
            $(document).on('click', '.btn_remove1', function(){  
                $(this).parents('tr').remove();
            });  


          $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });


        


        });  
    </script>

    



    
@endsection