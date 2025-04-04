<?php

    namespace Module\Main;

    use Lunaris\Framework\Facades\Flash;
    use Lunaris\Framework\Facades\Storage;

    class MainController
    {
        public function home() {
            return view("welcome", [
                "args" => [
                    "message" => "This is a test message",
                    "series" => "Demon slayer",
                    "isit" => true,
                    "number" => 10
                ]
            ]);
        }

        public function about1() {

            Flash::make('success', [
                'This is a success message one.',
                'This is a success message two'
            ]);

            return "This is about page";
        }

        public function about() {
            $file = "demo.txt";

            if(Storage::has($file)) {
                Storage::delete($file);
                echo "File is there";
            } else {
                echo "File is not there";
            }
        }
    }