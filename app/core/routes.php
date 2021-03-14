<?php

// creates custom routes
$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {

    // homepage route
    $r->addRoute("GET", "/", "HomeController/index");
    
    // choose name route
    $r->addRoute("GET", "/{set-username}[/[?{error}]]", "UserController/index");

    // set name route
    $r->addRoute("POST", "/set-username/action[/]", "UserController/setUsername");
});