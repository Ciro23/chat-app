<?php

class UserModel extends Mvc\Model {

    /**
     * @var public $feedbackNegative, contains info to save when an error occurs
     */
    public $feedbackNegative;

    /**
     * perform the set username action
     * 
     * @return bool, success status
     */
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

    /**
     * checks if the username is valid
     * 
     * @param string $username
     * 
     * @return string|false, first on error, false otherwise
     */
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

        return false;
    }
}