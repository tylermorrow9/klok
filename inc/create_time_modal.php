<!-- The Modal -->
<div id="myModal" class="modal">
<form action="php/create_record.php" method="POST" onsubmit="return validateTimeModal()">
    <!-- Modal content -->
    <div class="modal-content">
        <div class="modal-header">
            <span class="close">&times;</span>
            <h2>Create New User</h2>
        </div>
        <div class="modal-body">
            <table style="width:100%;">
                <tr>
                    <td>User: </td>
                    <td>
                        <select id="userID" name="userID">
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
                    <td>Check IN Date: </td>
                    <td>
                        <input type="date" id="checkInDate" name="checkInDate"> <input type="time" id="checkInTime" name="checkInTime">
                    </td>
                </tr>
                <tr>
                    <td>Check OUT Date: </td>
                    <td>
                        <input type="date" id="checkOutDate" name="checkOutDate"> <input type="time" id="checkOutTime" name="checkOutTime">
                    </td>
                </tr>
            </table>
        </div>
        <div class="modal-footer">
            <input class="button" type="submit" name="create_time">
        </div>
    </div>
</form>
</div>