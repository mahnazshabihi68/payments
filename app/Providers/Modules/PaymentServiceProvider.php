<?php

namespace App\Providers\Modules;

use App\Repositories\Payment\Impls\PaymentRepository;
use App\Repositories\Payment\Interfaces\IPaymentRepository;
use App\Services\Payment\Impls\PaymentService;
use App\Services\Payment\Interfaces\IPaymentService;
use Illuminate\Support\ServiceProvider;

class PaymentServiceProvider extends ServiceProvider
{
    /**
     * All the container singletons that should be registered.
     *
     * @var array
     */
    public array $singletons = [
        IPaymentService::class  => PaymentService::class,
        IPaymentRepository::class   => PaymentRepository::class
    ];
}