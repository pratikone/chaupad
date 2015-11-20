<html>
	<head>
		
		<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
		<script type="text/javascript" src="http://localhost/yt/codeigniter/application/views/youtube/js/formatting.js"></script>
	</head>
	<body>
		
		Hello Nigga...
		<div class="something">
			<script type="text/javascript">
				var jqxhr =
						$.ajax({
						url: 'ajaxTest',
						dataType: 'json'
						})
						.done (function(data) {
						$("body").html(
							data["json"] + $.parseJSON(data["json"]).name
							);
						})
						.fail   (function()     { alert("Error")   ; })
						;
			</script>
			<script type="text/javascript">
			videoDataFormat();
			</script>



			
		</div>
	</div>
</body>
</html>