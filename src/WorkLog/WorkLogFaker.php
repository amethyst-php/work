<?php

namespace Railken\LaraOre\WorkLog;

use Faker\Factory;
use Railken\Bag;
use Railken\Laravel\Manager\BaseFaker;

class WorkLogFaker extends BaseFaker
{
    /**
     * @var string
     */
    protected $manager = WorkLogManager::class;

    /**
     * @return \Railken\Bag
     */
    public function parameters()
    {
        $faker = Factory::create();

        $bag = new Bag();
        $bag->set('extra', [
            'to'          => $faker->email,
        ]);

        return $bag;
    }
}
