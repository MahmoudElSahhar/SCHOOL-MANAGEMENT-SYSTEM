<?php
ob_start();
include "Header.php";

$db = Database::getInstance();

$ID = $_GET['id'];

$result = $db->selectWhere("link_html", "ID=".$ID);

if($result != NULL)
{
    $row = mysqli_fetch_assoc($result);
    $content = $row['HTML'];
}
if(isset($_POST['submit']))
{
    $content2 = $_POST['editor'];
    $fields = array("ID","HTML");
    $values = array($ID, $content2);
    $db = Database::getInstance();
    $db->update("link_html", $fields, $values);
    header("Location: AboutUs.php");
}
?>

<!DOCTYPE html>
<html>
    <body>
        <br>
        <form method = "Post">
            <textarea id = "editor" name = "editor"><?php if(isset($content)) echo $content; ?></textarea>
            <script>
                ClassicEditor.create(document.querySelector("#editor"))
            </script>
            <br>
            <button class = "btn btn-success" type = "Submit" name = "submit">Submit</button>
            <br><br>
        </form>
        <?php
        include "Footer.php";
        ob_end_flush();
        ?>
    </body>
</html>