<?php
    require_once '../functions/datalayer/CustomerDB.php';

    Class CustomerController {
        
        private $customerDB;   
    
        public function __construct() {
            //maakt een nieuwe connectie 
            $this->customerDB = new CustomerDB();
        }

        function getCustomers($status) {
            // Array aanmaken voor de functies
            $listCustomers = $this->customerDB->getCustomers($status);

            // Returning the list given from the Database class
            return $listCustomers;
        }

        function deleteCustomers($customerID){
            $this->customerDB->deleteCustomer($customerID);
        }
        
        //This function creates a new customer using the values obtained from the customerDatabase (createCustomer) function.
        //Also gives an echo as feedback to assure the user that the statement has succesfully been executed or not.
        function createCustomer($customerName, $customerComment, $customerReference) {
            if($this->customerDB->createCustomer($customerName, $customerComment, $customerReference)){
                // Getting the current url
                $currentURL = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                $newURL = $currentURL . "?error=none";
                // Reloading page with succes message
                echo '<script>location.replace("'.$newURL.'");</script>';
            } else {
               // Getting the current url
               $currentURL = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
               $newURL = $currentURL . "?error=1";
               // Reloading page with succes message
               echo '<script>location.replace("'.$newURL.'");</script>';
           }
        }

        // Function to get the details of a customer
        function getCustomerDetails($customerID) {
            $detailsCustomer = array();

            $detailsCustomer = $this->customerDB->getCustomerDetails($customerID);

            // Returning the list given from the Database class
            return $detailsCustomer;
        }

        // Function to update the customer
        function updateCustomer($customerID, $customerName, $customerReference, $customerComment, $customerStatus, $exitWindow) {
            // Sending the variables to the database and checking the result
            if($this->customerDB->updateCustomer($customerID, $customerName, $customerReference, $customerComment, $customerStatus)) {
                 // Checking if user want to leave customer edit
                 if ($exitWindow == 1) {
                    // Sending user to customer listed
                    echo '<script>location.assign("customer_list");</script>';
                } else {
                    // Getting the current url
                    $currentURL = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                    $newURL = $currentURL . "?error=none";
                    // Reloading page with succes message
                    echo '<script>location.replace("'.$newURL.'");</script>';
                }
            } else {
                // Getting the current url
                $currentURL = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                $newURL = $currentURL . "&error=1";
                // Reloading page with succes message
                echo '<script>location.replace("'.$newURL.'");</script>';
            }
        }
    }
?>
