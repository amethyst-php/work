<?php

namespace Amethyst\Workers;

use Amethyst\Managers\HttpRequesterManager;
use Amethyst\Models\Work;
use stdClass;

class HttpWorker extends BaseWorker
{
    /**
     * @var \Amethyst\Managers\HttpRequesterManager
     */
    protected $manager;

    /**
     * Create a new instance.
     */
    public function __construct()
    {
        $this->manager = new HttpRequesterManager();
    }

    /**
     * Dispatch a work.
     *
     * @param Work  $work
     * @param array $data
     */
    public function execute(Work $work, stdClass $payload, array $data = [])
    {
        $httpRequester = $this->manager->getRepository()->findOneById($payload->data->id);

        $result = $this->manager->execute($httpRequester, $data);
    }
}
