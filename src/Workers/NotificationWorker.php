<?php

namespace Amethyst\Workers;

use Amethyst\Managers\NotificationSenderManager;
use Amethyst\Models\Work;
use stdClass;

class NotificationWorker extends BaseWorker
{
    /**
     * @var \Amethyst\Managers\NotificationSenderManager
     */
    protected $manager;

    /**
     * Create a new instance.
     */
    public function __construct()
    {
        $this->manager = new NotificationSenderManager();
    }

    /**
     * Dispatch a work.
     *
     * @param Work  $work
     * @param array $data
     */
    public function execute(Work $work, stdClass $payload, array $data = [])
    {
        $notification = $this->manager->getRepository()->findOneById($payload->data->id);

        $result = $this->manager->execute($notification, $data);
    }
}
