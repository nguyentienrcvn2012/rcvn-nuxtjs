<?php
namespace App\Http\Resources;

use App\Http\Resources\Post as PostResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource {
	public function toArray($request) {
		// return parent::toArray($request);
		return [
			'id' => $this->id,
			'name' => $this->name,
			'email' => $this->email,
			'phone' => $this->phone,
			'address' => $this->address,
			'updated_at' => $this->updated_at,
		];
	}
}
?>