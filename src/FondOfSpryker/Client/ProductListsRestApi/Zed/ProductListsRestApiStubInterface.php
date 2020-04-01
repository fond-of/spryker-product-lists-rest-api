<?php

namespace FondOfSpryker\Client\ProductListsRestApi\Zed;

use FondOfSpryker\Client\ProductListsRestApi\Dependency\Client\ProductListsRestApiToZedRequestClientInterface;
use Generated\Shared\Transfer\ProductListResponseTransfer;
use Generated\Shared\Transfer\ProductListTransfer;

interface ProductListsRestApiStubInterface
{
    /**
     * @param \FondOfSpryker\Client\ProductListsRestApi\Dependency\Client\ProductListsRestApiToZedRequestClientInterface $zedRequestClient
     */
    public function __construct(ProductListsRestApiToZedRequestClientInterface $zedRequestClient);

    /**
     * @param \Generated\Shared\Transfer\ProductListTransfer $productListTransfer
     *
     * @return \Generated\Shared\Transfer\ProductListResponseTransfer
     */
    public function findProductListByUuid(ProductListTransfer $productListTransfer): ProductListResponseTransfer;
}
