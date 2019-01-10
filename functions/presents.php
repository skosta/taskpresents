<?php
class Presents{

	public $connect_db = false;
	public $memberId = false;
	public $coefficient = 1.5;
	
	public function __construct(){				
		$sql = new sql();
		$this->connect_db = $sql->connect;
		
		$Member = new Member();
		$this->memberId = $Member->id;
	}
	
	public function getPresentRandom(){
		$ar[0] = "money";
		$ar[1] = "points";
		$ar[2] = "things";
		$random = rand(0,2);
		return $this->$ar[$random]();
	}
	
	
	//Денежный приз
	public function money(){
		$query = $this->connect_db->query("SELECT * FROM money"); // В этой таблице хранится ограниченное кол-во денег
		$info = $query->fetch();
		if($info["quantity"]<1){
			$this->points();
			return;
		}
		
		$random = rand(1,$info["quantity"]); //Получаем случайный денежный приз
		
		$this->insertPrsent("Деньги",$random);
		
		$idMoney = $info["id"];
		$newQuantity = $info["quantity"]-$random;
		$query = $this->connect_db->prepare("UPDATE money SET quantity=? WHERE id=?"); //Обновляем ограниченное кол-во денег
		$query->execute(array($newQuantity,$idMoney));
		
		return;
	}
	
	//Предметы
	public function things(){
		$maxthings = $this->connect_db->query("SELECT COUNT(*) as count FROM things")->fetchColumn(); //Получаем кол-во вещей, которое вообще есть				
		if($maxthings<1){
			$this->points();
			return;
		}
		
		$random = rand(1, $maxthings);
		
		$query = $this->connect_db->prepare("SELECT * FROM things WHERE id= ?");
		$query->execute(array($random));		
		$info = $query->fetch();
		$valueThings = $info["name"];
		
		$query = $this->connect_db->prepare("DELETE FROM things WHERE id= ?");
		$query->execute(array($random));	
		
		$this->insertPrsent("Вещи",$valueThings);
		
		return;
	}
	
	//Баллы
	public function points(){
		$random = rand(1, 150); //Получаем случайное кол-во баллов
		$this->insertPrsent("Баллы",$random);		
		return;
	}
	
	//Конвертация денежнего приза в баллы
	public function moneyConvertPoints($idPresent){
		$query = $this->connect_db->prepare("SELECT * FROM presents WHERE id=? AND typepresent=?");
		$query->execute(array($idPresent,"Деньги"));		
		$info = $query->fetch();
		$itogoPoints = $info["itogo"]*$this->coefficient;
		$query = $this->connect_db->prepare("UPDATE presents SET itogo=?,typepresent=? WHERE id=?"); 
		$query->execute(array($itogoPoints,"Баллы",$idPresent));
		return;
	}
	
	//Денежные призы пользователям
	public function sendMoney($random){			
		$query = $this->connect_db->query("SELECT * FROM members WHERE members.id not in (SELECT userid from presents)");
		while($res = $query->fetch()){
			if($res["id"]){
				$this->insertPrsent("Деньги",$random,$res["id"]);
			}
		}
		return;
	}
	
	public function insertPrsent($typePresent,$random,$userid){
		$regDate = date("d-m-Y");
		if(!$userid){
			$userid = $this->memberId;
		}
		$query = $this->connect_db->prepare("INSERT INTO presents (userid, typepresent, itogo, datepresent) VALUES (?,?,?,?)"); //Записываем приз в бд
		$query->execute(array($userid,$typePresent,$random,$regDate));
		return;
	}
	
	public function cancelPresent($idPresent){
		$query = $this->connect_db->prepare("DELETE FROM presents WHERE id= ?");
		$query->execute(array($idPresent));
		return;
	}
	
	//Вывод призов пользователя
	public function myPresents(){
		$query = $this->connect_db->prepare("SELECT * FROM presents WHERE userid=?");
		$query->execute(array($this->memberId));		
		return $query;		
	}
	
}
?>