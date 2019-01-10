<span class="exitlk">Выход</span>
<script>
		$( ".exitlk" ).click(function() {
			$.ajax({
			  type: "POST",
			  url: "/ajax/exit.php",
			  success: function(info){
				location.href = "/";
			  }
			});
		});
	</script>