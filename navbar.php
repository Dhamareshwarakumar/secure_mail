<nav class="navbar navbar-expand-sm sticky-top navbar-light bg-dark" style="height:9vh">
	<a class="navbar-brand" href="./index.php">
		<img src="#" alt=" " width="30" height="30" class="d-inline-block align-top"/><span class="text-white d-inline-block align-top">Capstone</span>
	</a>

	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse mr-auto" id="navbarSupportedContent">
		<div class="navbar-nav">
			<a class="nav-item nav-link text-white" href="./index.php">Home</a>
			<?php if(isset($_SESSION["user"])) {
				echo'
					<a class="nav-item nav-link text-white" href="./inbox.php">inbox</a>
					<a class="nav-item nav-link text-white" href="./sent.php">sentbox</a>
					<a class="nav-item nav-link text-white" href="./new.php">send message</a>
					<a class="nav-item nav-link text-white" href="./users.php">Users List</a>
				';
			}?>
		</div>
		<div class="ml-auto">
			<?php if(isset($_SESSION["user"])) {
				echo '<a href="./includes/logout.php"><button class="btn btn-outline-success" type="button">Logout</button></a>';
			}
			else {
				echo '<a href="./login.php"><button class="btn btn-outline-success" type="button">Login</button></a>';
			}
			?>
							
		</div>
	</div>
</nav>
