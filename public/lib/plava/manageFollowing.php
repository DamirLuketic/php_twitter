<?php

namespace plava;

	class manageFollowing{	

	var $con;
	
	function following(){

	$f = new \stdClass();	
		
$follow = $this->con->prepare(' select follow from follows where user = :user and follow = :follow and active = 1 ');
$follow->execute(array(
					'user' 	 => $_COOKIE['user_id'],
					'follow' => $_GET['user_id']
					)); 
$follow = $follow->fetch(\PDO::FETCH_OBJ);	

	$f->follow = $follow;
	
	return $f;
		
	}
	

   function addFollowing(){

if(isset($_POST['user_id_a']) && !empty($_POST['user_id_a'])){
	
	
$add = $this->con->prepare(' insert into follows (user, follow, follow_created) values 
						 	 (:user, :follow, now())
							');

$add->execute(array(
			'user'    => $_COOKIE['user_id'],
			'follow'  => $_POST['user_id_a'],
));
	
header('location = user/user_people.php ');
					
				}
			}
   
   	  function removeFollowing(){


if(isset($_POST['user_id_r']) && !empty($_POST['user_id_r'])){  
   
$remove = $this->con->prepare(' update follows set active = 0, follow_deleted = now()
								where follow = :follow and user = :user');
$remove->execute(array(
			'user'      	 => $_COOKIE['user_id'],
			'follow'  	  	 => $_POST['user_id_r']
				));
	
header('location = user/user_people.php');     
			}
	  	}
	}
?>