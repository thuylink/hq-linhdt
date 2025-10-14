<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'            => (int) $this->id,
            'name'          => $this->name,
            'description'   => $this->description,
            'flag'          => (bool) $this->flag,
            'parent_id'     => $this->parent_id,
            'banner'        => $this->banner,
            'created_at'    => $this->created_at->toIso8601String(),
            'updated_at'    => $this->updated_at->toIso8601String(),
            'parent'        => $this->parent ? $this->parent->name : null,
            'children'      => $this->children->pluck('name')
        ];
    }
}
