<?php

namespace FondOfSpryker\Zed\ProductListsRestApi\Business;

use FondOfSpryker\Zed\ProductList\Business\ProductListFacadeInterface;
use FondOfSpryker\Zed\ProductListsRestApi\Business\Reader\ProductListsReader;
use FondOfSpryker\Zed\ProductListsRestApi\Business\Reader\ProductListsReaderInterface;
use FondOfSpryker\Zed\ProductListsRestApi\ProductListsRestApiDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

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
     * @throws
     *
     * @return \FondOfSpryker\Zed\ProductList\Business\ProductListFacadeInterface
     */
    public function getProductListFacade(): ProductListFacadeInterface
    {
        return $this->getProvidedDependency(ProductListsRestApiDependencyProvider::PRODUCT_LIST_FACADE);
    }
}
