<?php

namespace Railken\LaraOre\Work;

use Illuminate\Support\Facades\Config;
use Railken\LaraOre\Jobs\ProcessWork;
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
        Attributes\MockData\MockDataAttribute::class,
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
        $this->entity = Config::get('ore.work.entity');
        $this->attributes = array_merge($this->attributes, array_values(Config::get('ore.work.attributes')));

        $classRepository = Config::get('ore.work.repository');
        $this->setRepository(new $classRepository($this));

        $classSerializer = Config::get('ore.work.serializer');
        $this->setSerializer(new $classSerializer($this));

        $classAuthorizer = Config::get('ore.work.authorizer');
        $this->setAuthorizer(new $classAuthorizer($this));

        $classValidator = Config::get('ore.work.validator');
        $this->setValidator(new $classValidator($this));

        parent::__construct($agent);
    }

    /**
     * Dispatch a work.
     *
     * @param Work  $work
     * @param array $data
     * @param array $entities
     */
    public function dispatch(Work $work, array $data = [], array $entities = [])
    {
        dispatch(new ProcessWork($work, $data, $entities));
    }
}
