<?php

	namespace plava;	

	class uploadPictures{
		
		var $con;
		
	function uploadPictures(){

	  
      if(isset($_FILES['image_profile'])){
      $errors = '';
      $file_name = $_FILES['image_profile']['name'];
      $file_size =$_FILES['image_profile']['size'];
      $file_tmp =$_FILES['image_profile']['tmp_name'];
      $file_type=$_FILES['image_profile']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['image_profile']['name'])));

	  
      $expensions= array('jpeg','jpg','png','gif');
      
      if(in_array($file_ext,$expensions)=== false){
         $errors="extension not allowed, please choose a JPEG, JPG, PNG or GIF file.";
      }
      
      if($file_size > 2097152){
         $errors='File size must be less then 2 MB';
      }

	  
      if(empty($errors)==true){
      	 $dir = __DIR__ . '/../../user/img/' . $_COOKIE['user_id'] . '/profile/'; 	
         move_uploaded_file($file_tmp, $dir.$file_name);
         $_SESSION['check'] = "Success";

	        		
	  $update_profile_image = $this->con->prepare(' update images set profile_image = :profile_image where user =:user ');
	  $update_profile_image->execute(array(
	  									'user' 			=> $_COOKIE['user_id'],
	  									'profile_image' => $file_name
	  									));
	  			}else{
					$_SESSION['check'] = $errors;		
				}					
			}


	  if(isset($_FILES['image_cover'])){
      $errors = '';
      $file_name = $_FILES['image_cover']['name'];
      $file_size =$_FILES['image_cover']['size'];
      $file_tmp =$_FILES['image_cover']['tmp_name'];
      $file_type=$_FILES['image_cover']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['image_cover']['name'])));
      
      $expensions= array('jpeg','jpg','png','gif');
      
      if(in_array($file_ext,$expensions)=== false){
         $errors="extension not allowed, please choose a JPEG, JPG, PNG or GIF file.";
      }
      
      if($file_size > 2097152){
         $errors='File size must be less then 2 MB';
      }
      
      if(empty($errors)==true){
      	 $dir = __DIR__ . '/../../user/img/' . $_COOKIE['user_id'] . '/cover/'; 	  
         move_uploaded_file($file_tmp, $dir.$file_name);
         $_SESSION['check'] = "Success";
          		
	  $update_profile_image = $this->con->prepare(' update images set cover_image = :cover_image where user =:user ');
	  $update_profile_image->execute(array(
	  									'user' 			=> $_COOKIE['user_id'],
	  									'cover_image' 	=> $file_name
	  									));						
				include __DIR__ . '/../../head.php';										
				}else{
					$_SESSION['check'] = $errors;		
				}
			}
   		}
	}
?>
