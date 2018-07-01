<div class="navbar">
	<a href="<?php echo 'dashboard.php?tok='.$_SESSION["sessiontoken"]; ?>">Home</a>
	<a href="<?php echo 'time.php?tok='.$_SESSION["sessiontoken"]; ?>">Time</a>
	<a href="<?php echo 'schedule.php?tok='.$_SESSION["sessiontoken"]; ?>">Schedule</a>
	<a href="<?php echo 'payroll.php?tok='.$_SESSION["sessiontoken"]; ?>">Payroll</a>
	<div class="dropdown">
		<button class="dropbtn">Account <i class="fa fa-caret-down"></i></button>
		<div class="dropdown-content">
			<a href="<?php echo 'account.php?tok='.$_SESSION["sessiontoken"]; ?>">Account</a>
			<a href="<?php echo 'teams.php?tok='.$_SESSION["sessiontoken"]; ?>">Teams</a>
			<a href="<?php echo 'users.php?tok='.$_SESSION["sessiontoken"]; ?>">Users</a>
		</div>
	</div>
	<div class="dropdown">
		<button class="dropbtn">Administration <i class="fa fa-caret-down"></i></button>
		<div class="dropdown-content">
			<a href="<?php echo 'administration.php?tok='.$_SESSION["sessiontoken"]; ?>">Administration</a>
			<a href="<?php echo 'data_manager.php?tok='.$_SESSION["sessiontoken"]; ?>">Data Manager</a>
			<a href="<?php echo 'configuration.php?tok='.$_SESSION["sessiontoken"]; ?>">Configuration</a>
			<a href="<?php echo 'maintenance.php?tok='.$_SESSION["sessiontoken"]; ?>">Maintenance</a>
			<a href="<?php echo 'logs.php?tok='.$_SESSION["sessiontoken"]; ?>">Logs</a>
		</div>
	</div>
	<a href="logout.php">Logout</a>
</div>

<link rel="stylesheet" type="text/css" href="css/navigation.css">
