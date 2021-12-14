<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource {
	public function toArray($request) {
		// return parent::toArray($request);
		return [
			'id' => $this->id,
			'productName' => $this->productName,
			'cateogry' => $this->categoryId,
			'price' => $this->price,
			'inventory' => $this->inventory,
			'updated_at' => $this->updated_at,
			'description' => $this->description,	
		];
	}
}
?>