<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContactResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "user_id" => $this->user_id,
            "name"=> $this->name,
            "email"=> $this->email,
            "estimates_gender"=> $this->estimates_gender,
            "probability_gender"=> $this->probability_gender,
            "estimates_age"=> $this->estimates_age,
            "estimates_nationality"=> $this->estimates_nationality,
            "probability_nationality"=> round($this->probability_nationality, 4),
            "mail_smtp_check"=> ($this->mail_smtp_check == 1),
            "mail_role"=> ($this->mail_role == 1),
            "mail_disposable"=> ($this->mail_disposable == 1),
            "mail_free"=> ($this->mail_free == 1),
            "created_at"=> $this->created_at->format('Y-m-d'),
            "updated_at"=> $this->updated_at->format('Y-m-d'),
        ];
    }
}
