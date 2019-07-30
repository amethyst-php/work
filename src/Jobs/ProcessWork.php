<?php

namespace Amethyst\Jobs;

use Amethyst\Models\Work;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Railken\Template\Generators;
use Symfony\Component\Yaml\Yaml;

class ProcessWork implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

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

            $payload = json_decode(strval(json_encode(Yaml::parse($generator->generateAndRender($work->payload, $data)))));

            $worker = new $payload->class();
            $method = $payload->method;

            $worker->$method(...$payload->arguments);
        };

        if ($work->data_builder) {
            $query = $work->data_builder->newInstanceQuery((array) $this->data);

            $work->data_builder->extract($query->get(), $callback);
        } else {
            $callback(null, []);
        }
    }
}
