<?php

class UserController extends Mvc\Controller {

    /**
     * shows the set username page
     */
    public function index() {
        if (isset($_COOKIE['username'])) {
            header("Location: /");
        } else {
            $this->view("setusername");
        }
    }

    /**
     * the set username action
     */
    public function setUsername() {
        $userModel = $this->model("user");

        if ($userModel->setUsername()) {
            header("Location: /");
        } else {
            header("Location: /set-username?error=" . $userModel->feedbackNegative['error'] . "&username=" . $userModel->feedbackNegative['username']);
        }
    }
}