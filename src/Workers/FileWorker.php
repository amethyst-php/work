<?php

namespace Railken\LaraOre\Workers;

use Railken\LaraOre\FileGenerator\FileGeneratorManager;
use Railken\LaraOre\Work\Work;
use stdClass;

class FileWorker extends BaseWorker
{
    /**
     * @var \Railken\LaraOre\FileGenerator\FileGeneratorManager
     */
    protected $manager;

    /**
     * Create a new instance.
     */
    public function __construct()
    {
        $this->manager = new FileGeneratorManager();
    }

    /**
     * Dispatch a work.
     *
     * @param Work  $work
     * @param array $data
     */
    public function execute(Work $work, stdClass $payload, array $data = [])
    {
        $generator = $this->manager->getRepository()->findOneById($payload->data->id);

        $result = $this->manager->generate($generator, $data);
    }
}
