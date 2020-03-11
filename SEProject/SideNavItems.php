<?php
    
    for($i = 0 ; $i < count(unserialize($_SESSION['user'])->links) ; $i++){
        echo "<a href = ".unserialize($_SESSION['user'])->links[$i]->physicalAddress." class = 'list-group-item list-group-item-action bg-light'>
            ".unserialize($_SESSION['user'])->links[$i]->friendlyName."</a>";
    }
?>