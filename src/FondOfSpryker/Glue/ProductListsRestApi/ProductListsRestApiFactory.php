<?php

namespace FondOfSpryker\Glue\ProductListsRestApi;

use FondOfSpryker\Glue\ProductListsRestApi\Dependency\Client\ProductListsRestApiToCompanyUserClientInterface;
use FondOfSpryker\Glue\ProductListsRestApi\Dependency\Client\ProductListsRestApiToProductListCompanyClientInterface;
use FondOfSpryker\Glue\ProductListsRestApi\Dependency\Client\ProductListsRestApiToProductListCustomerClientInterface;
use FondOfSpryker\Glue\ProductListsRestApi\Processor\ProductLists\ProductListsMapper;
use FondOfSpryker\Glue\ProductListsRestApi\Processor\ProductLists\ProductListsMapperInterface;
use FondOfSpryker\Glue\ProductListsRestApi\Processor\ProductLists\ProductListsReader;
use FondOfSpryker\Glue\ProductListsRestApi\Processor\ProductLists\ProductListsReaderInterface;
use FondOfSpryker\Glue\ProductListsRestApi\Processor\ProductLists\ProductListsResourceRelationshipExpander;
use FondOfSpryker\Glue\ProductListsRestApi\Processor\ProductLists\ProductListsResourceRelationshipExpanderInterface;
use FondOfSpryker\Glue\ProductListsRestApi\Processor\Validation\RestApiError;
use FondOfSpryker\Glue\ProductListsRestApi\Processor\Validation\RestApiErrorInterface;
use Spryker\Glue\Kernel\AbstractFactory;

/**
 * @method \FondOfSpryker\Client\ProductListsRestApi\ProductListsRestApiClientInterface getClient()
 * @method \FondOfSpryker\Glue\ProductListsRestApi\ProductListsRestApiFactory getFactory()
 * @method \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface getResourceBuilder()
 */
class ProductListsRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfSpryker\Glue\ProductListsRestApi\Processor\ProductLists\ProductListsReaderInterface
     */
    public function createProductListsReader(): ProductListsReaderInterface
    {
        return new ProductListsReader(
            $this->getResourceBuilder(),
            $this->createRestApiError(),
            $this->getClient(),
            $this->createProductListsMapper(),
            $this->getCompanyUserClient(),
            $this->getProductListCustomerClient()
        );
    }

    /**
     * @return \FondOfSpryker\Glue\ProductListsRestApi\Processor\ProductLists\ProductListsResourceRelationshipExpanderInterface
     */
    public function createProductListsResourceRelationshipExpander(): ProductListsResourceRelationshipExpanderInterface
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

    /**
     * @throws
     *
     * @return \FondOfSpryker\Glue\ProductListsRestApi\Dependency\Client\ProductListsRestApiToCompanyUserClientInterface
     */
    protected function getCompanyUserClient(): ProductListsRestApiToCompanyUserClientInterface
    {
        return $this->getProvidedDependency(ProductListsRestApiDependencyProvider::CLIENT_COMPANY_USER);
    }

    /**
     * @return \FondOfSpryker\Glue\ProductListsRestApi\Processor\Validation\RestApiErrorInterface
     */
    public function createRestApiError(): RestApiErrorInterface
    {
        return new RestApiError();
    }
}
