<!DOCTYPE html>
<html>
<head>
	<title>demo abc</title>
	<!-- Latest compiled and minified CSS & JS -->
	<link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
	<script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
	<script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
</head>
<body>
	<div class="container">
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
			    	<tr class="dynamic-added" id="row-1">
			    		<td contenteditable="true" class="item_size">
			    		{{-- 	<select class="form-control size" name="size[]" id="size_id"  class="form-control name_list">
			    				@if (count($sizes)>0) 
			    					@foreach ($sizes as $size)
				    					<option value="{{$size->id}}">{{$size->size}}</option> 
				    				@endforeach
				    			@endif
				    		</select> --}}
			    		</td>
		    			<td contenteditable="true" class="item_color">
		    				{{-- <select class="form-control color" name="color[]" id="color_id" class="form-control name_list">
		    					@if (count($colors)>0) 
			    					@foreach ($colors as $colors)
				    					<option value="{{$colors->id}}">{{$colors->name}}</option> 
				    				@endforeach
				    			@endif
		    				</select> --}}
		    			</td>
		    			<td class="item_quantity">
		    				<input type="number" name="quantity[]" id="quantity" placeholder="Enter your Quantity" class="form-control name_list" />
		    			</td>
		    			<td><button type="button" name="remove" class="btn btn-danger btn_remove1" id="remove-tr'+i+'" data-id="'+i+'"><span class="glyphicon glyphicon-minus" id="remove-tr'+i+'"></span></button></td>
			    	</tr>
			    </tbody>
	        </table> 
	        <div align="center">
	        	<button type="button" class="btn btn-success add" data-dismiss="modal" id="submit">
                            <span id="" class='glyphicon glyphicon-check'></span> Add
                        </button>
	        </div> 
	    </div>
    </div>
</body>
</html>
<script type="text/javascript">
    $(document).ready(function(){      
      
      var i=2;  


      $('#add').click(function(){  
           i++;  

           var element = $('#row-1').html();
          

           $('#dynamic_field').append('<tr class="dynamic-added" id="'+i+'">' + element +'</tr>');   
      });  

      	
      	$(document).on('click', '.btn_remove1', function(){  
      		$(this).parents('tr').remove();
      	}); 
      	$('.add').click(function(){
      		var item_size = [];
      		var item_color = [];
      		var item_quantity = [];
      		$('item_size').each(function(){
      			item_size.push($(this).text());
      		});
      		$('item_color').each(function(){
      			item_color.push($(this).text());
      		});
      		$('item_quantity').each(function(){
      			item_quantity.push($(this).text());
      		});
      		console.log(item_size);
      		// $ajax({
      		// 	url : "",
      		// 	method:"POST",
      		// 	data:{
      		// 		item_size:item_size,
      		// 		item_color:item_color,
      		// 		item_quantity:item_quantity
      		// 	},
      			
      		// 	success:function(data)
      		// 	{
      		// 		$("td[contenteditable='true']").text();
      		// 		for (var i = 2; i < count; i++) {
      		// 			$('tr#'+i+'').remove();
      		// 		}
      		// 		console.log(data);
      		// 	}
      		// })
      	}); 
	});  
	</script>

{{-- <script type="text/javascript">
	$(document).ready(function(){
		var count = 1;
		$('#add').click(function(){
			count = count + 1;
			var html_code = "<tr id='row"+ count+"'>";
			var html_code += "<td contenteditable='true' id="item_size"></td>";
			var html_code += "<td contenteditable='true' id="item_color"></td>";
			var html_code += "<td contenteditable='true' id="item_quantity"></td>";
			var html_code += "<button type=button' id='remove' name='remove' class='btn btn-danger btn-xs remove' data-row='row"+ count +"'>-</button>";
			var html_code = "</tr>";

			$('#crub_table').append(html_code);
		});
		$(document).om('click','.remove',function(){
			var delete_row = $(this).data("row");
			$('#' + delete_row).remove();
		})
	});
</script> --}}