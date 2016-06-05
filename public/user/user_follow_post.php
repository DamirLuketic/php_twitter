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
				

	 <div class="row">
	<?php include 'user_nav.php' ?>	
	<br />
	<br />
		<div class="large-10 columns">

						
<?php


if(!isset($_GET["page"])){
	$page=1;
}else{
	$page = $_GET["page"];
}
if($page==0){
	$page=1;
}

$npp = 3;

  
use plava\pagination;

$cat = new pagination();

$cat->con=$con;
$cat->page=$page;
$cat->npp=$npp;

$data = $cat->pagination('a.post',
						 'posts as a inner join users as b on a.user = b.user_id inner join follows as c on b.user_id = c.follow'
						,'where c.active = 1 and c.user = ' . $_COOKIE['user_id'],
						' order by a.post_created');
$catch = $cat->paginationCatch('b.nickname, a.post, a.post_created', 
							 'posts as a 
						  inner join users as b on a.user = b.user_id
						  inner join follows as c on b.user_id = c.follow',
						  'where c.active = 1 and c.user = ' . $_COOKIE['user_id'],
							 ' order by a.post_created desc');

$totalPages = $data->totalPages;

if($page==$totalPages+1){
	$page=$totalPages;
				}
					
?>					
<div class="row">
	<div class="callout">
		
		<table>
			<thead>
				<tr>
					<th>Date</th>
					<th>User</th>
					<th>Posts</th>
				</tr>
			</thead>
			<tbody>
	<?php

				
				foreach ($catch->array as $user){
					echo
						'<tr>
							<td>' . date('Y/m/d', strtotime($user->post_created)) . '<br />' .
							date('h/i/d', strtotime($user->post_created)) . '</td>
							<td>' . $user->nickname . '</td>
							<td>' . $user->post . '</td>
						</tr>';
					}
				
	?>
			</tbody>
			</table>

			
			<div class="pagination-centered">
		<ul class="pagination">
			<li><a href="<?php echo 'FollowPost'; ?>?page=1&amp;term=<?php echo $term;?>">First</a></li>
			<li class="arrow"><a href="<?php echo 'FollowPost'; ?>?page=<?php echo $page-1; ?>">&laquo;</a></li>
			 <?php 
				for($i=1; $i<=$totalPages;$i++):
					if($i-5<=$page && $i+5>=$page):
					    ?>
					    <li <?php if($i==$page){ echo "class=\"current\""; } ?>><a href="<?php echo 'FollowPost'; ?>?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>					    
					    <?php endif; endfor;?>					   
					    <li class="arrow"><a href="<?php echo 'FollowPost'; ?>?page=<?php echo $page+1; ?>">&raquo;</a></li>
					    <li ><a href="<?php echo 'FollowPost'; ?>?page=<?php echo $totalPages; ?>">Last</a></li>
					  </ul>
					</div>
		

	</div>
</div>
		</div>
	</div>
	<?php include __DIR__ . '/../footer.php' ?>
	<?php include __DIR__ . '/../script.php' ?>    
  </body>
</html>