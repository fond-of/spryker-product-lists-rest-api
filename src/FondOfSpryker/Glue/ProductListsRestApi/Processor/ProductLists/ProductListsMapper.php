<?php

namespace FondOfSpryker\Glue\ProductListsRestApi\Processor\ProductLists;

use Generated\Shared\Transfer\ProductListTransfer;
use Generated\Shared\Transfer\RestProductListAttributesTransfer;

class ProductListsMapper implements ProductListsMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProductListTransfer $productListTransfer
     *
     * @return \Generated\Shared\Transfer\RestProductListAttributesTransfer
     */
    public function mapRestProductListsAttributesTransfer(ProductListTransfer $productListTransfer): RestProductListAttributesTransfer
    {
        $restProductListsAttributesTransfer = new RestProductListAttributesTransfer();

        $restProductListsAttributesTransfer->fromArray(
            $productListTransfer->toArray(),
            true
        );

        return $restProductListsAttributesTransfer;
    }
}
