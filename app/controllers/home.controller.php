<?php

class HomeController extends Mvc\Controller {

    /**
     * shows the chat page
     */
    public function index() {
        if (isset($_COOKIE['username'])) {
            $this->view("home");
        } else {
            header("Location: /set-username");
        }
    }
}