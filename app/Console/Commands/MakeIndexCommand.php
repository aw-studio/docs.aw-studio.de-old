<?php

namespace App\Console\Commands;

use App\Docs\Documentor;
use App\Docs\Index\Indexer;
use App\Docs\Page;
use Illuminate\Console\Command;

class MakeIndexCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:index';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a fresh index of the documentation files.';

    /**
     * Documentor instance.
     *
     * @var Documentor
     */
    protected Documentor $documentor;

    /**
     * Indexer instance.
     *
     * @var Indexer
     */
    protected Indexer $indexer;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->documentor = app('docs');
        $this->indexer = new Indexer();

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->documentor->pages()
            ->filter(fn (Page $p) => ! str_contains($p->path(), 'readme.md'))
            ->each(fn (Page $p)   => $this->indexer->makeFor($p));

        return 0;
    }
}
