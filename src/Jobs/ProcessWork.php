<?php

namespace Railken\LaraOre\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Railken\LaraOre\Work\Work;

class ProcessWork implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $work;
    protected $data;
    protected $entities;

    /**
     * Create a new job instance.
     *
     * @param Work  $work
     * @param array $data
     * @param array $entities
     */
    public function __construct(Work $work, array $data = [], array $entities = [])
    {
        $this->work = $work;
        $this->data = $data;
        $this->entities = $entities;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $work = $this->work;
        $worker = new $work->worker();
        $worker->execute($work, $this->data, $this->entities);
        // $worker->log();
    }
}
