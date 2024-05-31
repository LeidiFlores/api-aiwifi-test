<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StadisticResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "estimates_gender_female"=> $this->where('estimates_gender', 'female')->count(),
            "estimates_gender_male"=> $this->where('estimates_gender', 'male')->count(),
            "estimates_age_oldest_18"=> $this->where('estimates_age', '>', 18)->count(),
            "estimates_age_eldest_18"=> $this->where('estimates_age', '<', 18)->count(),
            "mail_smtp_check_count"=> $this->where('mail_smtp_check', 1)->count(),
            "mail_role_count"=> $this->where('mail_role', 1)->count(),
            "mail_disposable_count"=> $this->where('mail_disposable', 1)->count(),
            "mail_free_count"=> $this->where('mail_free', 1)->count(),
        ];
    }
}
