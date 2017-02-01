<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class FixPHPStandardCommand extends Command
{
    protected $signature = 'lemon:psr2 {path} {--scan}';

    protected $description = 'Fix standard PSR2 in Lemon CMS';

    public function handle()
    {
        $scan = $this->option('scan');
        $path = $this->argument('path');

        if ($scan) {
            $process = new Process('php ' . base_path() . '/vendor/bin/phpcs ' . $path . ' --standard=PSR2');
        } else {
            $process = new Process('php ' . base_path() . '/vendor/bin/phpcbf ' . $path . ' --standard=PSR2');
        }

        $process->run();

        $this->info($process->getOutput());
    }
}
