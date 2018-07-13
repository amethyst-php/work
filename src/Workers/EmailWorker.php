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
        return ['to', 'body', 'subject', 'attachments'];
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
        $attachments = [];

        foreach ($extra->get('attachments', []) as $key => $attachment) {
            $attachments[$key]['as'] = $tm->renderRaw('text/plain', $attachment['as'], $data);
            $attachments[$key]['source'] = (new Bag($data))->get($attachment['source']);
        }

        $bag->set('attachments', $attachments);

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

        Mail::send([], [], function ($message) use ($options) {
            $message->to($options->get('to'))
                ->subject($options->get('subject'))
                ->setBody($options->get('body'), 'text/html');

            foreach ($options->get('attachments') as $attachment) {
                if ($attachment['source'] !== null) {
                    $media = $attachment['source']->getFirstMedia();

                    $source = null;

                    if ($media->disk === 's3') {
                        $source = $media->getTemporaryUrl((new \DateTime())->modify('+5 minutes'));
                    }

                    if ($media->disk === 'public' || $media->disk === 'local') {
                        $source = $media->getPath();
                    }

                    if ($source === null) {
                        throw new \Exception('source empty');
                    }

                    $message->attach($source, ['as' => $attachment['as']]);
                }
            }
        });
    }
}
