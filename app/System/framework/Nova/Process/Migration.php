<?php

    namespace Lunaris\Framework\Nova\Process;

    use Lunaris\Framework\ORM\DB;

    use Exception;

    class Migration
    {
        private $path;
        private $args;

        public function __construct($path, $args) {
            $this->path = $path;
            $this->args = $args;
        }

        public function execute() {
            $path = $this->args[2];
            $filePath = $this->path . '/app/Migrations/' . $path . '.sql';
            $sql = file_get_contents($filePath);

            if ($sql === false) {
                throw new Exception("Error reading SQL file: $filePath");
            }

            $queries = explode(";", $sql);

            $pdo = DB::getPdo();

            foreach ($queries as $query) {
                $query = trim($query);
                if (!empty($query)) {
                    try {
                        $pdo->exec($query);
                        echo "Query executed successfully: $query\n";
                    } catch (PDOException $e) {
                        throw new Exception("Error executing query: " . $e->getMessage());
                    }
                }
            }
        }
    }