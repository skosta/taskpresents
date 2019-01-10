<body>
	<div class="auth">
		<input type="email" class="mail" placeholder="E-mail"/>
		<input type="password" class="pass" placeholder="Пароль"/>		
		<input type="text" class="name" placeholder="Имя"/>
		<input type="text" class="surname" placeholder="Фамилия"/>
		<input type="text" class="phone" placeholder="Телефон"/>
		<span class="okreg">Отправить</span>
		<span class="errormessage"></span>
		<a href="/auth/">Авторизация</a>
	</div>
	
	
	<script>
		$( ".okreg" ).click(function() {
			var mail = $(".mail").val();
			var password = $(".password").val();
			var name = $(".name").val();
			var surname = $(".surname").val();
			var phone = $(".phone").val();
			$.ajax({
			  type: "POST",
			  url: "/ajax/registration.php",
			  data: "mail="+mail+"&password="+password+"&name="+name+"&surname="+surname+"&phone="+phone,
			  success: function(info){
				if(info == "Ok"){
					location.href = "/";
				}else{
					$(".errormessage").text(info);
				}
			  }
			});
		});
	</script>
</body>
</html>