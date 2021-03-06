<div class="navbar">
	<a href="<?php echo 'dashboard.php?tok='.$_SESSION["sessiontoken"]; ?>">Home</a>
	<?php if ($TIME_MODULE_ACCESS) {?>
	<a href="<?php echo 'time.php?tok='.$_SESSION["sessiontoken"]; ?>">Time</a>
	<?php } if ($SCHEDULE_MODULE_ACCESS) {?>
	<a href="<?php echo 'schedule.php?tok='.$_SESSION["sessiontoken"]; ?>">Schedule</a>
	<?php } if ($PAYROLL_MODULE_ACCESS) {?>
	<a href="<?php echo 'payroll.php?tok='.$_SESSION["sessiontoken"]; ?>">Payroll</a>
	<?php } ?>
	<div class="dropdown">
	<button class="dropbtn">Structure</button>
		<div class="dropdown-content">
			<a href="<?php echo 'approval.php?tok='.$_SESSION["sessiontoken"]; ?>">Approvals</a>
			<a href="<?php echo 'teams.php?tok='.$_SESSION["sessiontoken"]; ?>">Teams</a>
			<a href="<?php echo 'users.php?tok='.$_SESSION["sessiontoken"]; ?>">Users</a>
		</div>
	</div>
	<div class="dropdown">
	<button class="dropbtn">Administration</button>
		<div class="dropdown-content">
			<a href="<?php echo 'administration.php?tok='.$_SESSION["sessiontoken"]; ?>">Administration</a>
			<a href="<?php echo 'data_manager.php?tok='.$_SESSION["sessiontoken"]; ?>">Data Manager</a>
			<a href="<?php echo 'configuration.php?tok='.$_SESSION["sessiontoken"]; ?>">Configuration</a>
			<a href="<?php echo 'maintenance.php?tok='.$_SESSION["sessiontoken"]; ?>">Maintenance</a>
			<a href="<?php echo 'logs.php?tok='.$_SESSION["sessiontoken"]; ?>">Logs</a>
		</div>
	</div>
	<div class="dropdown" style="float:right;">
	<button class="dropbtn">Details</button>
		<div class="dropdown-content">
			<a href="<?php echo 'version.html' ?>" target="_blank">About</a>
			<a href="<?php echo 'account.php?tok='.$_SESSION["sessiontoken"]; ?>">My Info</a>
			<a href="logout.php">Logout</a>
		</div>
	</div>
</div>