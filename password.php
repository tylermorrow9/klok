<?php 
	#include header here
	require("inc/header.php");
	require("inc/session.php");
	#set properties
	require("properties.php");
	#include encryption device
	require("php/encryption.php");
	require("inc/decrypt_db_creds.php");

	$userID = $_GET['userrecord'];
	$userName = $_GET['username'];
?>

<body>
<?php require("html/header.html"); ?>
<?php include("inc/navigation.php"); ?>

<div class="row">
	<div style="width:100%;">
		<div class="card">
			<h2>Reset Password</h2>
				<table style="width:25%;">
					<tr>
						<td><label>Current username: </label></td>
						<td><input readonly type="text" id="username_text" value="<?php echo $userName; ?>"></td>
					</tr>
					<tr>
						<td><label>Set Password: </label></td>
						<td><input type="text" id="password_text"></td>
					</tr>
					<tr>
						<td><button class="button" onClick="encryptPass();">Generate</button><button class="button" onClick="submitPassChange();">Submit</button><button class="button" onClick="window.history.back()">Cancel</button></td>
						<td><input type="hidden" id="enc_password_text"><input type="hidden" id="userid" value="<?php echo $_GET['userrecord'] ?>"></td>
					</tr>
				</table>
			</form>
		</div>
	</div>
</div>

<script src="js/password_encryption.js"></script>
<?php require("html/footer.html");?>
</body>
</html>
