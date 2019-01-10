<?php

namespace Railken\Amethyst\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Railken\Amethyst\Models\Work;
use Railken\Template\Generators;
use Symfony\Component\Yaml\Yaml;

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

        $generator = new Generators\TextGenerator();

        $callback = function ($resource, array $data) use ($work, $generator) {
            $data = array_merge($this->data, $data);
            $data = array_merge($data, (array) Yaml::parse($generator->generateAndRender($work->data, $data)));

            $payload = json_decode(json_encode(Yaml::parse($work->payload)));

            $worker = new $payload->class();
            $worker->execute($work, $payload, $data);
        };

        if ($work->data_builder) {
            $query = $work->data_builder->newInstanceQuery((array) $this->data);

            $work->data_builder->extract($query->get(), $callback);
        } else {
            $callback(null, []);
        }
    }
}
