@extends('admin.layouts.master')
@section('header.css')
  <link rel="stylesheet" href="{{ asset('http://cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
     <link rel='stylesheet' href='https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.css'>
     {{-- <link href="https://cdn.alloyui.com/3.0.1/aui-css/css/bootstrap.min.css" rel="stylesheet"></link> --}}
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
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="title">Caption 1:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="caption1_add" autofocus>
                               
                                <p class="errorTitle text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="title">Caption 2:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="caption2_add" autofocus>
                               
                                <p class="errorTitle text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="title">Caption 3:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="caption3_add" autofocus>
                               
                                <p class="errorTitle text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                      
                        <div class="form-group"  >
                            <label class="control-label col-sm-2" for="title">Select Image:</label>
                            <div class="input-group col-sm-10">
                               <span class="input-group-btn">
                                 <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                   <i class="fa fa-picture-o" ></i> Choose
                                 </a>
                               </span>
                               <input id="thumbnail" class="form-control" type="text" name="filepath">
                             </div>
                             <img id="holder" style="margin-top:15px;max-height:100px;">
                                                                            
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


    <!-- Modal form to show all product in color-->
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
                                <th>Code</th>
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
                       <div class="form-group" id="myColorPalette" >
                          <label class="control-label col-sm-2" for="title">Select Color</label>

                          <div class="col-sm-10">
                             <input id="color_edit" class="form-control" type="color"  placeholder="Click to select a color" >
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


  <table class="table table-hover" id="color-table">
     
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Caption 1</th>
        <th>Caption 2</th>
        <th>Caption 3</th>
        <th>Image</th>
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
{{-- <script src="https://cdn.alloyui.com/3.0.1/aui/aui-min.js"></script> --}}
<script src="{{ asset('/vendor/laravel-filemanager/js/lfm.js') }}"></script>
<script type="text/javascript">
    $('#lfm').filemanager('file');
</script>
  <script src="http://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
     
    <!-- toastr notifications -->
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <!-- icheck checkboxes -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js"></script>
    
    {{-- <script type="text/javascript" src=""></script> --}}
    

    <!-- Delay table load until everything else is loaded -->
    <script>
        $(window).load(function(){
            $('#color-table').removeAttr('style');
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

            $('#color-table').on('click', '.btn-detail', function(e){
                 e.preventDefault();
            })

            var colorTable = $('#color-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('slide.anydata') !!}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'caption1', name: 'caption1' },
                    { data: 'caption2', name: 'caption2' },
                    { data: 'caption3', name: 'caption3' },
                    { data: 'image', name: 'image' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'action', name: 'action' }
                ]
            });

            // add a color

            $(document).on('click', '.add-modal', function() {
                $('.modal-title').text('Add');
                $('#addModal').modal('show');
            });
            $('.modal-footer').on('click', '.add', function() {
                console.log()

                $.ajax({
                    type: 'POST',
                    url: '{{ route('slide.store') }}',
                    data: {
                        _token: $('input[name=_token]').val(),
                        name: $('#name_add').val(),
                        caption1: $('#caption1_add').val(),
                        caption2: $('#caption2_add').val(),
                        caption3: $('#caption3_add').val(),
                        link: $('#thumbnail').val(),
                    },
                    success: function(data) {
                   
                            toastr.success('Successfully added Post!', 'Success Alert', {timeOut: 5000});
                            colorTable.ajax.reload();
                        
                    },
                });
            });

            // show total product in color

            $(document).on('click', '.show-modal', function() {
                $('.modal-title').text('Show');
                $('#showModal').modal('show');

                var id = $(this).attr('data-id');
                var url = '{{ asset('admin/slide') }}'+'/' + id +'/anydataListProduct';
                $('#productlist-table').DataTable({
                    processing: true,
                    serverSide: true,
                    "destroy": true,
                    ajax: url,
                    columns: [ 
                        { data: 'id', name: 'id' },
                        { data: 'name', name: 'name' },
                        { data: 'code', name: 'code' },
                        { data: 'created_at', name: 'created_at' },
                    ]
                });
            });

            // fuction edit color

            $('#color-table').on('click', '.edit-modal', function(e){
                e.preventDefault();
            });

            $(document).on('click', '.edit-modal', function() {
                $('.modal-title').text('Edit');
                $('#editModal').modal('show');
                var id = $(this).attr('data-id');
                console.log(id);
                var url = '{{ asset('admin/slide/edit') }}'+'/' + id;


                $.ajax({
                    type: 'get',
                    url: url,
                    success: function(response){
                        $('#name_edit').val(response.name); 
                        $('#color_edit').val(response.code); 
                        
                    }
                })

                $('.modal-footer').on('click', '.edit', function() {
                    var url = '{{ asset('admin/slide/update') }}'+'/' + id;
                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: {
                            _token: $('input[name=_token]').val(),
                            name: $('#name_edit').val(),
                            code: $('#color_edit').val(),
                        },
                        success: function(data) {
                            console.log(data.data);
                            colorTable.ajax.reload();
                        },
                        error: function(error){
                            console.log(error);
                        }
                    });
                });
           
            });
            $('#color-table').on('click', '.delete', function(e){
                e.preventDefault();
            });
             $('#color-table').on('click', '.btn-danger', function(e){
                e.preventDefault();
                var id = $(this).attr('data-id');
                var url = '{{ asset('admin/slides/delete') }}'+'/' + id;
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
                                color_id : id,
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

@endsection