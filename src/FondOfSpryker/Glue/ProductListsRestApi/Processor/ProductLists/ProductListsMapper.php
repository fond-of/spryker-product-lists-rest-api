<?php

namespace FondOfSpryker\Glue\ProductListsRestApi\Processor\ProductLists;

use Generated\Shared\Transfer\ProductListTransfer;
use Generated\Shared\Transfer\RestProductListsAttributesTransfer;

class ProductListsMapper implements ProductListsMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProductListTransfer $productListTransfer
     *
     * @return \Generated\Shared\Transfer\RestProductListsAttributesTransfer
     */
    public function mapRestProductListsAttributesTransfer(ProductListTransfer $productListTransfer): RestProductListsAttributesTransfer
    {
        $restProductListsAttributesTransfer = new RestProductListsAttributesTransfer();

        $restProductListsAttributesTransfer->fromArray(
            $productListTransfer->toArray(),
            true
        );

        return $restProductListsAttributesTransfer;
    }
}
