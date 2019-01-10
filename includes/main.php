<span class="exitlk">Выход</span>

<div class="get-present">
	Получить приз!
</div>
<?php 
$listPresents = $Presents->myPresents();
?>
<div class="mypresents">
	<span class="mypresents-header">Мои подарки</span>
	<?php
	while($res = $listPresents->fetch()){
		?>
		<div class="mypresents-block">
			<?php
			echo "<div class='mypresents-inline'>".$res["typepresent"]."</div>";
			echo "<div class='mypresents-inline'>".$res["itogo"]."</div>";
			echo "<div class='mypresents-inline'>".$res["datepresent"]."</div>";
			if($res["typepresent"] == "Деньги"){
				echo "<div class='mypresents-inline converpoints' present='".$res["id"]."'>Перевести в баллы</div>";
			}
			echo "<div class='mypresents-inline cancelpresent' present='".$res["id"]."'>Откзаться</div>";
			?>
		</div>
		<?php
	}	
	?>
</div>

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
		$( ".get-present" ).click(function() {
			$.ajax({
			  type: "POST",
			  url: "/ajax/getpresent.php",
			  success: function(info){
				location.href = "/";
			  }
			});
		});
		$( ".converpoints" ).click(function() {
			$.ajax({
			  type: "POST",
			  data:"idPresents="+$(this).attr("present"),
			  url: "/ajax/converpoints.php",
			  success: function(info){
				location.href = "/";
			  }
			});
		});
		$( ".cancelpresent" ).click(function() {
			$.ajax({
			  type: "POST",
			  data:"idPresents="+$(this).attr("present"),
			  url: "/ajax/cancelpresent.php",
			  success: function(info){
				location.href = "/";
			  }
			});
		});
	</script>