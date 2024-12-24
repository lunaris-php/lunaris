<?php

    namespace Module\About;

    class AboutController
    {
        public function about() {
            return view("about", ['module' => 'About']);
        }
    }