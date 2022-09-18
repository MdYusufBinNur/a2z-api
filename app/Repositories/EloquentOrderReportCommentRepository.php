<?php


namespace App\Repositories;

use App\DbModels\OrderReport;
use App\Events\OrderReportComment\OrderReportCommentCreatedEvent;
use App\Repositories\Contracts\OrderReportCommentRepository;
use Illuminate\Support\Facades\DB;
use ArrayAccess;

class EloquentOrderReportCommentRepository extends EloquentBaseRepository implements OrderReportCommentRepository
{
    /**
     * inherit doc
     * @param array $data
     * @return ArrayAccess
     */
    public function save(array $data): ArrayAccess
    {
        DB::beginTransaction();

        $orderReportComment = parent::save($data);

        DB::commit();

        event(new OrderReportCommentCreatedEvent($orderReportComment, $this->generateEventOptionsForModel()));

        return $orderReportComment;
    }
}
