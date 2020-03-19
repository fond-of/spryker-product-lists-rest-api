<?php

namespace FondOfSpryker\Zed\ProductListsRestApi\Business;

use Generated\Shared\Transfer\ProductListResponseTransfer;
use Generated\Shared\Transfer\ProductListTransfer;

interface ProductListsRestApiFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProductListTransfer $productListTransfer
     *
     * @return \Generated\Shared\Transfer\ProductListResponseTransfer
     */
    public function findProductListByUuid(ProductListTransfer $productListTransfer): ProductListResponseTransfer;
}
