<?php
class Book extends Product implements iReport{
    public $ID;
    public $authorName;
    public $edition;
    public $productID;
    public $creationDate;
    public $lastUpdated;
    public $isDeleted;

    public function __construct($ID){
        if($ID != 0){
            $db = Database::getInstance();
            $result = $db->selectWhere("book", "ID=".$ID);

            if($result != NULL){
                $row = mysqli_fetch_array($result);
                parent::__construct($row['ProductID']);

                $this->ID = $row['ID'];
                $this->authorName = $row['AuthorName'];
                $this->edition = $row['Edition'];
                $this->productID = $row['ProductID'];
                $this->creationDate = $row['CreationDate'];
                $this->lastUpdated = $row['LastUpdated'];
                $this->isDeleted = $row['IsDeleted'];
            }
        }

    }

    public static function add($b){
        $fields = array("ID","AuthorName","Edition","ProductID");
        $values = array($b->ID, $b->authorName, $b->edition, $b->productID);
        $db = Database::getInstance();
        $db->insert("book", $fields, $values);
    }

    public static function update($b){
        $fields = array("ID","AuthorName","Edition","ProductID","LastUpdated");
        $values = array($b->ID, $b->authorName, $b->edition, $b->productID, $b->lastUpdated);
        $db = Database::getInstance();
        $db->update("book", $fields, $values);
    }

    public static function delete($bID){
        $db = Database::getInstance();
        $db->delete("book", "ID =".$bID);
    }

    public static function view($condition){
        $db = Database::getInstance();
        $result = $db->selectWhere("book", $condition);
        $arr = array();
        $i = 0;
        if($result != NULL){
            while($row = mysqli_fetch_array($result))
            {
                $arr[$i] = new Book($row['ID']);
                $i++;
            }
            return $arr;
        }
        return NULL;
    }

    public static function GenerateReport()
    {
        $db = Database::getInstance();        
        $booksObj=new Book(0);
        $books=$booksObj->view(1);

        echo '<script type="text/javascript">
        window.onload = function () {
        var chart = new CanvasJS.Chart("chartContainer", {
        title:{
        text: "Books Report"
        },
        data: [
        {
        type: "column",
        dataPoints: [';
        for($i = 0; $i < count($books); $i++)
        {
            $result = $db->Count("book", "AuthorName='".$books[$i]->authorName."'");
            if($result != NULL)
            {
                $row = mysqli_fetch_assoc($result);
            }
            echo '{label: "'.$books[$i]->authorName.'",  y: '.$row["Count(*)"].'},';
        }
        echo ']
        }
        ]
        });
        chart.render();
        }
        </script>';
        echo "<div id='chartContainer' style='height: 370px; width: 100%;'></div>";
    }
}

?>