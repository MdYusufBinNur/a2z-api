<?php

namespace App\Http\Resources;

class ExpenseResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->getIdOrUuid(),
            'categoryId' =>$this->categoryId,
            'category' => $this->when($this->needToInclude($request, 'expense.category'), function () {
                return new ExpenseCategoryResource($this->category);
            }),
            'propertyId' => $this->propertyId,
            'createdByUserId' => $this->createdByUserId,
            'createdByUser' => $this->when($this->needToInclude($request, 'expense.createdByUser'), function () {
                return new UserResource($this->createdByUser);
            }),
            'amount' => $this->amount,
            'expenseReason' => $this->expenseReason,
            'notes' => $this->notes,
            'expenseDate' => $this->expenseDate,
        ];
    }
}
