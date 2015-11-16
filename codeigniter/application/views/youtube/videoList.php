<p>Videos</p>

<?php 
	
foreach($likha_denge as $lakeer  ){ ?>
---------------------------------------
<p>
	<p> 
	<?php
		echo "<a target=\"_blank\" href=\"https://www.youtube.com/watch?v=".$lakeer['id']."\">";
		echo "<img src=\"".$lakeer['thumbnail_medium']."\" width=\"320px\" size=\"180px\" />";
		echo "<br/></a>";
	?>
	</p>
	<p> Title : <?php echo $lakeer['title'];   ?> </p>
	<p> Description : <?php echo $lakeer['description'];   ?> </p>
	<p> Likes : <?php echo $lakeer['likes'];   ?> </p>
	<p> Views : <?php echo $lakeer['views'];   ?> </p>
</p>
<?php
}
 ?>
