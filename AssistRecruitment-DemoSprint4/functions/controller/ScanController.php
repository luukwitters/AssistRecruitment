<?php
    require_once '../functions/datalayer/ScanDB.php';
    require_once 'QuestionairController.php';


    Class ScanController {
        
        private $scanDB;   
    
        public function __construct(){
            $this->ScanDB = new ScanDB();
        }

        //dont delete - gemaakt door marfmans
        function addScan($name, $comment, $status, $introductiontext, $remindertext, $startdate, $enddate, $questionairID){
            $listScanAdd = $this->ScanDB->setScan($name, $comment, $status, $introductiontext, $remindertext, $startdate, $enddate, $questionairID);
            return $listScanAdd;
        }

        //Functie van Marfmans
        function fillScanAddSelect(){
            $QC = new QuestionairController();
            $lijstQuestionairs = array();
            $lijstQuestionairs = $QC->GetQuestionair();
            foreach ($lijstQuestionairs as $item) {
                echo "<option value=".$item->questionairID.">".$item->questionairName."</option>";
            }
        }

        // Getting all scans
        function getScans($statusScan){
            // Creating a array
            $listScans = array();

            $listScans = $this->ScanDB->getScans($statusScan);

            // Returning the list given from the Database class
            return $listScans;
        }  

        // Getting all scan from 1 customer
        function getScansCustomer($customerID, $statusScan){
            // Creating a array
            $listScans = array();

            $listScans = $this->ScanDB->getScansCustomer($customerID, $statusScan);

            // Returning the list given from the Database class
            return $listScans;
        }
        Function GetScan($scanID){
            $listScans = array();

            $listScans = $this->ScanDB->getScan($scanID);

            return $listScans;
        }

        function UpdateScan($scanID, $scanName, $scanComment, $scanStatus, $scanIntroductionText, $scanReminderText, $scanStartDate, $scanEndDate) {
            $this->ScanDB->EditScan($scanID, $scanName, $scanComment, $scanStatus, $scanIntroductionText, $scanReminderText, $scanStartDate, $scanEndDate);
        }

        // Getting all scans from 1 user
        function getScansUser($userID) {
            // Creating a array
            $listScans = array();

            $listScans = $this->ScanDB->getScansUser($userID);

            // Returning the list given from the Database class
            return $listScans;
        }

        // Function to archive scan
        function archiveScan($scanID) {
            $this->ScanDB->archiveScan($scanID);
        }

        // Function to delete scan
        function deleteScan($scanID) {
            $this->ScanDB->deleteScan($scanID);
        }

        // Function to get templates
        function getScanQuestionAir() {
            // Creating a array
            $listQuestionair = array();

            $listQuestionair = $this->ScanDB->getScanQuestionAir();

            // Returning the list given from the Database class
            return $listQuestionair;
        }

        // Getting the id of the autocomplete questionair
        function getQuestionairID($scanQuestionair) {
            $QuestionairID = $this->ScanDB->getQuestionairID($scanQuestionair);

            return $QuestionairID;
        }

        function GetAnswerScore() {
            // Creating a array
            $listScore = array();

            $listScore = $this->ScanDB->GetAnswerScore();

            // Returning the list given from the Database class
            return $listScore;
        }

        // Function to get scans for a department
        function getScansDepartment($departmentID) {
            // Creating a array
            $listScans = array();

            $listScans = $this->ScanDB->getScansDepartment($departmentID);

            // Returning the list given from the Database class
            return $listScans;
        }

        // Function to get the percentage of completed questions of a scan
        function getScanProgres($userID, $scanID) {
            $scanProgress = $this->ScanDB->getScanProgres($userID, $scanID);

            return $scanProgress;
        }

        // Function to get all question answers
        function getQuestionAnswers($questionID) {
            // Creating a array
            $listAnswers = array();

            $listAnswers = $this->ScanDB->getQuestionAnswers($questionID);

            // Returning the list given from the Database class
            return $listAnswers;
        }
    }
?>
