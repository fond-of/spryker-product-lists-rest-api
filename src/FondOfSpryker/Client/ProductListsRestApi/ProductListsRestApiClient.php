<?php

namespace FondOfSpryker\Client\ProductListsRestApi;

use Generated\Shared\Transfer\ProductListResponseTransfer;
use Generated\Shared\Transfer\ProductListTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \FondOfSpryker\Client\ProductListsRestApi\ProductListsRestApiFactory getFactory()
 */
class ProductListsRestApiClient extends AbstractClient implements ProductListsRestApiClientInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * {@internal will work if UUID field is provided.}
     *
     * @param \Generated\Shared\Transfer\ProductListTransfer $productListTransfer
     *
     * @return \Generated\Shared\Transfer\ProductListResponseTransfer
     */
    public function findProductListByUuid(ProductListTransfer $productListTransfer): ProductListResponseTransfer
    {
        return $this->getFactory()
            ->createZedProductListsRestApiStub()
            ->findProductListByUuid($productListTransfer);
    }
}
