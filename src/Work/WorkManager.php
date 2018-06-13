<?php

namespace Railken\LaraOre\Work;

use Railken\Laravel\Manager\Contracts\AgentContract;
use Railken\Laravel\Manager\ModelManager;
use Railken\Laravel\Manager\Tokens;

class WorkManager extends ModelManager
{
    /**
     * Class name entity.
     *
     * @var string
     */
    public $entity = Work::class;

    /**
     * List of all attributes.
     *
     * @var array
     */
    protected $attributes = [
        Attributes\Id\IdAttribute::class,
        Attributes\Name\NameAttribute::class,
        Attributes\CreatedAt\CreatedAtAttribute::class,
        Attributes\UpdatedAt\UpdatedAtAttribute::class,
        Attributes\Worker\WorkerAttribute::class,
        Attributes\Extra\ExtraAttribute::class,
    ];

    /**
     * List of all exceptions.
     *
     * @var array
     */
    protected $exceptions = [
        Tokens::NOT_AUTHORIZED => Exceptions\WorkNotAuthorizedException::class,
    ];

    /**
     * Construct.
     *
     * @param AgentContract $agent
     */
    public function __construct(AgentContract $agent = null)
    {
        $this->setRepository(new WorkRepository($this));
        $this->setSerializer(new WorkSerializer($this));
        $this->setValidator(new WorkValidator($this));
        $this->setAuthorizer(new WorkAuthorizer($this));

        parent::__construct($agent);
    }

    /**
     * Dispatch a work.
     *
     * @param Work  $work
     * @param array $data
     * @param array $entities
     *
     * @return void
     */
    public function dispatch(Work $work, array $data = [], array $entities = [])
    {
        $worker = new $work->worker();
        $worker->execute($work, $data, $entities);
    }
}
