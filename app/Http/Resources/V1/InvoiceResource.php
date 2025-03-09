<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        $data = [
            "id"=> $this->id,
            "customerId"=> $this->customer_id,
            "amount"=> $this->amount,
            "status"=> $this->status,
            "billedDate"=> $this->billed_date,
            "paidDate"=> $this->paid_date,
            "createdAt"=> $this->created_at,
            "updatedAt"=> $this->updated_at,
        ];

        return $data;
    }
}
