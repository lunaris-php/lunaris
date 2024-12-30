<?php

    namespace Module\Main;

    use App\Database\Models\Post;

    class MainController
    {
        public function home() {
            return view("home", [
                "args" => [
                    "message" => "This is a test message",
                    "isit" => true,
                    "number" => 10
                ]
            ]);
        }

        public function index() {
            return "This is the main module";
        }
    }