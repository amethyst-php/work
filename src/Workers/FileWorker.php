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
    }
}
