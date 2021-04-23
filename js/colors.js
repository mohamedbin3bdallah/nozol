$(document).ready(function(){
	$(".colordel").click(function() {
		var id = $(this).attr('id');		
		$("#colors-"+id).modal('show');
		
});
});

function deletecolor(id)
{
	$.ajax({
		type:'POST',
		//data:dataString,
		data: {	
		'id': id,
		},
		url:'../ajaxs/deletecolor.php',
		success: function (response) { $("#tr-"+id).hide(); }
	});
}