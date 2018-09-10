<?php

namespace Railken\LaraOre\Workers;

use Railken\LaraOre\EmailSender\EmailSenderManager;
use Railken\LaraOre\Work\Work;
use stdClass;

class EmailWorker extends BaseWorker
{
    /**
     * @var \Railken\LaraOre\EmailSender\EmailSenderManager
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
