<?php
class Borrowing{
    public $ID;
    public $studentID;
    public $bookID;
    public $borrowDate;
    public $returnDate;
    public $creationDate;
    public $lastUpdated;
    public $isDeleted;

    public function __construct($ID){
        if($ID != 0){
            $db = Database::getInstance();
            $result = $db->selectWhere("borrowing", "ID=".$ID);

            if($result != NULL){
                $row = mysqli_fetch_array($result);
                $this->ID = $row['ID'];
                $this->studentID = new Student($row['StudentID']);
                $this->bookID = new Book($row['BookID']);
                $this->borrowDate = $row['BorrowDate'];
                $this->returnDate = $row['ReturnDate'];
                $this->creationDate = $row['CreationDate'];
                $this->lastUpdated = $row['LastUpdated'];
                $this->isDeleted = $row['IsDeleted'];
            }
        }
    }

    public static function add($b){
        $fields = array("ID","StudentID","BookID","BorrowDate","ReturnDate");
        $values = array($b->ID, $b->studentID, $b->bookID, $b->borrowDate, $b->returnDate);
        $db = Database::getInstance();
        $db->insert("borrowing", $fields, $values);
    }

    public static function update($b){
        $fields = array("ID","StudentID","BookID","BorrowDate","ReturnDate","LastUpdated");
        $values = array($b->ID, $b->studentID, $b->bookID, $b->borrowDate, $b->returnDate, $b->lastUpdated);
        $db = Database::getInstance();
        $db->update("borrowing", $fields, $values);
    }

    public static function delete($bID){
        $db = Database::getInstance();
        $db->delete("borrowing", "ID =".$bID);
    }

    public static function view($condition){
        $db = Database::getInstance();
        $result = $db->selectWhere("borrowing", $condition);
        $arr = array();
        $i = 0;
        if($result != NULL){
            while($row = mysqli_fetch_array($result))
            {
                $arr[$i] = new Borrowing($row['ID']);
                $i++;
            }
            return $arr;
        }
        return NULL;
    }
}

?>