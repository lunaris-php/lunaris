<?php

    namespace Module\Main\Commands;

    use Lunaris\Nova\Utils\Loggable;

    class ColoredCommand
    {
        use Loggable;

        private string $path;
        private array $args;

        public function __construct(string $path, array $args = []) {
            $this->path = $path;
            $this->args = $args;
        }

        public function execute(): void {
            // Write your command logic on execution
            // Use $args in your logic as needed
            $this->info("Command has been created");
        }
    }