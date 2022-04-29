<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'email_verified_at' => $this->email_verified_at,
            'token_type' => $this->token_type,
            'access_token' => $this->access_token,
            'remember_token' => $this->remember_token,
            'created_at' => Carbon::parse($this->created_at)->format('d-m-Y H:i:s'),
            'updated_at' => Carbon::parse($this->updated_at)->format('d-m-Y H:i:s'),
        ];
    }
}
