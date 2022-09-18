<?php


namespace App\Repositories;


use App\DbModels\OrderReport;
use App\Events\OrderReport\OrderReportCreatedEvent;
use App\Repositories\Contracts\OrderReportLogRepository;
use App\Repositories\Contracts\OrderReportRepository;
use ArrayAccess;
use Illuminate\Support\Facades\DB;

class EloquentOrderReportRepository extends EloquentBaseRepository implements OrderReportRepository
{
    /**
     * inherit doc
     * @param array $data
     * @return ArrayAccess
     */
    public function save(array $data): ArrayAccess
    {
        DB::beginTransaction();

        if(empty($data['status'])) {
            $data['status'] = OrderReport::STATUS_SUBMITTED;
        }

        $orderReport = parent::save($data);

        DB::commit();

//        event(new OrderReportCreatedEvent($orderReport, $this->generateEventOptionsForModel()));

        return $orderReport;
    }
}
