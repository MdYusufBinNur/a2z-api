<?php


namespace App\Repositories;


use App\Repositories\Contracts\ModuleOptionRepository;

class EloquentModuleOptionRepository extends EloquentBaseRepository implements ModuleOptionRepository
{
    /**
     * @inheritDoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        $searchCriteria['eagerLoad'] = ['mo.module' => 'module', 'mo.moduleOptionsProperty' => 'moduleOptionsProperty'];
        return parent::findBy($searchCriteria, $withTrashed);
    }

}
