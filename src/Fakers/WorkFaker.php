<?php

namespace Railken\Amethyst\Fakers;

use Faker\Factory;
use Railken\Bag;
use Railken\Lem\Faker;

class WorkFaker extends Faker
{
    /**
     * @return \Railken\Bag
     */
    public function parameters()
    {
        $faker = Factory::create();

        $bag = new Bag();
        $bag->set('name', $faker->name);
        $bag->set('payload', ['dummy' => 'dummy']);
        $bag->set('description', $faker->text);

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
            'class' => 'Railken\Amethyst\Workers\FileWorker',
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
            'class' => 'Railken\Amethyst\Workers\EmailWorker',
            'data'  => [
                'id' => 1,
            ],
        ]);

        return $bag;
    }
}
