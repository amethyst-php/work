<?php

namespace Railken\LaraOre\WorkLog;

use Faker\Factory;
use Illuminate\Support\Facades\Config;
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
        $bag->set('work_name', $faker->name);
        $bag->set('worker', Config::get('ore.work.workers')[0]);
        $bag->set('extra', [
            'to'          => $faker->email,
        ]);

        return $bag;
    }
}
