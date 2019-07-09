<?php

namespace Amethyst\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Amethyst\Api\Http\Controllers\RestManagerController;
use Amethyst\Api\Http\Controllers\Traits as RestTraits;
use Amethyst\Managers\WorkManager;
use Symfony\Component\HttpFoundation\Response;

class WorksController extends RestManagerController
{
    use RestTraits\RestIndexTrait;
    use RestTraits\RestShowTrait;
    use RestTraits\RestCreateTrait;
    use RestTraits\RestUpdateTrait;
    use RestTraits\RestRemoveTrait;

    /**
     * The class of the manager.
     *
     * @var string
     */
    public $class = WorkManager::class;

    /**
     * @param int                      $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function execute(int $id, Request $request)
    {
        /** @var \Amethyst\Managers\WorkManager */
        $manager = $this->manager;

        /** @var \Amethyst\Models\Work */
        $work = $manager->getRepository()->findOneById($id);

        if ($work == null) {
            return $this->response('', Response::HTTP_NOT_FOUND);
        }

        $result = $manager->execute($work, (array) $request->input('data'));

        if (!$result->ok()) {
            return $this->error(['errors' => $result->getSimpleErrors()]);
        }

        return $this->success([]);
    }
}
