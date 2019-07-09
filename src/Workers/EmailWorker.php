<?php

namespace Amethyst\Workers;

use Amethyst\Managers\EmailSenderManager;
use Amethyst\Models\Work;
use stdClass;

class EmailWorker extends BaseWorker
{
    /**
     * @var \Amethyst\Managers\EmailSenderManager
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
        $emailSender = $this->manager->getRepository()->findOneById($payload->data->id);

        $result = $this->manager->execute($emailSender, $data);
    }
}
