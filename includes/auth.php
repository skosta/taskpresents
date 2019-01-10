<body>
	<div class="auth">
		<input type="email" class="mail" placeholder="Ваш электронный адрес"/>
		<input type="password" class="pass" placeholder="Пароль"/>
		<span class="okauth">Отпарвить</span>
		<span class="errormessage"></span>
		<a href="/registration/">Регистрация</a>
	</div>	
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