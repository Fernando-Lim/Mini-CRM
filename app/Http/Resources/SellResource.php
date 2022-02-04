<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SellResource extends JsonResource
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
            'date' => $this->date,
            'item' => [
                'name' => $this->item->name
            ],
            'price' => $this->price,
            'discount' => $this->discount,
            // 'companie' =>  new CompanieResource($this->whenLoaded('companie'))
            'employee' => [
                'first_name' => $this->employee->name
            ]
            
        
        ];
    }
}
