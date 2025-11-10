<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PropertyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
//        return parent::toArray($request);
        return [
            'id'              => $this->id,
            'organisation'    => $this->organisation,
            'property_type'   => $this->property_type,
            'parent_property' => $this->parent_property_id,
            'uprn'            => $this->uprn,
            'address'         => $this->address,
            'town'            => $this->town,
            'postcode'        => $this->postcode,
            'live'            => (bool)$this->live,
            'certificates_count' => $this->whenCounted('certificates'),
            'created_at'      => $this->created_at,
            'updated_at'      => $this->updated_at,
        ];
    }
}
