<?php

namespace FondOfSpryker\Glue\ProductListsRestApi\Controller;

use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Spryker\Glue\Kernel\Controller\AbstractController;

/**
 * @method \FondOfSpryker\Glue\ProductListsRestApi\ProductListsRestApiFactory getFactory()
 */
class ProductListsResourceController extends AbstractController
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function getAction(RestRequestInterface $restRequest): RestResponseInterface
    {
        if ($restRequest->getResource()->getId()) {
            return $this->getFactory()
                ->createProductListsReader()
                ->findProductListByUuid($restRequest);
        }

        return $this->getFactory()
            ->createProductListsReader()
            ->findAllProductListsByCustomerId($restRequest);
    }
}
