<?php

namespace Railken\Amethyst\Workers;

use Railken\Amethyst\Managers\FtpActionManager;
use Railken\Amethyst\Models\Work;
use stdClass;

class FtpWorker extends BaseWorker
{
    /**
     * @var \Railken\Amethyst\Managers\FtpActionManager
     */
    protected $manager;

    /**
     * Create a new instance.
     */
    public function __construct()
    {
        $this->manager = new FtpActionManager();
    }

    /**
     * Dispatch a work.
     *
     * @param Work  $work
     * @param array $data
     */
    public function execute(Work $work, stdClass $payload, array $data = [])
    {
        $ftpAction = $this->manager->getRepository()->findOneById($payload->data->id);

        $result = $this->manager->execute($ftpAction, $data);
    }
}
