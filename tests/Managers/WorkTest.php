<?php

namespace Railken\Amethyst\Tests\Managers;

use Railken\Amethyst\Fakers\WorkFaker;
use Railken\Amethyst\Managers\WorkManager;
use Railken\Amethyst\Tests\BaseTest;
use Railken\Lem\Support\Testing\TestableBaseTrait;

class WorkTest extends BaseTest
{
    use TestableBaseTrait;

    /**
     * Manager class.
     *
     * @var string
     */
    protected $manager = WorkManager::class;

    /**
     * Faker class.
     *
     * @var string
     */
    protected $faker = WorkFaker::class;

    public function testDefaultSchema()
    {
        $resource = $this->getManager()->create($this->faker::make()->parameters()->remove('payload'))->getResource();

        $this->assertEquals(file_get_contents(__DIR__.'/../../resources/schema/default/payload.yaml'), $resource->payload);
    }
}
