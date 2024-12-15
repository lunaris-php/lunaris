<?php

    namespace App\Controllers;

    use Lunaris\Framework\ORM\DB;

    use Exception;

    use App\Models\Post;

    class StartController {
        public function home1() {
            $posts = Post::all();

            if($posts) {
                foreach($posts as $post) {
                    print $post->title . '<br/>';
                }
            }

            // print '<pre>';
            // print_r($posts);
            // print '</pre>';
        }

        public function home2() {
            $post = Post::find(7);

            if($post) {
                print '<pre>';
                print_r($post);
                print '</pre>';
            }
        }

        public function home3() {
            Post::delete(6);

            echo "deleted";
        }

        public function home() {
            $posts = Post::query()->where('category', '=', 6)->orWhere('category', '=', 8);

            if($posts->count()) {
                print '<pre>';
                print_r($posts->get());
                print '</pre>';
            } else {
                echo "No Posts Found";
            }
        }

        public function hom4() {
            DB::beginTransaction();

            try {
                $data = [
                    'category' => 10,
                    'type' => 'post',
                    'title' => 'A Simple Test Post',
                    'tags' => 'Test, Little',
                    'slug' => 'simple-test-post-1'
                ];

                Post::save($data);

                throw new Exception("Error initiated");

                $data1 = [
                    'category' => 9,
                    'type' => 'post',
                    'title' => 'A Simple Test Post',
                    'tags' => 'Test, Little',
                    'slug' => 'simple-test-post-2'
                ];

                Post::save($data1);

                DB::commit();

                echo "SUccessfully added";
            } catch(Exception $e) {
                DB::rollBack();
                echo "Transaction rolled back due to error: " . $e->getMessage() . "\n";
            }
        }

        public function home6() {
            // echo getenv("TEST_VARIABLE");
            // var_dump($_ENV, getenv());
            echo $_ENV['TEST_VARIABLE'];
        }
    }