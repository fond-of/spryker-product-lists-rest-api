<?php

namespace FondOfSpryker\Glue\ProductListsRestApi\Processor\ProductLists;

use Generated\Shared\Transfer\ProductListTransfer;
use Generated\Shared\Transfer\RestProductListsAttributesTransfer;

interface ProductListsMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProductListTransfer $productListTransfer
     *
     * @return \Generated\Shared\Transfer\RestProductListsAttributesTransfer
     */
    public function mapRestProductListsAttributesTransfer(
        ProductListTransfer $productListTransfer
    ): RestProductListsAttributesTransfer;
}
