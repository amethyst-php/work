<?php

namespace Railken\LaraOre\Work;

use Railken\Bag;
use Faker\Factory;

class WorkFaker
{
    /**
     * @return Bag
     */
    public static function make()
    {
        $faker = Factory::create();
        
        $bag = new Bag();
        $bag->set('name', 'El. psy. congroo. '.microtime(true));
        $bag->set('worker', 'Railken\LaraOre\Workers\EmailWorker');
        $bag->set('mock_data', [
            'user' => [
                'email' => 'foo@foo.net'
            ],
            'message' => 'abc'
        ]);
        $bag->set('extra', [
            'to'      => '{{ user.email }}',
            'subject' => 'Welcome to the laboratory lab {{ user.name }}',
            'body'    => '{{ message }}',
        ]);

        return $bag;
    }

    /**
     * @return Bag
     */
    public static function makeWithFile()
    {
        $faker = Factory::create();
        
        $bag = static::make();
        $bag->set('name', 'El. psy. congroo. '.microtime(true));
        $bag->set('worker', 'Railken\LaraOre\Workers\FileWorker');
        $bag->set('mock_data', [
            'message' => 'abc'
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
     * @return Bag
     */
    public static function makeWithEmail()
    {
        $faker = Factory::create();
        
        $bag = static::make();
        $bag->set('worker', 'Railken\LaraOre\Workers\EmailWorker');
        $bag->set('extra', [
            'to'      => '{{ user.email }}',
            'subject' => 'Welcome to the laboratory lab {{ user.name }}',
            'body'    => '{{ message }}',
        ]);

        return $bag;
    }
}
