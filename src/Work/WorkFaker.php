<?php

namespace Railken\LaraOre\Work;

use Faker\Factory;
use Railken\Bag;
use Railken\Laravel\Manager\BaseFaker;

class WorkFaker extends BaseFaker
{
    /**
     * @var string
     */
    protected $manager = WorkManager::class;

    /**
     * @return \Railken\Bag
     */
    public function parameters()
    {
        $faker = Factory::create();

        $bag = new Bag();
        $bag->set('name', $faker->name);
        $bag->set('payload', ['dummy' => 'dummy']);

        return $bag;
    }

    /**
     * @return \Railken\Bag
     */
    public function parametersWithFile()
    {
        $faker = Factory::create();

        $bag = $this->parameters();
        $bag->set('payload', [
            'class' => 'Railken\LaraOre\Workers\FileWorker',
            'data'  => [
                'id' => 1,
            ],
        ]);

        return $bag;
    }

    /**
     * @return \Railken\Bag
     */
    public function parametersWithEmail()
    {
        $faker = Factory::create();

        $bag = $this->parameters();
        $bag->set('payload', [
            'class' => 'Railken\LaraOre\Workers\EmailWorker',
            'data'  => [
                'id' => 1,
            ],
        ]);

        return $bag;
    }
}
