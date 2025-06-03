<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'order_id' => $this->order_id,
            'bank_name' => $this->bank_name,
            'owner_name' => $this->owner_name,
            'account_number' => $this->account_number,
            'invoice' => $this->invoice,
            'status' => $this->status,
            'image' => $this->image ? asset('storage/' . $this->image) : null,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
            'order' => new OrderResource($this->whenLoaded('order')),
        ];
    }
}