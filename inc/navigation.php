<div class="navbar">
	<a href="<?php echo 'dashboard.php?tok='.$_SESSION["sessionid"]; ?>">Home</a>
	<a href="<?php echo 'time.php?tok='.$_SESSION["sessionid"]; ?>">Time</a>
	<a href="<?php echo 'schedule.php?tok='.$_SESSION["sessionid"]; ?>">Schedule</a>
	<a href="<?php echo 'payroll.php?tok='.$_SESSION["sessionid"]; ?>">Payroll</a>
	<div class="dropdown">
		<a href="#" class="dropbtn">Account <i class="fa fa-caret-down"></i></a>
		<div class="dropdown-content">
			<a href="<?php echo 'account.php?tok='.$_SESSION["sessionid"]; ?>">Account</a>
			<a href="<?php echo 'teams.php?tok='.$_SESSION["sessionid"]; ?>">Teams</a>
			<a href="<?php echo 'users.php?tok='.$_SESSION["sessionid"]; ?>">Users</a>
		</div>
	</div>
	<div class="dropdown">
		<a href="#" class="dropbtn">Administration <i class="fa fa-caret-down"></i></a>
		<div class="dropdown-content">
			<a href="<?php echo 'administration.php?tok='.$_SESSION["sessionid"]; ?>">Administration</a>
			<a href="<?php echo 'data_manager.php?tok='.$_SESSION["sessionid"]; ?>">Data Manager</a>
			<a href="<?php echo 'configuration.php?tok='.$_SESSION["sessionid"]; ?>">Configuration</a>
			<a href="<?php echo 'maintenance.php?tok='.$_SESSION["sessionid"]; ?>">Maintenance</a>
			<a href="<?php echo 'logs.php?tok='.$_SESSION["sessionid"]; ?>">Logs</a>
		</div>
	</div>
	<a href="logout.php">Logout</a>
</div>
<ul class="breadcrumb">
	<li><a href="#">Home</a></li>
	<li><a href="#">Pictures</a></li>
	<li><a href="#">Summer 15</a></li>
	<li>Italy</li>
</ul>

<link rel="stylesheet" type="text/css" href="css/navigation.css">
