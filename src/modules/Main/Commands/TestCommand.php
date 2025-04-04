<?php

    namespace Module\Main\Commands;

    use Lunaris\Nova\Utils\Loggable;

    class TestCommand
    {
        use Loggable;

        private string $path;
        private array $args;

        public function __construct(string $path, array $args = []) {
            $this->path = $path;
            $this->args = $args;
        }

        public function execute(): void {
            $this->info("This is an info message");
            $this->success("This is a success message");
            $this->warning("This is a warning message");
            $this->error("This is an error message");
            print_r(fetchArgs($this->args));
        }
    }