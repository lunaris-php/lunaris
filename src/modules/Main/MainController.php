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
            $posts = Post::query()->where('category', '=', 6)->orWhere('category', '=', 8);

            if($posts->count()) {
                print '<pre>';
                print_r($posts->get());
                print '</pre>';
            } else {
                echo "No Posts Found";
            }
        }
    }