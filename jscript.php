$(document).ready(function(){
	show();
});

// Display All Records
function show(){
	$.ajax({
		url: 'controller.php',
		method: 'post',
		data: {showRecords:1},
		dataType: 'json',
		cache:false,
		success:function(response){
			$('#dataTable').html(response);
		}
	});
}
// End Display all records

// POPHOVER view
$(document).ready(function(){
    $(document).on('mouseover', '.image', function(event){
		
     $anchor = $(event.target);
     var id = $anchor.attr('user-data');
     if ($anchor.hasClass('image')) {
     	$.ajax({
     		url: 'controller.php',
     		method: 'post',
     		data:{showSelectedRecords:1, user_id:id},
     		dataType: 'json',
     		success:function(response){
	     	$html = response;
	     	$('#'+id+'').popover({
    		// trigger : 'hover',
    		html : true,
    		placement: 'right',
    		container: 'body',
            content : $html
    		});
     		}
     	});
     }
    });

// Alternative code for popover
    /*$('.image').popover({
		content:fetchData,
		html:true,
		container: 'body',
		placement: 'left'
	});

    function fetchData(){
		var fetch_data = '';
		var element = $(this);
		var id = element.attr("user-data");
		$.ajax({
			url:"controller.php",
			method:"POST",
			dataType: 'json',
			async:false,
			data:{showSelectedRecords:1,user_id:id},
			success:function(data){
				fetch_data = data;
			}
		});
		return fetch_data;
	}*/
//  End Alternative code for popover



}); 
// End POPHOVER view 

// Add New Profile
$(document).ready(function(){
	$(document).on('submit', '#addProfileForm', function(event){
		event.preventDefault();
		$form = $(this);
		$.ajax({
			url: $form.attr('action'),
			method: $form.attr('method'),
			dataType: 'json',
			contentType: false,
			processData: false,
			cache: false,
			data: new FormData(this),
			success: function(response){
				show();
				$('#msg').html(response);
				$('#addProfileForm')[0].reset();
			}
		});
	});
});
// Edit 
$(document).ready(function(){
	$(document).on('click', '#edit', function(event){
		event.preventDefault();
		$anchor = $(event.target);
		var id = $anchor.attr('user-data');
		$.ajax({
			url: 'controller.php',
			method: 'post',
			dataType: 'json',
			data:{showEditRecords:1,user_id:id},
			success:function(response){
				$('#UpdateFormDisplay').html(response);
			}
		});
	});
});
// End Edit

$(document).ready(function(){
	$(document).on('submit', '#updateProfileForm', function(event){
		event.preventDefault();
		$form = $(this);
		$.ajax({
			url: $form.attr('action'),
			method: $form.attr('method'),
			dataType: 'json',
			contentType: false,
			processData: false,
			cache: false,
			data: new FormData(this),
			success: function(response){
				show();
				$('#updateProfileModal').modal('toggle');
			}
		});
	});
});
