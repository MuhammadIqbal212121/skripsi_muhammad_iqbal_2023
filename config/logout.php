<?php 
session_start();
session_destroy();
 ?>
 <script>
     alert('Logout !');
	window.location = '../index.php';
	</script>