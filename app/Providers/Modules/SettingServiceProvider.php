<?php

namespace App\Providers\Modules;

use App\Repositories\Setting\Impls\SettingRepository;
use App\Repositories\Setting\Interfaces\ISettingRepository;
use App\Services\Setting\Impls\SettingService;
use App\Services\Setting\Interfaces\ISettingService;
use Illuminate\Support\ServiceProvider;

class SettingServiceProvider extends ServiceProvider
{
    /**
     * All the container singletons that should be registered.
     *
     * @var array
     */
    public array $singletons = [
        ISettingService::class => SettingService::class,
        ISettingRepository::class => SettingRepository::class,
    ];
}