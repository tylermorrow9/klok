<?php 
	require("inc/header.php");
?>

<body>

<?php require("html/header.html"); ?>
<script src="js/validate_login.js"></script>

<div class="topnav">
  <a href="#"></a>
</div>

<div class="row">
	<div class="leftcolumn">
	    <div class="card">
			<h2>Please login</h2>
			<p>Username: <input type="text" placeholder="username" id="username_text" name="username_text" /> <a href="#">Forgot Username</a></p>
			<p>Password: <input type="password" placeholder="password" id="password_text" name="password_text" /> <a href="#">Forgot Password</a></p>
			<p><button onClick="validateForm();">Login</button></p>
	    </div>
	</div>
	<div class="rightcolumn">
	    <div class="card">
			<h2>KLOK Time Tracking, Scheduling, and Payroll System</h2>
			<img class="fakeimg" src="img/cat.jpg"/>
	    </div>
  </div>
</div>

<?php require("html/footer.html"); ?>
</body>
</html>