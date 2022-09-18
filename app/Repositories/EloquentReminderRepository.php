<?php


namespace App\Repositories;


use App\DbModels\Reminder;
use App\Events\Reminder\ReminderCreatedEvent;
use App\Repositories\Contracts\PaymentItemRepository;
use App\Repositories\Contracts\ReminderRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class EloquentReminderRepository extends EloquentBaseRepository implements ReminderRepository
{
    /**
     * @inheritDoc
     */
    public function save(array $data): \ArrayAccess
    {
        DB::beginTransaction();

        $repository = $this->getRepositoryNameByType($data['resourceType']);
        $item = $repository->findOne($data['resourceId']);
        if (!$item instanceof \ArrayAccess) {
            throw ValidationException::withMessages([
                'resourceId' => ["No item found for this resource type"]
            ]);
        }
        if ($data['resourceType'] === Reminder::RESOURCE_TYPE_PAYMENT_ITEM) {
            $data['propertyId'] = isset($data['propertyId']) ?  $data['propertyId'] : $item->propertyId;
            $data['toUserIds'] = isset($data['toUserIds']) ?  $data['toUserIds'] : $item->userId;
            $data['toUnitIds'] = isset($data['toUnitIds']) ?  $data['toUnitIds'] : $item->unitId;
        }

        $reminder = parent::save($data);
        DB::commit();

        // fire reminder created event
        event(new ReminderCreatedEvent($reminder, $this->generateEventOptionsForModel()));

        return $reminder;
    }

    /**
     * ReminderService has different types,
     * get the repository by types
     *
     * @param $type
     * @return string
     */
    private function getRepositoryNameByType($type)
    {
        $repositoryName = '';
//        switch ($type) {
//            case Reminder::RESOURCE_TYPE_PAYMENT_ITEM:
//                $repositoryName = app(PaymentItemRepository::class);
//                break;
//        }

        if (empty($repositoryName)) {
            throw ValidationException::withMessages([
                'resourceType' => ["No reminder found for this resource."]
            ]);
        }
        return $repositoryName;
    }

}
