<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InvestmentPackageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'investment_category_id' => $this->investment_category_id,
            'package_name' => $this->package_name,
            'unit_price' => $this->unit_price,
            'duration' => $this->duration,
            'return_rate' => $this->return_rate,
            'package_available_units' => $this->package_available_units,
            'package_image_url' => $this->package_image_url,
            'status' => $this->status,
            'package_description' => $this->package_description,
        ];
    }
}
