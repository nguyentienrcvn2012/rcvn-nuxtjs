<?php
namespace App\Http\Resources;

use App\Http\Resources\Post as PostResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UsersResource extends JsonResource {
	public function toArray($request) {
		// return parent::toArray($request);
		return [
			'id' => $this->id,
			'email' => $this->email,
			'name' => $this->name,
		];
	}
}
?>