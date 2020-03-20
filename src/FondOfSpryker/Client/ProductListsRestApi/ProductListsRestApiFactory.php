<?php

namespace FondOfSpryker\Client\ProductListsRestApi;

use FondOfSpryker\Client\ProductListsRestApi\Dependency\Client\ProductListsRestApiToZedRequestClientInterface;
use FondOfSpryker\Client\ProductListsRestApi\Zed\ProductListsRestApiStub;
use FondOfSpryker\Client\ProductListsRestApi\Zed\ProductListsRestApiStubInterface;
use Spryker\Client\Kernel\AbstractFactory;

class ProductListsRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfSpryker\Client\ProductListsRestApi\Zed\ProductListsRestApiStubInterface
     */
    public function createZedProductListsRestApiStub(): ProductListsRestApiStubInterface
    {
        return new ProductListsRestApiStub($this->getZedRequestClient());
    }

    /**
     * @throws
     *
     * @return \FondOfSpryker\Client\ProductListsRestApi\Dependency\Client\ProductListsRestApiToZedRequestClientInterface
     */
    protected function getZedRequestClient(): ProductListsRestApiToZedRequestClientInterface
    {
        return $this->getProvidedDependency(ProductListsRestApiDependencyProvider::CLIENT_ZED_REQUEST);
    }
}
