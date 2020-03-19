<?php

namespace FondOfSpryker\Zed\ProductListsRestApi\Persistence;

use Generated\Shared\Transfer\ProductListTransfer;

interface ProductListsRestApiRepositoryInterface
{
    /**
     * @param string $productListUuid
     *
     * @return \Generated\Shared\Transfer\ProductListTransfer|null
     */
    public function findProductListByUuid(string $productListUuid): ?ProductListTransfer;
}
