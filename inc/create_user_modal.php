<!-- The Modal -->
<div id="myModal" class="modal">
<form action="php/create_record.php" method="POST" onsubmit="return validateUserModal()">
    <!-- Modal content -->
    <div class="modal-content">
        <div class="modal-header">
            <span class="close">&times;</span>
            <h2>Create New User</h2>
        </div>
        <div class="modal-body">
            <table style="width:100%;">
                <tr>
                    <td>Username: </td>
                    <td><input type="text" placeholder="username" id="username" name="username"></td>
                <tr>
                    <td>Manager: </td>
                    <td>
                        <select id="managerID" name="managerID">
                            <option value="">Please select...</option>
                        <?php
                            // Create connection
                            $conn = new mysqli($server, $user, $pass, $db);

                            $sql = "SELECT ID, FIRST_NAME, LAST_NAME FROM CONTACT WHERE STATUS != -1 ORDER BY ID ASC";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    echo "<option value='".$row["ID"]."'>".$row["FIRST_NAME"]." ".$row["LAST_NAME"]."</option>";
                                }
                            } else {
                                echo "0 results";
                            }
                            $conn->close();
                        ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Team: </td>
                    <td>
                        <select id="teamID" name="teamID">
                            <option value="">Please select...</option>
                        <?php
                            // Create connection
                            $conn = new mysqli($server, $user, $pass, $db);

                            $sql = "SELECT TEAM.ID, TEAM.NAME, PARENT.NAME AS PARENT_NAME FROM TEAM INNER JOIN TEAM AS PARENT ON TEAM.PARENT_ID = PARENT.ID WHERE TEAM.STATUS = 1 ORDER BY TEAM.ID ASC";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    if ($row["NAME"] == $row["PARENT_NAME"]) {
                                        echo "<option value='".$row["ID"]."'>".$row["NAME"]."</option>";
                                    } else {
                                        echo "<option value='".$row["ID"]."'>".$row["PARENT_NAME"]." > ".$row["NAME"]."</option>";
                                    }
                                }
                            } else {
                                echo "0 results";
                            }
                            $conn->close();
                        ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>First Name: </td>
                    <td><input type="text" placeholder="first name" id="firstName" name="firstName"></td>
                </tr>
                <tr>
                    <td>Last Name: </td>
                    <td><input type="text" placeholder="last name" id="lastName" name="lastName"></td>
                </tr>
                <tr>
                    <td>Email Address: </td>
                    <td><input type="text" placeholder="email address" id="emailAddress" name="emailAddress"></td>
                </tr>
                <tr>
                    <td>Primary Phone: </td>
                    <td><input type="number" placeholder="primary phone number" id="primaryPhone" name="primaryPhone"></td>
                </tr>
                <tr>
                    <td>Alternate Phone: </td>
                    <td><input type="number" placeholder="alternate phone number" id="alternatePhone" name="alternatePhone"></td>
                </tr>
                <tr>
                    <td>Locale</td>
                    <td>
                        <select id="locale" name="locale">
                            <option value="">Please select...</option>
                            <option value="est">EST</option>
                            <option value="pst">PST</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Status: </td>
                    <td>
                        <select id="statusID" name="statusID">
                            <option value="">Please select...</option>
                            <option value="1">Enabled</option>
                            <option value="0">Disabled</option>
                        </select>
                    </td>
                </tr>
            </table>
        </div>
        <div class="modal-footer">
            <input class="button" type="submit" name="create_user">
        </div>
    </div>
</form>
</div>