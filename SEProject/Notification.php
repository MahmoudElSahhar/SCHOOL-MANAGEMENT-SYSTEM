<?php
include "Header.php";

echo "<br>
<table id = 'tbl' class = 'table table-stripped table-light'>
<thead>
<tr>
<th>Title</th>
<th>Content</th>
<th>Date</th>
</tr>
</thead>
<tbody>";

$db = Database::getInstance();
$result = $db->selectWhere("user_notifications", "ReceiverID=".unserialize($_SESSION["user"])->userID);

if($result != NULL)
{
    while($row = mysqli_fetch_array($result))
    {
        $result2 = $db->selectWhere("notifications", "ID=".$row["notificationID"]);
        
        while($row2 = mysqli_fetch_array($result2))
        {
            echo "<tr>
            <td>".$row2["Title"]."</td>
            <td>".$row2["Content"]."</td>
            <td>".$row2["Date"]."</td>
            </tr>";
        }
    }
}

echo "</tbody>
</table>
<br>";
echo "<script>
    $('#tbl').DataTable();
</script>";

include "Footer.php";
?>