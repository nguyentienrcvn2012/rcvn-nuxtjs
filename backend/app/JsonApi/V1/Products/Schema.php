<?php

namespace App\JsonApi\V1\Users;

use Neomerx\JsonApi\Schema\SchemaProvider;

class Schema extends SchemaProvider
{

    /**
     * @var string
     */
    protected $resourceType = 'products';

    /**
     * @param object $resource
     *      the domain record being serialized.
     * @return string
     */
    public function getId($resource)
    {
        return (string) $resource->getRouteKey();
    }

    /**
     * @param object $resource
     *      the domain record being serialized.
     * @return array
     */
    public function getAttributes($resource)
    {
        return [
            'productName' => $resource->productName,
            'category' => $resource->category,
            'price' => $resource->price,
            'description' => $resource->description,
            'inventory' => $resource->inventory,
            'created_at' => optional($resource->created_at)->format("Y-m-d H:i:s"),
            'updated_at' => optional($resource->updated_at)->format("Y-m-d H:i:s"),
        ];
    }
}
