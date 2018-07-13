<?php

namespace Railken\LaraOre\WorkLog;

use Illuminate\Support\Facades\Config;
use Railken\Laravel\Manager\Contracts\AgentContract;
use Railken\Laravel\Manager\ModelManager;
use Railken\Laravel\Manager\Tokens;

class WorkLogManager extends ModelManager
{
    /**
     * Class name entity.
     *
     * @var string
     */
    public $entity = WorkLog::class;

    /**
     * List of all attributes.
     *
     * @var array
     */
    protected $attributes = [
        Attributes\Id\IdAttribute::class,
        Attributes\CreatedAt\CreatedAtAttribute::class,
        Attributes\UpdatedAt\UpdatedAtAttribute::class,
        Attributes\Extra\ExtraAttribute::class,
    ];

    /**
     * List of all exceptions.
     *
     * @var array
     */
    protected $exceptions = [
        Tokens::NOT_AUTHORIZED => Exceptions\WorkLogNotAuthorizedException::class,
    ];

    /**
     * Construct.
     *
     * @param AgentContract $agent
     */
    public function __construct(AgentContract $agent = null)
    {
        $this->entity = Config::get('ore.work-log.entity');
        $this->attributes = array_merge($this->attributes, array_values(Config::get('ore.work-log.attributes')));

        $classRepository = Config::get('ore.work-log.repository');
        $this->setRepository(new $classRepository($this));

        $classSerializer = Config::get('ore.work-log.serializer');
        $this->setSerializer(new $classSerializer($this));

        $classAuthorizer = Config::get('ore.work-log.authorizer');
        $this->setAuthorizer(new $classAuthorizer($this));

        $classValidator = Config::get('ore.work-log.validator');
        $this->setValidator(new $classValidator($this));

        parent::__construct($agent);
    }
}
