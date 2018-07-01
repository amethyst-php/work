<?php

namespace Railken\LaraOre\Workers;

use Illuminate\Support\Facades\Mail;
use Railken\Bag;
use Railken\LaraOre\Template\TemplateManager;
use Railken\LaraOre\Work\Work;

class EmailWorker extends BaseWorker
{

    /**
     * @return array
     */
    public function getData()
    {
        return ['to', 'body', 'subject'];
    }

    /**
     * Get options by work.
     *
     * @param Work  $work
     * @param array $data
     *
     * @return Bag
     */
    public function getOptionsByWork(Work $work, array $data = [])
    {
        $bag = new Bag();

        $extra = new Bag($work->extra);

        $tm = new TemplateManager();

        $bag->set('to', $tm->renderRaw('text/plain', $extra->get('to'), $data));
        $bag->set('subject', $tm->renderRaw('text/plain', $extra->get('subject'), $data));
        $bag->set('body', $tm->renderRaw('text/html', $extra->get('body'), $data));

        return $bag;
    }

    /**
     * Dispatch a work.
     *
     * @param Work  $work
     * @param array $data
     *
     * @return void
     */
    public function execute(Work $work, array $data = [])
    {
        $options = $this->getOptionsByWork($work, $data);

        Mail::send([], [], function ($message) use ($options) {
            $message->to($options->get('to'))
                ->subject($options->get('subject'))
                ->setBody($options->get('body'), 'text/html');
        });
    }
}
