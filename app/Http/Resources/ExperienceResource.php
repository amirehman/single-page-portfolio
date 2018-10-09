<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ExperienceResource extends JsonResource
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
            'title' => $this->title,
            'company' => $this->company,
            'companylink' => $this->company_link,
            'startdate' => $this->start_date,
            'enddate' => $this->end_date,
            'detail' => $this->detail,
            'items' => $this->items

        ];
    }
}
