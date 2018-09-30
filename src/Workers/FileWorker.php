<?php

namespace Railken\Amethyst\Workers;

use Railken\Amethyst\Managers\FileGeneratorManager;
use Railken\Amethyst\Models\Work;
use stdClass;

class FileWorker extends BaseWorker
{
    /**
     * @var \Railken\Amethyst\Managers\FileGeneratorManager
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
