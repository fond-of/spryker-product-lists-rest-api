<?php

namespace FondOfSpryker\Glue\ProductListsRestApi\Processor\ProductLists;

use FondOfSpryker\Client\ProductListsRestApi\ProductListsRestApiClientInterface;
use FondOfSpryker\Glue\ProductListsRestApi\Dependency\Client\ProductListsRestApiToCompanyUserClientInterface;
use FondOfSpryker\Glue\ProductListsRestApi\Dependency\Client\ProductListsRestApiToProductListCustomerClientInterface;
use FondOfSpryker\Glue\ProductListsRestApi\Processor\Validation\RestApiErrorInterface;
use FondOfSpryker\Glue\ProductListsRestApi\ProductListsRestApiConfig;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\ProductListCollectionTransfer;
use Generated\Shared\Transfer\ProductListCompanyRelationTransfer;
use Generated\Shared\Transfer\ProductListCustomerRelationTransfer;
use Generated\Shared\Transfer\ProductListTransfer;
use Generated\Shared\Transfer\RestProductListsAttributesTransfer;
use Generated\Shared\Transfer\RestUserTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class ProductListsReader implements ProductListsReaderInterface
{
    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilder;

    /**
     * @var \FondOfSpryker\Glue\ProductListsRestApi\Processor\Validation\RestApiErrorInterface
     */
    protected $restApiError;

    /**
     * @var \FondOfSpryker\Client\ProductListsRestApi\ProductListsRestApiClientInterface
     */
    protected $productListsClient;

    /**
     * @var \FondOfSpryker\Glue\ProductListsRestApi\Processor\ProductLists\ProductListsMapperInterface
     */
    protected $productListsMapper;

    /**
     * @var \FondOfSpryker\Glue\ProductListsRestApi\Dependency\Client\ProductListsRestApiToCompanyUserClientInterface
     */
    protected $companyUserClient;

    /**
     * @var \FondOfSpryker\Glue\ProductListsRestApi\Dependency\Client\ProductListsRestApiToProductListCustomerClientInterface
     */
    protected $productListCustomerClient;

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
    ) {
        $this->restResourceBuilder = $restResourceBuilder;
        $this->restApiError = $restApiError;
        $this->productListsClient = $productListsClient;
        $this->productListsMapper = $productListsMapper;
        $this->companyUserClient = $companyUserClient;
        $this->productListCustomerClient = $productListCustomerClient;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function findAllProductListsByCustomerId(RestRequestInterface $restRequest): RestResponseInterface
    {
        $restResponse = $this->restResourceBuilder->createRestResponse();

        $customerTransfer = (new CustomerTransfer())
            ->setIdCustomer($restRequest->getRestUser()->getSurrogateIdentifier());

        $productListCollectionTransfer = $this->productListCustomerClient
            ->getProductListCollectionByCustomerId($customerTransfer);

        if ($productListCollectionTransfer->getProductLists()->count() === 0) {
            return $this->restApiError->addProductListNotFoundError($restResponse);
        }

        return $this->addProductListCollectionTransferToResponse($productListCollectionTransfer, $restResponse);
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function findProductListByUuid(RestRequestInterface $restRequest): RestResponseInterface
    {
        $restResponse = $this->restResourceBuilder->createRestResponse();

        if (!$restRequest->getResource()->getId()) {
            return $this->restApiError->addProductListUuidMissingError($restResponse);
        }

        $productListTransfer = (new ProductListTransfer())
            ->setUuid($restRequest->getResource()->getId());

        $productListResponseTransfer = $this->productListsClient
            ->findProductListByUuid($productListTransfer);

        if (!$productListResponseTransfer->getIsSuccessful()) {
            return $this->restApiError->addProductListNotFoundError($restResponse);
        }

        if (!$this->isProductListAssignedToCurrentUser($productListResponseTransfer->getProductList(), $restRequest->getRestUser())) {
            return $this->restApiError->addProductListNoPermissionError($restResponse);
        }

        $restProductListsAttributesTransfer = $this->productListsMapper
            ->mapProductListTransferToRestProductListResponseAttributesTransfer(
                $productListResponseTransfer->getProductList(),
                new RestProductListsAttributesTransfer()
            );

        return $this->addRestProductListsAttributesTransferToResponse($restProductListsAttributesTransfer, $restResponse);
    }

    /**
     * @param \Generated\Shared\Transfer\ProductListTransfer $productListTransfer
     * @param \Generated\Shared\Transfer\RestUserTransfer|null $restUserTransfer
     *
     * @return bool
     */
    protected function isProductListAssignedToCurrentUser(
        ProductListTransfer $productListTransfer,
        ?RestUserTransfer $restUserTransfer
    ): bool {
        if ($restUserTransfer === null) {
            return false;
        }

        if (
            $this->isProductListAssignedToCustomer(
                $productListTransfer->getProductListCustomerRelation(),
                $restUserTransfer
            )
        ) {
            return true;
        }

        if (
            $this->isProductListAssignedToCompanyUser(
                $productListTransfer->getProductListCompanyRelation(),
                $restUserTransfer
            )
        ) {
            return true;
        }

        return false;
    }

    /**
     * @param \Generated\Shared\Transfer\ProductListCustomerRelationTransfer|null $productListCustomerRelationTransfer
     * @param \Generated\Shared\Transfer\RestUserTransfer $restUserTransfer
     *
     * @return bool
     */
    protected function isProductListAssignedToCustomer(
        ?ProductListCustomerRelationTransfer $productListCustomerRelationTransfer,
        RestUserTransfer $restUserTransfer
    ): bool {
        if ($productListCustomerRelationTransfer === null) {
            return false;
        }

        return in_array($restUserTransfer->getSurrogateIdentifier(), $productListCustomerRelationTransfer->getCustomerIds(), true);
    }

    /**
     * @param \Generated\Shared\Transfer\ProductListCompanyRelationTransfer|null $productListCompanyRelationTransfer
     * @param \Generated\Shared\Transfer\RestUserTransfer $restUserTransfer
     *
     * @return bool
     */
    protected function isProductListAssignedToCompanyUser(
        ?ProductListCompanyRelationTransfer $productListCompanyRelationTransfer,
        RestUserTransfer $restUserTransfer
    ): bool {
        if ($productListCompanyRelationTransfer === null) {
            return false;
        }

        $customerTransfer = (new CustomerTransfer())
            ->setCustomerReference($restUserTransfer->getNaturalIdentifier());

        $companyUserCollection = $this->companyUserClient->getActiveCompanyUsersByCustomerReference($customerTransfer);

        foreach ($companyUserCollection->getCompanyUsers() as $companyUserTransfer) {
            if ($companyUserTransfer->getCompany() === null) {
                continue;
            }

            if (
                in_array(
                    $companyUserTransfer->getCompany()->getIdCompany(),
                    $productListCompanyRelationTransfer->getCompanyIds(),
                    true
                )
            ) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param \Generated\Shared\Transfer\ProductListCollectionTransfer $productListCollectionTransfer
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface $restResponse
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected function addProductListCollectionTransferToResponse(
        ProductListCollectionTransfer $productListCollectionTransfer,
        RestResponseInterface $restResponse
    ): RestResponseInterface {
        foreach ($productListCollectionTransfer->getProductLists() as $productListTransfer) {
            $restProductListsAttributesTransfer = $this->productListsMapper
                ->mapProductListTransferToRestProductListResponseAttributesTransfer(
                    $productListTransfer,
                    new RestProductListsAttributesTransfer()
                );

            $this->addRestProductListsAttributesTransferToResponse($restProductListsAttributesTransfer, $restResponse);
        }

        return $restResponse;
    }

    /**
     * @param \Generated\Shared\Transfer\RestProductListsAttributesTransfer $restProductListsAttributesTransfer
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface $restResponse
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected function addRestProductListsAttributesTransferToResponse(
        RestProductListsAttributesTransfer $restProductListsAttributesTransfer,
        RestResponseInterface $restResponse
    ): RestResponseInterface {
        $restResource = $this->restResourceBuilder->createRestResource(
            ProductListsRestApiConfig::RESOURCE_PRODUCT_LISTS,
            $restProductListsAttributesTransfer->getUuid(),
            $restProductListsAttributesTransfer
        );

        return $restResponse->addResource($restResource);
    }
}
