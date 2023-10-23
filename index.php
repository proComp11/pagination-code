<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Pagination Example</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
	<style>
		#pagination {
			display: inline-block;
			}
			#pagination a {
				color: black;
				float: left;
				padding: 8px 16px;
				text-decoration: none;
			}

			#pagination a.active {
				background-color: #4CAF50;
				color: white;
			}
			#pagination a:hover:not(.active) {background-color: #ddd;}
	</style>
</head>
<body>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-sm-6">
				<h3>PAGINATION EXAMPLE</h3>
				<div id="table-data">
					
				</div>
			</div>
		</div>
	</div>
</body>
</html>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script type="text/javascript">
	$(()=>{
		function fetchData(page){
			$.ajax({
				url:"load-ajaxData.php",
				type:"POST",
				data:{
					page_no : page
				},
				success:function(data){
					data = JSON.parse(data);
					// console.log(data);
					$('#table-data').html(data.result);
				}
			});
		}
		// paginate code
		fetchData();
		// paginate code 
		$(document).on("click" ,"#pagination a" ,function(e) {
			e.preventDefault();
			let page_id =  $(this).attr('id');
			console.log(page_id);
			fetchData(page_id);
		});	
	});
</script>