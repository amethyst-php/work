<?php
namespace Railken\LaraOre\Workers;

use Railken\Bag;
use Railken\LaraOre\Template\Generators\HtmlGenerator;
use Railken\LaraOre\Work\Work;
use Illuminate\Support\Facades\Mail;

class EmailWorker extends BaseWorker
{

    /**
     * @var HtmlGenerator
     */
    protected $htmlGenerator;

    public function __construct()
    {
        $this->htmlGenerator = new HtmlGenerator();
    }

    /**
     * Render twig
     *
     * @param string $raw
     * @param array $data
     *
     * @return string
     */
    public function renderHtml(string $raw, array $data = [])
    {
        return $this->htmlGenerator->render($raw, $data);
    }

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
   
        $bag->to = $this->renderHtml($extra->to, $data);
        $bag->subject = $this->renderHtml($extra->subject, $data);
        $bag->body = $this->renderHtml($extra->body, $data);

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
