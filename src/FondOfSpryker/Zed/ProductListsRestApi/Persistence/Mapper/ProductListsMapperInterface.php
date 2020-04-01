<?php

namespace FondOfSpryker\Zed\ProductListsRestApi\Persistence\Mapper;

use Generated\Shared\Transfer\ProductListTransfer;
use Orm\Zed\ProductList\Persistence\SpyProductList;

interface ProductListsMapperInterface
{
    /**
     * @param \Orm\Zed\ProductList\Persistence\SpyProductList $spyProductList
     * @param \Generated\Shared\Transfer\ProductListTransfer $productListTransfer
     *
     * @return \Generated\Shared\Transfer\ProductListTransfer
     */
    public function mapEntityToProductListTransfer(SpyProductList $spyProductList, ProductListTransfer $productListTransfer): ProductListTransfer;
}
