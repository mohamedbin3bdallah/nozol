<!DOCTYPE html>
<html>
	<head>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.4/socket.io.js"></script>
	</head>
	<body>
		<table class="table">
			<tr>
				<td>
					TEST
				</td>
				<td>
					TEST 1
				</td>
			</tr>
		</table>
		<script>
			var socket = io.connect('http://localhost:3001');
			socket.on('new_notify',function(data){
				$('.table').append('<tr><td>'+data.test+'</td><td>'+data.test1+'</td></tr>');
			})
		</script>
	</body>
</html>