<?php

namespace App\Http\Resources;

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
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'title' => $this->title,
            'price' => $this->price,
            'description' => $this->description,
            'category' => $this->category,
            'image' => $this->image,
            'created_date' => $this->created_at,
            'reviews' => $this->whenLoaded('reviews'), //the when loaded check the user is loaded if loaded then response.
            'average_rating' => $this->whenHas('reviews_avg_rating'), //the when loaded check the user is loaded if loaded then response.
        ];
    }
}
