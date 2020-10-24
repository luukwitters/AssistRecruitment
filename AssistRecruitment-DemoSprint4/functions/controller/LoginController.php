<?php
require '../functions/datalayer/LoginDatabase.php';
require '../functions/mailHelper/Mailer.php';

class LoginController {
    private $ldb;
    private $mailHelper;

    public function __construct() {
        $this->ldb = new LoginDatabase();
        $this->mailHelper = new Mailer();
    }

    public function createUser($username, $password, $email) {
        $hash = password_hash($password, PASSWORD_DEFAULT);

        if($this->ldb->createUser($username, $hash, $email)) {
            echo "afgeklapt";
        } else {
            echo "Het lijkt er op dat dit account al bestaat";
        }
    }

    public function logIn($username, $password) {
        $user = $this->ldb->getUser($username);

        if(!is_null($user) && $user->getUserPassword() != null){
            if($username == $user->getUsername() && password_verify($password, $user->getUserPassword())) {
                header("Location: menu.php");
            } else {
                echo "Credentials zijn onjuist";
            }
        } else {
            echo "Er ging iets mis";
        }
    }

    //TODO: Fix this broken functionality
    public function forgotPassword($email) {
        $user = $this->ldb->getUserByEmail($email);

        if(!is_null($user)) {
            $token = uniqid(mt_rand(), true);
            $this->mailHelper->forgotPassword($email, $token);
        } else {
            echo "Het lijkt er op dat er is mis ging.";
        }
    }

    // Function to logg of
    function userLogOff() {
        // Getting the session and destroying it
        session_start();

        session_unset();
        session_destroy();

        // Sending user to login page
        header("Location: loginScreen");
    }

}