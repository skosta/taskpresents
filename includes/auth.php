<body>
	<div class="auth">
		<input type="email" class="mail"/>
		<input type="password" class="pass"/>
		<span class="okauth">Отпарвить</span>
		<span class="errormessage"></span>
	</div>
	<a href="/registration/">Регистрация</a>
	<script>
		$( ".okauth" ).click(function() {
			var mail = $(".mail").val();
			var password = $(".password").val();
			$.ajax({
			  type: "POST",
			  url: "/ajax/auth.php",
			  crossDomain: true,
			  data: "mail="+mail+"&password="+password,
			  success: function(info){
				if(info == "Ok"){
					location.reload();
				}else{
					$(".errormessage").text(info);
				}
			  }
			});
		});
	</script>
</body>
</html>