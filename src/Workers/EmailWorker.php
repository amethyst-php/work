<?php
namespace Railken\LaraOre\Workers;

use Railken\Bag;
use Railken\LaraOre\Template\TemplateManager;
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

        $tm = new TemplateManager();

        $bag->to = $tm->renderRaw('text/plain', $extra->to, $data);
        $bag->subject = $tm->renderRaw('text/plain', $extra->subject, $data);
        $bag->body = $tm->renderRaw('text/html', $extra->body, $data);

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
