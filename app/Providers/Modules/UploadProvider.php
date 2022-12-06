<?php

namespace App\Providers\Modules;

use App\Services\Upload\Impls\UploadFileService;
use App\Services\Upload\Interfaces\IUploadFileService;
use Carbon\Laravel\ServiceProvider;

class UploadProvider extends ServiceProvider
{
    /**
     * All the container singletons that should be registered.
     *
     * @var array
     */
    public array $singletons = [
        IUploadFileService::class => UploadFileService::class,
    ];
}