<?php
	
namespace plava;

	class logout{
		
		var $con;	
	
   function logout(){

			setcookie('user_id','', 1);
			
			header('location: index.php');
			}
		}

?>