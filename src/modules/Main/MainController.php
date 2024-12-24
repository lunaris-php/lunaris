<?php

    namespace Module\Main;

    class MainController
    {
        public function index() {
            return view("home", [
                "args" => [
                    "message" => "This is a test message",
                    "isit" => true,
                    "number" => 10
                ]
            ]);
        }
    }