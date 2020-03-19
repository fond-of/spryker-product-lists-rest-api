<?php

namespace FondOfSpryker\Client\ProductListsRestApi\Zed;

use FondOfSpryker\Client\ProductListsRestApi\Dependency\Client\ProductListsRestApiToZedRequestClientInterface;
use Generated\Shared\Transfer\ProductListResponseTransfer;
use Generated\Shared\Transfer\ProductListTransfer;

class ProductListsRestApiStub implements ProductListsRestApiStubInterface
{
    /**
     * @var \FondOfSpryker\Client\ProductListsRestApi\Dependency\Client\ProductListsRestApiToZedRequestClientInterface
     */
    protected $zedRequestClient;

    /**
     * @param \FondOfSpryker\Client\ProductListsRestApi\Dependency\Client\ProductListsRestApiToZedRequestClientInterface $zedRequestClient
     */
    public function __construct(ProductListsRestApiToZedRequestClientInterface $zedRequestClient)
    {
        $this->zedRequestClient = $zedRequestClient;
    }

    /**
     * @param \Generated\Shared\Transfer\ProductListTransfer $productListTransfer
     *
     * @return \Generated\Shared\Transfer\ProductListResponseTransfer
     */
    public function findProductListByUuid(ProductListTransfer $productListTransfer): ProductListResponseTransfer
    {
        /** @var \Generated\Shared\Transfer\ProductListResponseTransfer $productListResponseTransfer */
        $productListResponseTransfer = $this->zedRequestClient->call('/product-lists-rest-api/gateway/find-product-list-by-uuid', $productListTransfer);

        return $productListResponseTransfer;
    }
}
