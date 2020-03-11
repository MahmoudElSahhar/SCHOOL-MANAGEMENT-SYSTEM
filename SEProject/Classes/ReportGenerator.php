<?php
class ReportGenerator
{
    public $ChartGenerate;

    public function __construct(iReport $ChartGenerate)
    {
        $this->ChartGenerate=$ChartGenerate;
    }

    public function DrawDesiredReport()
    {
        $this->ChartGenerate->GenerateReport();
    }



public static function ReportGeneratorSelector($DesiredObjectForReport)
{
    $facade=new Facade();
    
    if($DesiredObjectForReport=="AcademicYear")
    {
        $SelectedObject=$facade->AcademicYear;
    }
    else if($DesiredObjectForReport=="Book")
    {
        $SelectedObject=$facade->Book;
    }

    return $SelectedObject;
}

}


?>