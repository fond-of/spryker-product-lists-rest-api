<?php

namespace FondOfSpryker\Zed\ProductListsRestApi\Business;

use Generated\Shared\Transfer\ProductListResponseTransfer;
use Generated\Shared\Transfer\ProductListTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfSpryker\Zed\ProductListsRestApi\Business\ProductListsRestApiBusinessFactory getFactory()
 * @method \FondOfSpryker\Zed\ProductListsRestApi\Persistence\ProductListsRestApiRepositoryInterface getRepository()
 */
class ProductListsRestApiFacade extends AbstractFacade implements ProductListsRestApiFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProductListTransfer $productListTransfer
     *
     * @return \Generated\Shared\Transfer\ProductListResponseTransfer
     */
    public function findProductListByUuid(ProductListTransfer $productListTransfer): ProductListResponseTransfer
    {
        return $this->getFactory()->createProductListsRestApiReader()->findCompanyByUuid($productListTransfer);
    }
}
