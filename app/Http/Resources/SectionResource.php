<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SectionResource extends JsonResource
{
	public function toArray($request)
	{
		return [
      'id' => $this->id,
      'section_name' => $this->section_name,
      'description' => $this->description,
      'created_by' => $this->user->name,
    ];
	}
}
