<?php
    require_once '../functions/datalayer/DepartmentDB.php';

    Class DepartmentController {
        
        private $departmentDB;   
    
        public function __construct() {
            $this->departmentDB = new DepartmentDB();
        }

        function getDepartments($statusDepartment) {
            // Creating a array
            $listDepartments = array();

            $listDepartments = $this->departmentDB->getDepartments($statusDepartment);

            // Returning the list given from the Database class
            return $listDepartments;
        }

        // Function to get all departments for 1 customer
        function getDepartmentsCustomer($customerID, $departmentStatus) {
            // Creating a array
            $listDepartments = array();

            $listDepartments = $this->departmentDB->getDepartmentsCustomer($customerID, $departmentStatus);

            // Returning the list given from the Database class
            return $listDepartments;
        }

        // Function to get all departments for 1 customer
        function getDepartmentUser($userID, $departmentStatus) {
            // Creating a array
            $listDepartments = array();

            $listDepartments = $this->departmentDB->getDepartmentsCustomer($userID, $departmentStatus);

            // Returning the list given from the Database class
            return $listDepartments;
        }

        function createDepartment($departmentName, $departmentComment, $customerID) {
            
            if($this->departmentDB->createDepartment($departmentName, $departmentComment, $customerID)){
                echo "Department succesfully added!";
            } else {
                echo "An error has occured.";
            }
        }

        // Funciton to get details of 1 department
        function getDetailsDepartment($departmentID) {
            // Creating a array
            $detailsDepartment = array();

            $detailsDepartment = $this->departmentDB->getDetailsDepartment($departmentID);

            // Returning the list given from the Database class
            return $detailsDepartment;
        }

        // Function to update the department
        function updateDepartment($departmentID, $departmentName, $departmentStatus, $departmentComment, $departmentCustomer) {
            // Sending the variables to the database and checking the result
            if($this->departmentDB->updateDepartment($departmentID, $departmentName, $departmentStatus, $departmentComment, $departmentCustomer)) {
                // Getting the current url
                $currentURL = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                $newURL = $currentURL . "&error=none";
                // Reloading page with succes message
                echo '<script>location.replace("'.$newURL.'");</script>';
            } else {
                // Getting the current url
                $currentURL = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                $newURL = $currentURL . "&error=1";
                // Reloading page with succes message
                echo '<script>location.replace("'.$newURL.'");</script>';
            }
        }

        // Function to archive department
        function archiveDepartment($departmentID) {
            $this->departmentDB->archiveDepartment($departmentID);
        }

        // Function to delete department
        function deleteDepartment($departmentID) {
            $this->departmentDB->deleteDepartment($departmentID);
        }

        // Function to add contact to department
        function addContactDepartment($contactID, $departmentID) {
            echo $contactID . " en " .$departmentID;
        }
    }
?>