<body>
	<div class="auth">
		<label>E-mail</label>
		<input type="email" class="mail"/>
		<label>Пароль</label>
		<input type="password" class="pass"/>		
		<label>Имя</label>
		<input type="text" class="name"/>
		<label>Фамилия</label>
		<input type="text" class="surname"/>
		<label>Телефон</label>
		<input type="text" class="phone"/>
		<span class="okreg">Отправить</span>
		<span class="errormessage"></span>
	</div>
	<a href="/auth/">Авторизация</a>
	
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