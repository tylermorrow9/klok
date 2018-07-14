<!-- The Modal -->
<div id="myModal" class="modal">
<form action="php/create_record.php" method="POST" onsubmit="return validateTeamModal()">
    <!-- Modal content -->
    <div class="modal-content">
        <div class="modal-header">
            <span class="close">&times;</span>
            <h2>Create New Team</h2>
        </div>
        <div class="modal-body">
            <table style="width:100%;">
                <tr>
                    <td>Team Name: </td>
                    <td><input type="text" placeholder="team name" id="teamName" name="teamName"></td>
                <tr>
                    <td>Team Parent: </td>
                    <td>
                        <select id="parentID" name="parentID">
                            <option value="">Please select...</option>
                        <?php
                            // Create connection
                            $conn = new mysqli($server, $user, $pass, $db);

                            $sql = "SELECT TEAM.ID, TEAM.NAME, PARENT.NAME AS PARENT_NAME FROM TEAM INNER JOIN TEAM AS PARENT ON TEAM.PARENT_ID = PARENT.ID WHERE TEAM.STATUS != -1 ORDER BY TEAM.ID ASC";
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
            <input class="button" type="submit" name="create_team">
        </div>
    </div>
</form>
</div>