<?php

	if(!isset($_COOKIE['user_id'])){
	header('location: index.php');
} 
?>
<?php include __DIR__ . '/../config.php' ?>
<?php include __DIR__ . '/../vendor/autoload.php'; ?>
<!doctype html>
<html class="no-js" lang="en">
  <head>
  	<?php include __DIR__ . '/../head.php' ?>
  </head>
  <body>
	<?php include __DIR__ . '/../menu.php'; ?>
	<?php

	
if(!isset($_GET["page"])){
	$page=1;
}else{
	$page = $_GET["page"];
}
if($page==0){
	$page=1;
}

$npp = 2;


use plava\pagination;

$post = new pagination();

$post->con=$con;
$post->page=$page;
$post->npp=$npp;

use plava\updatePost;

$updatePost = new updatePost();
$updatePost->con=$con;
$updatePost->updatePost();

$data = $post->pagination('post','posts','where user = ' . $_COOKIE['user_id']);
$catch = $post->paginationCatch('*', 
							 'posts',
							 'where user = ' . $_COOKIE['user_id'],
							 'order by post_created desc');

$totalPages = $data->totalPages;

if($page==$totalPages+1){
	$page=$totalPages;
				}
					
?>	
	 <div class="row">
	<?php include 'user_nav.php' ?>	
	<br />
	<br />
		<div class="large-10 columns">

						
						<ul class="tabs" data-tabs id="example-tabs">
						  <li class="tabs-title is-active"><a href="#panel1" aria-selected="true">Posts</a></li>
						</ul>						
						<div class="tabs-content" data-tabs-content="example-tabs">
						  <div class="tabs-panel is-active" id="panel1">
						  	<?php foreach($catch->array as $post): ?>
						  <form method="post">
						  	<fieldset class="fieldset">
						  	<legend>Post created: <?php echo $post->post_created ?>
						  		<?php if(!empty($post->post_updated)){echo ' \ Post updated: ' . $post->post_updated;} ?>
						  	</legend>
                  			<textarea name="edit_post" cols="30" rows="7"><?php echo $post->post ?>
                 			</textarea>
                 			<input type="hidden" name="post_for_edit" value="<?php echo $post->post_id; ?>" />

                 			
                 			<input type="hidden" name="page" value="<?php echo $page; ?>" />
                 			<input type="submit" value="edit" />
                 			<input type="submit" value="delete" name="delete">
                 			</fieldset>
						</form>
						<?php endforeach; ?>					    
				</div>
			</div>		

			
						<div class="pagination-centered">
		<ul class="pagination">
			<li><a href="<?php echo 'MyPost'; ?>?page=1&amp;term=<?php echo $term;?>">First</a></li>
			<li class="arrow"><a href="<?php echo 'MyPost'; ?>?page=<?php echo $page-1; ?>">&laquo;</a></li>
			 <?php 
				for($i=1; $i<=$totalPages;$i++):
					if($i-5<=$page && $i+5>=$page):
					    ?>
					    <li <?php if($i==$page){ echo "class=\"current\""; } ?>>
					    	<a href="<?php echo 'MyPost'; ?>?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>					    
					    <?php endif; endfor;?>					   
					    <li class="arrow"><a href="<?php echo 'MyPost'; ?>?page=<?php echo $page+1; ?>">&raquo;</a></li>
					    <li ><a href="<?php echo 'MyPost'; ?>?page=<?php echo $totalPages; ?>">Last</a></li>
					  </ul>
			</div>		
		</div>
	</div>
	<?php include __DIR__ . '/../footer.php' ?>
	<?php include __DIR__ . '/../script.php' ?>    
  </body>
</html>