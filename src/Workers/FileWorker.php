<?php
namespace Railken\LaraOre\Workers;

use Railken\Bag;
use Railken\LaraOre\Template\Generators\TextGenerator;
use Railken\LaraOre\Template\Generators\HtmlGenerator;
use Railken\LaraOre\Work\Work;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Railken\LaraOre\File\FileManager;

class FileWorker extends BaseWorker
{
    /**
     * Get options by work
     *
     * @param Work $work
     * @param array $data
     *
     * @return Bag
     */
    public function getOptionsByWork(Work $work, array $data = [])
    {
        $bag = new Bag();

        $extra = new Bag($work->extra);

        $textGenerator = new TextGenerator();
        $bag->filename = $textGenerator->render($extra->filename, $data);
        $bag->disk = $extra->disk;
        $generator = Config::get('ore.template.generators')[$extra->generator];

        $generator = new $generator;

        $bag->content = $generator->render($extra->content, $data);
        $bag->entity = null;

        if (isset($data['__model']) && isset($data['__model']['id']) && isset($data['__model']['type']) && class_exists($data['__model']['type'])) {
            $bag->entity = (new $data['__model']['type'])->newQuery()->where('id', $data['__model']['id'])->first();
        }

        $bag->tags = explode(",", $extra->tags);

        return $bag;
    }


    /**
     * Dispatch a work
     *
     * @param Work $work
     * @param array $data
     *
     * @return void
     */
    public function execute(Work $work, array $data = [])
    {
        $options = $this->getOptionsByWork($work, $data);
        $fm = new FileManager();
        $result = $fm->uploadFileByContent($options->content, $options->filename);

        $fm->update($result->getResource(), new Bag(['tags' => $options->tags]));
        
        $options->entity && $fm->assignToModel($result->getResource(), $options->entity, []);
    }
}
