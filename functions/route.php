<?php
class Route
{
	static function start()
	{
		$file = "./includes/main.php";
		$routes = explode('/', $_SERVER['REQUEST_URI']);
		if (!empty($routes[1])){	
			$file = "./includes/".$routes[1].".php";
		}
		
		if(file_exists($file)){
			$Member = new Member();		
			require_once "./includes/header.php";			
			if($Member->id){
				require_once $file;
			}elseif($routes[1] == "registration"){
				require_once "./includes/registration.php";
			}else{
				require_once "./includes/auth.php";
			}
		}else{
			Route::ErrorPage404();
		}
	}
	
	function ErrorPage404()
	{
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
		header("Status: 404 Not Found");
		header('Location:'.$host.'404');
	}
}
?>