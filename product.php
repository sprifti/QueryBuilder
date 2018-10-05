<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="//code.jquery.com/jquery.js"></script>
</head>
<body>
	
	<div>
		<button id="change" class="btn btn-primary">Change status</button>
	</div>

	<script>

		$('#change').on('click', function() {
			changeStatus();
		});

		function changeStatus(){
			var product = {
				id: 1,
				name: 'ER',
				description: 'product description',
				status: 'Pre-active',
				category: '3'
			};


			$.post('check.php',{product: product, current: 1, request: 2},function(d){
				alert(d);
			});
		}
	</script>


</body>
</html>