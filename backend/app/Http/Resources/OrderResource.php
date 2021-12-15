<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource {
	public function toArray($request) {
		// return parent::toArray($request);
		return [
			'id' => $this->id,
			'customerId' => $this->customer_name,
			'productId' => $this->product_name,
			'quantily' => $this->quantily,
			'totalPrice' => $this->totalPrice,
			'status' => $this->status_order,
			'updated_at' => $this->updated_at,	
		];
	}
}
?>