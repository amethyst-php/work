<?php

namespace Railken\Amethyst\Workers;

use Railken\Amethyst\Managers\EmailSenderManager;
use Railken\Amethyst\Models\Work;
use stdClass;

class EmailWorker extends BaseWorker
{
    /**
     * @var \Railken\Amethyst\Managers\EmailSenderManager
     */
    protected $manager;

    /**
     * Create a new instance.
     */
    public function __construct()
    {
        $this->manager = new EmailSenderManager();
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

        $result = $this->manager->send($generator, $data);
    }
}
