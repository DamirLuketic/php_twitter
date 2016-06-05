<?php include 'config.php'; ?>
<?php include 'vendor/autoload.php'; ?>

<?php include 'root.php'; ?>

<!doctype html>
<html class="no-js" lang="en">
  <head>
  	<?php include 'head.php' ?>
  </head>
  <body>
<?php include 'menu.php'; ?>
<br />
<?php

if(!isset($_GET["page"])){
	$page=1;
}else{
	$page = $_GET["page"];
}
if($page==0){
	$page=1;
}

$npp = 4;

use plava\pagination;

$cat = new pagination();

$cat->con=$con;
$cat->page=$page;
$cat->npp=$npp;

$data = $cat->pagination('post','posts','' ,'order by post_created');
$catch = $cat->paginationCatch('a.nickname, b.post, b.post_created', 
							 'users as a inner join posts as b on a.user_id = b.user','',
							 'order by b.post_created desc');

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
			<li><a href="<?php echo $_SERVER["PHP_SELF"] ?>?page=1&amp;term=<?php echo $term;?>">First</a></li>
			<li class="arrow"><a href="<?php echo $_SERVER["PHP_SELF"] ?>?page=<?php echo $page-1; ?>">&laquo;</a></li>
			 <?php 
				for($i=1; $i<=$totalPages;$i++):
					if($i-5<=$page && $i+5>=$page):
					    ?>
					    <li <?php if($i==$page){ echo "class=\"current\""; } ?>><a href="<?php echo $_SERVER["PHP_SELF"] ?>?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>					    
					    <?php endif; endfor;?>					   
					    <li class="arrow"><a href="<?php echo $_SERVER["PHP_SELF"] ?>?page=<?php echo $page+1; ?>">&raquo;</a></li>
					    <li ><a href="<?php echo $_SERVER["PHP_SELF"] ?>?page=<?php echo $totalPages; ?>">Last</a></li>
					  </ul>
					</div>
		

	</div>
</div>
	<?php include 'footer.php' ?>
	<?php include 'script.php' ?>
  </body>
</html>

