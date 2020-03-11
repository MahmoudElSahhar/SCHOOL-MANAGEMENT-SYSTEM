<?php
class Log{
    public $ID;
    public $TableName;
    public $Action;
    public $creationDate;

    public function __construct($ID){
        if($ID != 0){
            $db = Database::getInstance();
            $result = $db->selectWhere_NoIsDeleted("log", "ID=".$ID);

            if($result != NULL){
                $row = mysqli_fetch_array($result);
                $this->ID = $row['ID'];
                $this->TableName = $row['TableName'];
                $this->Action = $row['Action'];
                $this->creationDate = $row['CreationDate'];
            }
        }
    }

    public static function view($condition){
        $db = Database::getInstance();
        $result = $db->selectWhere_NoIsDeleted("log", $condition);
        $arr = array();
        $i = 0;
        if($result != NULL){
            while($row = mysqli_fetch_array($result))
            {
                $arr[$i] = new Log($row['ID']);
                $i++;
            }
            return $arr;
        }
        return NULL;
    }
}

?>