<?php

namespace App\Policies;

use App\Repositories\Contracts\ModuleOptionPropertyRepository;
use App\Repositories\Contracts\ModuleSettingPropertyRepository;
use Illuminate\Validation\ValidationException;

trait ValidateModules
{
    /**
     * @var ModuleSettingPropertyRepository
     */
    private $moduleSettingRepository;

    /**
     * @var ModuleOptionPropertyRepository
     */
    private $moduleOptionPropertyRepository;

    /**
     * set module repositories
     */
    public function setModuleRepositories()
    {
        $this->moduleSettingRepository = app(ModuleSettingPropertyRepository::class);
        $this->moduleOptionPropertyRepository = app(ModuleOptionPropertyRepository::class);
    }

    /**
     * is module active
     *
     * @param int $propertyId
     * @param array $moduleConst
     * @return bool
     */
    public function isModuleActiveForTheProperty(array $moduleConst, $propertyId = null)
    {
        $propertyId = $propertyId ?? request()['propertyId'];

        if (empty($propertyId)) {
            throw ValidationException::withMessages([
                'propertyId' => ["Property Id field needs to be present in the request."]
            ]);
        }

        $this->setModuleRepositories();

        return $this->moduleSettingRepository->isModuleActiveForTheProperty($propertyId, $moduleConst['id']);
    }

}
