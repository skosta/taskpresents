<?php
class Member{
	public $id = false;
	public $name = false;
	public $surname = false;
	public $email = false;
	public $password = false;
	public $phone = false;
	public $regDate = false;
	public $connect_db = false;
	
	public function __construct(){				
		$sql = new sql();
		$this->connect_db = $sql->connect;
		
		$query = $this->connect_db->prepare("SELECT * FROM members WHERE email= ? AND password= ?");
		$query->execute(array($_COOKIE['LoginMember'],$_COOKIE['PassMember']));
		$info = $query->fetch();
		
		$this->id = $info["id"];
		$this->name = $info["name"];
		$this->surname = $info["surname"];
		$this->email = $info["email"];
		$this->password = $info["password"];
		$this->phone = $info["phone"];
		$this->regDate = $info["regdate"];
	}
	
	
	//регистрация
	public function registration($newName,$newSurname,$newEmail,$newPassword,$newPhone){
		$errorMessage = false;
		$regDate = date("d-m-Y");
		$testEmailPass = Member::TestEmailPass($newEmail,$newPassword);
		if($testEmailPass){
			return $testEmailPass;
		}
		$newPassword = md5(md5($newPassword));
		
		//Проверка телефона
		if(!preg_match('#^[0-9]+$#',$newPhone) && $newPhone){
			$errorMessage = "В телефоне должны быть только цифры";
			return $errorMessage;
		}
		
		//Заносим в базу данных
		$query = $this->connect_db->prepare("INSERT INTO members (name, surname, phone, email, password, regdate) VALUES (?,?,?,?,?,?)");
		$query->execute(array($newName,$newSurname,$newPhone,$newEmail,$newPassword,$regDate));
		
		if($query){
			if(SetCookie("LoginMember",$newEmail,time()+3600, "/") && SetCookie("PassMember",$newPassword,time()+3600, "/")){
				return "Ok";
			}else{
				return "Ошибка установки Cookie";
			}			
		}else{
			$errorMessage = "Ошибка SQL";
			return $errorMessage;
		}
	}
	
	//Авторизация
	public function auth($newEmail,$newPassword){	
		$testEmailPass = Member::TestEmailPass($newEmail,$newPassword);
		if($testEmailPass){
			return $testEmailPass;
		}
		$newPassword = md5(md5($newPassword));
		$query = $this->connect_db->prepare("SELECT * FROM members WHERE email= ? AND password= ?");
		$query->execute(array($newEmail,$newPassword));
		$info = $query->fetch();
		
		if($query){
			if($info["id"]){
				if(SetCookie("LoginMember",$newEmail,time()+3600, "/") && SetCookie("PassMember",$newPassword,time()+3600, "/")){
					return "Ok";
				}else{
					return "Ошибка установки Cookie";
				}
			}else{
				return "Неправильный E-mail или пароль";
			}
		}else{
			return "Ошибка SQL";
		}
	}
	
	//Проверка Email и Пароля
	public function TestEmailPass($newEmail,$newPassword){
		$errorMessage = false;		
		
		//Test E-mail
		if(!preg_match("/^([a-zA-Z0-9])+([\.a-zA-Z0-9_-])*@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-]+)*\.([a-zA-Z]{2,6})$/", $newEmail)){
			$errorMessage = "Такого E-mail не существует";
		}
		
		//Test Password
		if(!preg_match("/^[A-Za-z0-9]+$/",$newPassword) || strlen($newPassword)<6){
			$errorMessage = "Пароль должен состоять из английских букв и должен содержать не менее 6 символов";
		}
		
		if(!$newEmail || !$newPassword){
			$errorMessage = "Обязательные поля не заполнены";
		}
		
		return $errorMessage;
	}
	
	//Выход
	public function DeleteCookie(){
		SetCookie("LoginMember","",time()-2419201, "/");
		SetCookie("PassMember","",time()-2419201, "/");
	}
}
?>