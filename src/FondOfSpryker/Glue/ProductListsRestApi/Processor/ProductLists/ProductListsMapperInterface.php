<?php

namespace FondOfSpryker\Glue\ProductListsRestApi\Processor\ProductLists;

use Generated\Shared\Transfer\ProductListTransfer;
use Generated\Shared\Transfer\RestProductListAttributesTransfer;

interface ProductListsMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProductListTransfer $productListTransfer
     *
     * @return \Generated\Shared\Transfer\RestProductListAttributesTransfer
     */
    public function mapRestProductListsAttributesTransfer(
        ProductListTransfer $productListTransfer
    ): RestProductListAttributesTransfer;
}
