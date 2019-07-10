<?php

namespace Amethyst\Fakers;

use Amethyst\DataBuilders\DummyDataBuilder;
use Faker\Factory;
use Railken\Bag;
use Railken\Lem\Faker;
use Symfony\Component\Yaml\Yaml;

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
        $bag->set('payload', Yaml::dump(['dummy' => 'dummy']));
        $bag->set('description', $faker->text);
        $bag->set('data_builder', DataBuilderFaker::make()->parameters()->set('data_builder.class_name', DummyDataBuilder::class)->toArray());
        $bag->set('data', Yaml::dump([
            'id' => '{{ record.id }}',
        ]));

        return $bag;
    }

    /**
     * @return \Railken\Bag
     */
    public function parametersWithFile()
    {
        $faker = Factory::create();

        $bag = $this->parameters();
        $bag->set('payload', Yaml::dump([
            'class' => 'Amethyst\Workers\FileWorker',
            'data'  => [
                'id' => 1,
            ],
        ]));

        return $bag;
    }

    /**
     * @return \Railken\Bag
     */
    public function parametersWithEmail()
    {
        $faker = Factory::create();

        $bag = $this->parameters();
        $bag->set('payload', Yaml::dump([
            'class' => 'Amethyst\Workers\EmailWorker',
            'data'  => [
                'id' => 1,
            ],
        ]));

        return $bag;
    }
}
