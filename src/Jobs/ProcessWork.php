<?php

namespace Railken\Amethyst\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Railken\Amethyst\Models\Work;

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
        $data = $this->data;

        $query = $work->data_builder->newInstanceQuery((array) $this->data);

        $work->data_builder->extract($query->get(), function ($resource, array $data) use ($work) {
            $data = array_merge($this->data, $data);

            $payload = $work->payload;

            $worker = new $payload->class();
            $worker->execute($work, $payload, $data);
        });
    }
}
