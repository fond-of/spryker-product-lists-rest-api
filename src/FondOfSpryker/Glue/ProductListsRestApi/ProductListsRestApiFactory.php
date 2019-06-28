<?php

namespace FondOfSpryker\Glue\ProductListsRestApi;

use FondOfSpryker\Glue\ProductListsRestApi\Dependency\Client\ProductListsRestApiToProductListCompanyClientInterface;
use FondOfSpryker\Glue\ProductListsRestApi\Dependency\Client\ProductListsRestApiToProductListCustomerClientInterface;
use FondOfSpryker\Glue\ProductListsRestApi\Processor\ProductLists\ProductListsMapper;
use FondOfSpryker\Glue\ProductListsRestApi\Processor\ProductLists\ProductListsMapperInterface;
use FondOfSpryker\Glue\ProductListsRestApi\Processor\ProductLists\ProductListsResourceRelationshipExpander;
use FondOfSpryker\Glue\ProductListsRestApi\Processor\ProductLists\ProductListsResourceRelationshipExpanderInterface;
use Spryker\Glue\Kernel\AbstractFactory;

/**
 * @method \FondOfSpryker\Glue\ProductListsRestApi\ProductListsRestApiFactory getFactory()
 * @method \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface getResourceBuilder()
 */
class ProductListsRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfSpryker\Glue\ProductListsRestApi\Processor\ProductLists\ProductListsResourceRelationshipExpanderInterface
     */
    public function creatProductListsResourceRelationshipExpander(): ProductListsResourceRelationshipExpanderInterface
    {
        return new ProductListsResourceRelationshipExpander(
            $this->getResourceBuilder(),
            $this->getProductListCustomerClient(),
            $this->getProductListCompanyClient(),
            $this->createProductListsMapper()
        );
    }

    /**
     * @return \FondOfSpryker\Glue\ProductListsRestApi\Processor\ProductLists\ProductListsMapperInterface
     */
    public function createProductListsMapper(): ProductListsMapperInterface
    {
        return new ProductListsMapper();
    }

    /**
     * @throws
     *
     * @return \FondOfSpryker\Glue\ProductListsRestApi\Dependency\Client\ProductListsRestApiToProductListCompanyClientInterface
     */
    protected function getProductListCompanyClient(): ProductListsRestApiToProductListCompanyClientInterface
    {
        return $this->getProvidedDependency(ProductListsRestApiDependencyProvider::CLIENT_PRODUCT_LIST_COMPANY);
    }

    /**
     * @throws
     *
     * @return \FondOfSpryker\Glue\ProductListsRestApi\Dependency\Client\ProductListsRestApiToProductListCustomerClientInterface
     */
    protected function getProductListCustomerClient(): ProductListsRestApiToProductListCustomerClientInterface
    {
        return $this->getProvidedDependency(ProductListsRestApiDependencyProvider::CLIENT_PRODUCT_LIST_CUSTOMER);
    }
}
