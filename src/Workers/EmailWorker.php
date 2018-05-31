<?php
namespace Railken\LaraOre\Workers;

use Railken\Bag;
use Railken\LaraOre\Template\Generators\TextGenerator;
use Railken\LaraOre\Template\Generators\HtmlGenerator;
use Railken\LaraOre\Work\Work;
use Illuminate\Support\Facades\Mail;

class EmailWorker extends BaseWorker
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
        $htmlGenerator = new HtmlGenerator();
   
        $bag->to = $textGenerator->render($extra->to, $data);
        $bag->subject = $textGenerator->render($extra->subject, $data);
        $bag->body = $htmlGenerator->render($extra->body, $data);

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

        Mail::send([], [], function ($message) use ($options) {
            $message->to($options->to)
                ->subject($options->subject)
                ->setBody($options->body, 'text/html');
        });
    }
}
