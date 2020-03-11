<!DOCTYPE html>
<html>
    <body>
        <?php
        include "Header.php";

        echo "<img src = 'Images/School.jpg' height = '500' width = '100%'>";
        
        $db = Database::getInstance();
        
        $result = $db->selectWhere("link_html", "LinkID=56");
        
        if($result != NULL)
        {
            $row = mysqli_fetch_assoc($result);
            echo "<div class = 'About_Us_Body'>";
            echo $row["HTML"];
            echo '<a href = "ckeditor.php?id='.$row['ID'].'"><i class = "fa fa-2x fa-edit"></i></a>';
            echo "</div>";
            echo "<br>";
        }
        include "Footer.php";
        ?>
    </body>
</html>