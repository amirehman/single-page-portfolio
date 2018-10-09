<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GeneralResource extends JsonResource
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
            'intro' => $this->intro,
            'dp' => $this->dp,
            'companyimage' => $this->company_image,
            'facebook' => $this->facebook,
            'twitter' => $this->twitter,
            'instagram' => $this->instagram,
            'github' => $this->github,
            'stackoverflow' => $this->stackoverflow,
            'linkedin' => $this->linkedin
        ];
    }
}
