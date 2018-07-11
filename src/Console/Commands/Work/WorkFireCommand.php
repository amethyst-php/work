<?php

namespace Railken\LaraOre\Console\Commands\Work;

use Illuminate\Console\Command;
use Railken\LaraOre\Work\WorkManager;

class WorkFireCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lara-ore:work:fire {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Force event work with mock data';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $wm = new WorkManager();
        $id = intval($this->argument('id'));

        /** @var \Railken\LaraOre\Work\Work */
        $work = $wm->getRepository()->findOneById($id);

        if ($work == null) {
            $this->error(sprintf('No work found with id: %d', $id));

            return;
        }

        $wm->dispatch($work, (array) $work->mock_data, []);
    }
}
