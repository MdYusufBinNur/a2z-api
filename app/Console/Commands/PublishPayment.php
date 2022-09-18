<?php

namespace App\Console\Commands;

use App\Repositories\Contracts\PaymentRepository;
use Illuminate\Console\Command;

class PublishPayment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pms:publish-payment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish payment to payment item';

    /**
     * @var PaymentRepository
     */
    private $paymentRepository;

    /**
     * Create a new command instance.
     *
     * @param PaymentRepository $paymentRepository

     * @return void
     */
    public function __construct(PaymentRepository $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
        parent::__construct();
    }

}
