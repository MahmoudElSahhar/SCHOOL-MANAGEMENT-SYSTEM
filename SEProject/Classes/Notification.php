<?php

class Notification implements iSubject{
    public $ID;
    public $title;
    public $content;
    public $date;
    public $senderID;
    public $observers; //array
    public $creationDate;
    public $lastUpdated;
    public $isDeleted;

    public function __construct($ID){
        if($ID != 0){
            $db = Database::getInstance();
            $result = $db->selectWhere("notifications", "ID=".$ID);

            if($result != NULL){
                $row = mysqli_fetch_array($result);
                $this->ID = $row['ID'];
                $this->title = $row['Title'];
                $this->content = $row['Content'];
                $this->date = $row['Date'];
                $this->senderID = $row['SenderID'];
                $this->observers = array();
                $this->creationDate = $row['CreationDate'];
                $this->lastUpdated = $row['LastUpdated'];
                $this->isDeleted = $row['IsDeleted'];
            }
        }
    }

    public static function add($l){
        $fields = array("ID","Title","Content","Date","SenderID");
        $values = array($l->ID, $l->title, $l->content, $l->date, $l->senderID);
        $db = Database::getInstance();
        $db->insert("notifications", $fields, $values);
    }

    public static function update($ly){
        $fields = array("ID","Title","Content","Date","SenderID","LastUpdated");
        $values = array($l->ID, $l->title, $l->content, $l->date, $l->senderID, $l->lastUpdated);
        $db = Database::getInstance();
        $db->update("notifications", $fields, $values);
    }

    public static function delete($lID){
        $db = Database::getInstance();
        $db->delete("notifications", "ID =".$lID);
    }

    public static function view($condition){
        $db = Database::getInstance();
        $result = $db->selectWhere("notifications", $condition);
        $arr = array();
        $i = 0;
        if($result != NULL){
            while($row = mysqli_fetch_array($result))
            {
                $arr[$i] = new Notification($row['ID']);
                $i++;
            }
            return $arr;
        }
        return NULL;
    }

    public function registerObserver($user){
        $this->observers[] = $user;
    }

    public function removeObserver($user){
        for($i=0;$i<count($this->observers);$i++)
        {
            if($this->observers[$i]->ID == $user->ID){
                array_splice($this->observers,$i,1);
            }
        }
    }

    public function notifyObservers($ID){
        for($i=0;$i<count($this->observers);$i++)
        {
            $this->observers[$i]->refresh($ID, $this->observers[$i]);
        }
    }

}

?>