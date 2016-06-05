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


$term=isset($_POST["term"]) ? $_POST["term"] : (isset($_GET["term"]) ? $_GET["term"] : "");


if(!isset($_GET["page"])){
	$page=1;
}else{
	$page = $_GET["page"];
}
if($page==0){
	$page=1;
}

$npp = 5;


use plava\paginationTerm;

$cat = new paginationTerm();

$cat->con=$con;
$cat->term=$term;
$cat->page=$page;
$cat->npp=$npp;

$data = $cat->paginationTerm('user_id','users','nickname');
$catch = $cat->paginationCatch('a.nickname, max(b.post_created) as last_date, count(b.post) as posts, a.user_id, b.user',
							 'users as a left join posts as b on a.user_id = b.user',
							 'a.nickname','group by a.user_id');

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


			<h1>Users</h1>
			<form method="POST">
						<fieldset class="fieldset">
							<legend>
								Search
							</legend>
							<label for="term">Term</label>
							<input type="text" name="term" id="term" value="<?php echo $term; ?>" />
							<input type="submit" value="Search" class="button expanded" />
						</fieldset>
					</form>
			<table>
				<thead>
					<tr>
						<th>User</th>
						<th>Last post</th>
						<th>Posts</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					foreach ($catch->array as $exp){
						if($exp->user_id!=$_COOKIE['user_id']){
					echo
						'<tr>
							<td>' . $exp->nickname . '</td>
							<td>' . $exp->last_date . '</td>
							<td>' . $exp->posts . '</td>
							<td><a href="' . $path . 'userDetails?user_id=' . $exp->user_id . '">view</a></td></tr>';
						}
					}
					 ?>
				</tbody>
			</table>
			
				<!-- Izbornici za kretanje po stranicama -->
			
	<div class="pagination-centered">
		<ul class="pagination">
			<li><a href="<?php echo 'users'; ?>?page=1">First</a></li>
			<li class="arrow"><a href="<?php echo 'users'; ?>?page=<?php echo $page-1; ?>&amp;term=<?php echo $term;?>">&laquo;</a></li>
			 <?php 
				for($i=1; $i<=$totalPages;$i++):
					if($i-5<=$page && $i+5>=$page):
					    ?>
					    <li <?php if($i==$page){ echo "class=\"current\""; } ?>><a href="<?php echo 'users'; ?>?page=<?php echo $i; ?>&amp;term=<?php echo $term;?>"><?php echo $i; ?></a></li>					    
					    <?php endif; endfor;?>					   
					    <li class="arrow"><a href="<?php echo 'users'; ?>?page=<?php echo $page+1; ?>&amp;term=<?php echo $term;?>">&raquo;</a></li>
					    <li ><a href="<?php echo 'users'; ?>?page=<?php echo $totalPages; ?>&amp;term=<?php echo $term;?>">Last</a></li>
					  </ul>
					</div>	
		</div>
	</div>
	<?php include __DIR__ . '/../footer.php' ?>
	<?php include __DIR__ . '/../script.php' ?>    
  </body>
</html>
