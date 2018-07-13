<?php

namespace Railken\LaraOre\Workers;

use GuzzleHttp\Client;
use Railken\Bag;
use Railken\LaraOre\Template\TemplateManager;
use Railken\LaraOre\Work\Work;

class HttpWorker extends BaseWorker
{
    /**
     * @return array
     */
    public function getData()
    {
        return ['method', 'url', 'options'];
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

        $bag->set('method', $tm->renderRaw('text/plain', $extra->get('method'), $data));
        $bag->set('url', $tm->renderRaw('text/plain', $extra->get('url'), $data));
        $bag->set('options', json_decode($tm->renderRaw('text/plain', (string) json_encode($extra->get('options')), $data), true));

        return $bag;
    }

    /**
     * Dispatch a work.
     *
     * @param Work  $work
     * @param array $data
     */
    public function execute(Work $work, array $data = [])
    {
        $options = $this->getOptionsByWork($work, $data);

        $client = new Client();
        $client->request($options->get('method'), $options->get('url'), $options->get('options'));
    }
}
