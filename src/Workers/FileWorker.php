<?php

namespace Railken\LaraOre\Workers;

use Railken\Bag;
use Railken\LaraOre\File\FileManager;
use Railken\LaraOre\Template\TemplateManager;
use Railken\LaraOre\Work\Work;
use Illuminate\Support\Collection;

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

        $bag->filename = $tm->renderRaw('text/plain', $extra->filename, $data);
        $bag->disk = $extra->disk;

        $bag->content = $tm->renderRaw($extra->filetype, $extra->content, $data);
        $bag->entity = null;

        $bag->tags = explode(',', $extra->tags);

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

        $result = $fm->uploadFileByContent($options->content, $options->filename);

        $fm->update($result->getResource(), new Bag(['tags' => $options->tags]));

        Collection::make($entities)->map(function ($entity) use ($fm, $result) {
            $fm->assignToModel($result->getResource(), $entity, []);
        });
    }
}
