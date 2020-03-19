<?php

namespace FondOfSpryker\Glue\ProductListsRestApi\Processor\ProductLists;

use FondOfSpryker\Client\ProductListsRestApi\ProductListsRestApiClientInterface;
use FondOfSpryker\Glue\ProductListsRestApi\Dependency\Client\ProductListsRestApiToCompanyUserClientInterface;
use FondOfSpryker\Glue\ProductListsRestApi\Dependency\Client\ProductListsRestApiToProductListCustomerClientInterface;
use FondOfSpryker\Glue\ProductListsRestApi\Processor\Validation\RestApiErrorInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

interface ProductListsReaderInterface
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface $restResourceBuilder
     * @param \FondOfSpryker\Glue\ProductListsRestApi\Processor\Validation\RestApiErrorInterface $restApiError
     * @param \FondOfSpryker\Client\ProductListsRestApi\ProductListsRestApiClientInterface $productListsClient
     * @param \FondOfSpryker\Glue\ProductListsRestApi\Processor\ProductLists\ProductListsMapperInterface $productListsMapper
     * @param \FondOfSpryker\Glue\ProductListsRestApi\Dependency\Client\ProductListsRestApiToCompanyUserClientInterface $companyUserClient
     * @param \FondOfSpryker\Glue\ProductListsRestApi\Dependency\Client\ProductListsRestApiToProductListCustomerClientInterface $productListCustomerClient
     */
    public function __construct(
        RestResourceBuilderInterface $restResourceBuilder,
        RestApiErrorInterface $restApiError,
        ProductListsRestApiClientInterface $productListsClient,
        ProductListsMapperInterface $productListsMapper,
        ProductListsRestApiToCompanyUserClientInterface $companyUserClient,
        ProductListsRestApiToProductListCustomerClientInterface $productListCustomerClient
    );

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function findAllProductListsByCustomerId(RestRequestInterface $restRequest): RestResponseInterface;

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function findProductListByUuid(RestRequestInterface $restRequest): RestResponseInterface;
}
