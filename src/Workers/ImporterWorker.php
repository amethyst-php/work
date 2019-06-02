<?php

namespace Railken\Amethyst\Workers;

use Railken\Amethyst\Managers\ImporterManager;
use Railken\Amethyst\Models\Work;
use stdClass;

class HttpWorker extends BaseWorker
{
    /**
     * @var \Railken\Amethyst\Managers\ImporterManager
     */
    protected $manager;

    /**
     * Create a new instance.
     */
    public function __construct()
    {
        $this->manager = new ImporterManager();
    }

    /**
     * Dispatch a work.
     *
     * @param Work  $work
     * @param array $data
     */
    public function execute(Work $work, stdClass $payload, array $data = [])
    {
        $Importer = $this->manager->getRepository()->findOneById($payload->data->id);

        $result = $this->manager->execute($Importer, $data);
    }
}
