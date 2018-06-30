<?php

namespace Railken\LaraOre\Workers;

use Illuminate\Support\Collection;
use Railken\Bag;
use Railken\LaraOre\File\FileManager;
use Railken\LaraOre\Template\TemplateManager;
use Railken\LaraOre\Work\Work;

class FileWorker extends BaseWorker
{
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

        $bag->set('filename', $tm->renderRaw('text/plain', $extra->get('filename'), $data));
        $bag->set('disk', $extra->get('disk'));

        $bag->set('content', $tm->renderRaw($extra->get('filetype'), $extra->get('content'), $data));
        $bag->set('entity', null);

        $bag->set('tags', explode(',', $extra->get('tags')));

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
    public function execute(Work $work, array $data = [], array $entities = [])
    {
        $options = $this->getOptionsByWork($work, $data);
        $fm = new FileManager();

        $result = $fm->uploadFileByContent($options->get('content'), $options->get('filename'));

        $fm->update($result->getResource(), new Bag(['tags' => $options->get('tags')]));

        Collection::make($entities)->map(function ($entity) use ($fm, $result) {
            $fm->assignToModel($result->getResource(), $entity, []);
        });
    }
}
