<?php

class UserModel extends Mvc\Model {

    public $feedbackNegative;

    public function setUsername() {
        // extracts $username
        extract($_POST);

        // sanitises user input 
        $username = htmlspecialchars($username);

        // checks if the name is valid
        if ($error = $this->validateUsername($username)) {
            $this->feedbackNegative['error'] = $error;
            $this->feedbackNegative['username'] = $username;
            
            return false;
        }

        // sets the cookie with the name
        setcookie("username", $username, "Thu, 18 Dec 2023 12:00:00 UTC", "/");
        
        return true;
    }

    private function validateUsername($username) {
        if (empty($username)) {
            return "username-cannot-be-empty";
        }

        if (strlen($username) < 3) {
            return "username-must-be-longer-than-2-characters";
        }

        if (strlen($username) > 20) {
            return "username-must-be-shorter-than-20-characters";
        }

        if (preg_match("/[^A-Za-z0-9]/", $username)) {
            return "username-cannot-contains-special-characters";
        }

        return false;
    }
}