<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InvestmentPackageCategoryResource extends JsonResource
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
            'category_name' => $this->investment_category_name,
            'cover_image' => $this->investment_category_cover_image,
            'status' => $this->status,
            'category_description' => $this->investment_category_description,
            'investment_packages' => InvestmentPackageResource::collection($this->whenLoaded('investmentPackages'))
        ];
    }
}
