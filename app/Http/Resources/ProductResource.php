<?php

namespace App\Http\Resources;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => [
                'normal_price' => $this->price,
                'compare_price' => $this->compare_price,
            ],
            'description' => $this->description,
            'image' => $this->image_url,
            'relations' => [
                'category' => [
                    'id' => $this->category->id,
                    'name' => $this->category->name,
                ],
                'store' => [
                    'id' => $this->store->id,
                    'name' => $this->store->name,
                ],
            ],
            
        ];
    }
}