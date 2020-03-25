<?php

namespace FondOfSpryker\Zed\ProductListsRestApi\Business;

use FondOfSpryker\Zed\ProductListsRestApi\Business\Reader\ProductListsReader;
use FondOfSpryker\Zed\ProductListsRestApi\Business\Reader\ProductListsReaderInterface;
use FondOfSpryker\Zed\ProductListsRestApi\ProductListsRestApiDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use Spryker\Zed\ProductList\Business\ProductListFacadeInterface;

/**
 * @method \FondOfSpryker\Zed\ProductListsRestApi\Persistence\ProductListsRestApiRepositoryInterface getRepository()
 */
class ProductListsRestApiBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfSpryker\Zed\ProductListsRestApi\Business\Reader\ProductListsReaderInterface
     */
    public function createProductListsRestApiReader(): ProductListsReaderInterface
    {
        return new ProductListsReader(
            $this->getRepository(),
            $this->getProductListFacade()
        );
    }

    /**
     * @return \Spryker\Zed\ProductList\Business\ProductListFacadeInterface
     */
    protected function getProductListFacade(): ProductListFacadeInterface
    {
        return $this->getProvidedDependency(ProductListsRestApiDependencyProvider::PRODUCT_LIST_FACADE);
    }
}
