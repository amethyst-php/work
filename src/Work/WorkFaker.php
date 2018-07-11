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
        $bag->set('name', 'El. psy. congroo. '.microtime(true));
        $bag->set('worker', 'Railken\LaraOre\Workers\EmailWorker');
        $bag->set('mock_data', [
            'user'    => 'Railken\LaraOre\User\UserFaker',
            'message' => 'text',
        ]);
        $bag->set('extra', [
            'to'          => '{{ user.email }}',
            'subject'     => 'Welcome to the laboratory lab {{ user.name }}',
            'body'        => '{{ message }}',
            'attachments' => [
                [
                    'as'       => '{{ user.name }}.txt',
                    'source'   => 'file',
                ],
            ],
        ]);

        return $bag;
    }

    /**
     * @return \Railken\Bag
     */
    public function parametersWithFile()
    {
        $faker = Factory::create();

        $bag = $this->parameters();
        $bag->set('name', 'El. psy. congroo. '.microtime(true));
        $bag->set('worker', 'Railken\LaraOre\Workers\FileWorker');
        $bag->set('mock_data', [
            'message' => 'abc',
        ]);
        $bag->set('extra', [
            'filename' => "{{ 'now'|date('Y-m-d') }}.pdf",
            'filetype' => 'application/pdf',
            'content'  => '{{ message }}',
            'tags'     => 'pdf,hello,invoice',
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
        $bag->set('worker', 'Railken\LaraOre\Workers\EmailWorker');
        $bag->set('extra', [
            'to'          => '{{ user.email }}',
            'subject'     => 'Welcome to the laboratory lab {{ user.name }}',
            'body'        => '{{ message }}',
            'attachments' => [
                [
                    'as'       => '{{ user.name }}.txt',
                    'source'   => 'file',
                ],
            ],
        ]);

        return $bag;
    }
}
