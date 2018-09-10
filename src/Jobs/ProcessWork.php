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

    /**
     * Create a new job instance.
     *
     * @param Work  $work
     * @param array $data
     * @param array $entities
     */
    public function __construct(Work $work, array $data = [])
    {
        $this->work = $work;
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $work = $this->work;
        $payload = $work->payload;

        $worker = new $payload->class();
        $worker->execute($work, $payload, $this->data);
    }
}
