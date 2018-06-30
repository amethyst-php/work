<?php

namespace Railken\LaraOre\Work;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Railken\Laravel\Manager\Contracts\EntityContract;

/**
 * @property string $name
 * @property string $worker
 * @property array $extra
 * @property array $mock_data
 */
class Work extends Model implements EntityContract
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'worker', 'extra', 'mock_data',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'extra' => 'object',
        'mock_data' => 'object',
    ];

    /**
     * Creates a new instance of the model.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = Config::get('ore.work.table', 'ore_works');
    }
}
