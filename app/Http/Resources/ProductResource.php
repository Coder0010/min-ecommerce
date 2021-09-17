<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $logged_is_owner = false;
        if(auth()->check()){
            $logged_is_owner = auth()->id() == $this->merchant->user->id ?? false;
        }
        return [
            'id'              => $this->id,
            'name'            => $this->name,
            'price'           => $this->price,
            'description'     => $this->description,
            'merchant_id'     => $this->merchant_id,
            'merchant_name'   => $this->merchant->name,
            'logged_is_owner' => $logged_is_owner
        ];
    }
}
