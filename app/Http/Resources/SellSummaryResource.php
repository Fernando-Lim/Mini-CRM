<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SellSummaryResource extends JsonResource
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
            'id' => $this->id,
            'date' => $this->date,
            'employee' => [
                'first_name' => $this->employee->name
            ],
            'price_total' => $this->price_total,
            'discount_total' => $this->discount_total,
            'total' => $this->total
            // 'companie' =>  new CompanieResource($this->whenLoaded('companie'))
            
        
        ];
    }
}
