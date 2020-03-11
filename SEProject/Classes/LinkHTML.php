<?php
class LinkHTML{
    public $ID;
    public $linkID;
    public $html;
    public $creationDate;
    public $lastUpdated;
    public $isDeleted;

    public function __construct($ID){
        if($ID != 0){
            $db = Database::getInstance();
            $result = $db->selectWhere("link_html", "ID=".$ID);

            if($result != NULL){
                $row = mysqli_fetch_array($result);
                $this->ID = $row['ID'];
                $this->linkID = new Link($row['LinkID']);
                $this->html = $row['HTML'];
                $this->creationDate = $row['CreationDate'];
                $this->lastUpdated = $row['LastUpdated'];
                $this->isDeleted = $row['IsDeleted'];
            }
        }
    }

    public static function add($l){
        $fields = array("ID","LinkID","HTML");
        $values = array($l->ID, $l->linkID, $l->html);
        $db = Database::getInstance();
        $db->insert("link_html", $fields, $values);
    }

    public static function update($l){
        $fields = array("ID","LinkID","HTML","LastUpdated");
        $values = array($l->ID, $l->linkID, $l->html, $l->lastUpdated);
        $db = Database::getInstance();
        $db->update("link_html", $fields, $values);
    }

    public static function delete($lID){
        $db = Database::getInstance();
        $db->delete("link_html", "ID =".$lID);
    }

    public static function view($condition){
        $db = Database::getInstance();
        $result = $db->selectWhere("link_html", $condition);
        $arr = array();
        $i = 0;
        if($result != NULL){
            while($row = mysqli_fetch_array($result))
            {
                $arr[$i] = new LinkHTML($row['ID']);
                $i++;
            }
            return $arr;
        }
        return NULL;
    }
}

?>