<?php

namespace FondOfSpryker\Client\ProductListsRestApi;

use Generated\Shared\Transfer\ProductListResponseTransfer;
use Generated\Shared\Transfer\ProductListTransfer;

interface ProductListsRestApiClientInterface
{
    /**
     * Specification:
     * - Finds a product list by uuid.
     * - Makes zed request.
     * - Requires uuid field to be set in CompanyTransfer taken as parameter.
     *
     * @api
     *
     * {@internal will work if UUID field is provided.}
     *
     * @param \Generated\Shared\Transfer\ProductListTransfer $productListTransfer
     *
     * @return \Generated\Shared\Transfer\ProductListResponseTransfer
     */
    public function findProductListByUuid(ProductListTransfer $productListTransfer): ProductListResponseTransfer;
}
