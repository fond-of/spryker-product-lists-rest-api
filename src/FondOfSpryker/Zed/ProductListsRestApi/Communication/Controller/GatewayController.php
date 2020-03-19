<?php

namespace FondOfSpryker\Zed\ProductListsRestApi\Communication\Controller;

use Generated\Shared\Transfer\ProductListResponseTransfer;
use Generated\Shared\Transfer\ProductListTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractGatewayController;

/**
 * @method \FondOfSpryker\Zed\ProductListsRestApi\Business\ProductListsRestApiFacadeInterface getFacade()
 */
class GatewayController extends AbstractGatewayController
{
    /**
     * @param \Generated\Shared\Transfer\ProductListTransfer $productListTransfer
     *
     * @return \Generated\Shared\Transfer\ProductListResponseTransfer
     */
    public function findProductListByUuidAction(ProductListTransfer $productListTransfer): ProductListResponseTransfer
    {
        return $this->getFacade()->findProductListByUuid($productListTransfer);
    }
}
