<?php

namespace FondOfSpryker\Glue\ProductListsRestApi\Processor\ProductLists;

use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

interface ProductListsResourceRelationshipExpanderInterface
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface[] $resources
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface[]
     */
    public function addResourceRelationships(array $resources, RestRequestInterface $restRequest): array;
}
