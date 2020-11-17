<?php

namespace FondOfSpryker\Glue\ProductListsRestApi\Processor\ProductLists;

use FondOfSpryker\Glue\ProductListsRestApi\Dependency\Client\ProductListsRestApiToProductListCompanyClientInterface;
use FondOfSpryker\Glue\ProductListsRestApi\Dependency\Client\ProductListsRestApiToProductListCustomerClientInterface;
use FondOfSpryker\Glue\ProductListsRestApi\ProductListsRestApiConfig;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\ProductListCollectionTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class ProductListsResourceRelationshipExpander implements ProductListsResourceRelationshipExpanderInterface
{
    /**
     * @var \FondOfSpryker\Glue\ProductListsRestApi\Dependency\Client\ProductListsRestApiToProductListCustomerClientInterface
     */
    protected $productListCustomerClient;

    /**
     * @var \FondOfSpryker\Glue\ProductListsRestApi\Dependency\Client\ProductListsRestApiToProductListCompanyClientInterface
     */
    protected $productListCompanyClient;

    /**
     * @var \FondOfSpryker\Glue\ProductListsRestApi\Processor\ProductLists\ProductListsMapperInterface
     */
    protected $productListsMapper;

    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilder;

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface $restResourceBuilder
     * @param \FondOfSpryker\Glue\ProductListsRestApi\Dependency\Client\ProductListsRestApiToProductListCustomerClientInterface $productListCustomerClient
     * @param \FondOfSpryker\Glue\ProductListsRestApi\Dependency\Client\ProductListsRestApiToProductListCompanyClientInterface $productListCompanyClient
     * @param \FondOfSpryker\Glue\ProductListsRestApi\Processor\ProductLists\ProductListsMapperInterface $productListsMapper
     */
    public function __construct(
        RestResourceBuilderInterface $restResourceBuilder,
        ProductListsRestApiToProductListCustomerClientInterface $productListCustomerClient,
        ProductListsRestApiToProductListCompanyClientInterface $productListCompanyClient,
        ProductListsMapperInterface $productListsMapper
    ) {
        $this->restResourceBuilder = $restResourceBuilder;
        $this->productListCustomerClient = $productListCustomerClient;
        $this->productListCompanyClient = $productListCompanyClient;
        $this->productListsMapper = $productListsMapper;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface[] $resources
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface[]
     */
    public function addResourceRelationships(array $resources, RestRequestInterface $restRequest): array
    {
        foreach ($resources as $resource) {
            /**
             * @var \Generated\Shared\Transfer\CustomerTransfer|null $payload
             */
            $payload = $resource->getPayload();

            if ($payload === null || !($payload instanceof CustomerTransfer)) {
                continue;
            }

            $productListCollectionTransfer = $this->productListCustomerClient
                ->getProductListCollectionByCustomerId($payload);

            if ($productListCollectionTransfer->getProductLists()->count() > 0) {
                $this->addProductListsResourceRelationships($resource, $productListCollectionTransfer);

                continue;
            }

            if ($payload->getCompanyUserTransfer() === null || $payload->getCompanyUserTransfer()->getCompany() === null) {
                continue;
            }

            $productListCollectionTransfer = $this->productListCompanyClient
                ->getProductListCollectionByCompanyId($payload->getCompanyUserTransfer()->getCompany());

            if ($productListCollectionTransfer->getProductLists()->count() > 0) {
                $this->addProductListsResourceRelationships($resource, $productListCollectionTransfer);

                continue;
            }
        }

        return $resources;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface $resource
     * @param \Generated\Shared\Transfer\ProductListCollectionTransfer $productListCollectionTransfer
     *
     * @return void
     */
    protected function addProductListsResourceRelationships(
        RestResourceInterface $resource,
        ProductListCollectionTransfer $productListCollectionTransfer
    ): void {
        foreach ($productListCollectionTransfer->getProductLists() as $productListTransfer) {
            $restProductListsAttributesTransfer = $this->productListsMapper
                ->mapRestProductListsAttributesTransfer($productListTransfer);

            $companyRoleResource = $this->restResourceBuilder->createRestResource(
                ProductListsRestApiConfig::RESOURCE_PRODUCT_LISTS,
                $productListTransfer->getUuid(),
                $restProductListsAttributesTransfer
            );

            $resource->addRelationship($companyRoleResource);
        }
    }
}
