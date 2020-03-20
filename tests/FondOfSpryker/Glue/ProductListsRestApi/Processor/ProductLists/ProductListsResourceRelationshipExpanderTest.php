<?php

namespace FondOfSpryker\Glue\ProductListsRestApi\Processor\ProductLists;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfSpryker\Glue\ProductListsRestApi\Dependency\Client\ProductListsRestApiToProductListCompanyClientInterface;
use FondOfSpryker\Glue\ProductListsRestApi\Dependency\Client\ProductListsRestApiToProductListCustomerClientInterface;
use FondOfSpryker\Glue\ProductListsRestApi\ProductListsRestApiConfig;
use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\ProductListCollectionTransfer;
use Generated\Shared\Transfer\ProductListTransfer;
use Generated\Shared\Transfer\RestProductListsAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class ProductListsResourceRelationshipExpanderTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\ProductListsRestApi\Processor\ProductLists\ProductListsResourceRelationshipExpander
     */
    protected $productListsResourceRelationshipExpander;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilderInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Glue\ProductListsRestApi\Dependency\Client\ProductListsRestApiToProductListCustomerClientInterface
     */
    protected $productListsRestApiToProductListCustomerClientInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Glue\ProductListsRestApi\Dependency\Client\ProductListsRestApiToProductListCompanyClientInterface
     */
    protected $productListsRestApiToProductListCompanyClientInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Glue\ProductListsRestApi\Processor\ProductLists\ProductListsMapperInterface
     */
    protected $productListsMapperInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface
     */
    protected $restRequestInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface
     */
    protected $restResourceInterfaceMock;

    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface[]
     */
    protected $resources;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CustomerTransfer
     */
    protected $customerTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ProductListCollectionTransfer
     */
    protected $productListCollectionTransferMock;

    /**
     * @var \ArrayObject|\Generated\Shared\Transfer\ProductListTransfer[]
     */
    protected $productLists;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ProductListTransfer
     */
    protected $productListTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyUserTransfer
     */
    protected $companyUserTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyTransfer
     */
    protected $companyTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestProductListsAttributesTransfer
     */
    protected $restProductListsAttributesTransferMock;

    /**
     * @var string
     */
    protected $uuid;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->restResourceBuilderInterfaceMock = $this->getMockBuilder(RestResourceBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListsRestApiToProductListCustomerClientInterfaceMock = $this->getMockBuilder(ProductListsRestApiToProductListCustomerClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListsRestApiToProductListCompanyClientInterfaceMock = $this->getMockBuilder(ProductListsRestApiToProductListCompanyClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListsMapperInterfaceMock = $this->getMockBuilder(ProductListsMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRequestInterfaceMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceInterfaceMock = $this->getMockBuilder(RestResourceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->resources = [
            $this->restResourceInterfaceMock,
        ];

        $this->customerTransferMock = $this->getMockBuilder(CustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListCollectionTransferMock = $this->getMockBuilder(ProductListCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListTransferMock = $this->getMockBuilder(ProductListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productLists = new ArrayObject([
            $this->productListTransferMock,
        ]);

        $this->companyUserTransferMock = $this->getMockBuilder(CompanyUserTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyTransferMock = $this->getMockBuilder(CompanyTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restProductListsAttributesTransferMock = $this->getMockBuilder(RestProductListsAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->uuid = 'uuid';

        $this->productListsResourceRelationshipExpander = new ProductListsResourceRelationshipExpander(
            $this->restResourceBuilderInterfaceMock,
            $this->productListsRestApiToProductListCustomerClientInterfaceMock,
            $this->productListsRestApiToProductListCompanyClientInterfaceMock,
            $this->productListsMapperInterfaceMock
        );
    }

    /**
     * @return void
     */
    public function testAddResourceRelationships(): void
    {
        $this->restResourceInterfaceMock->expects($this->atLeastOnce())
            ->method('getPayload')
            ->willReturn($this->customerTransferMock);

        $this->productListsRestApiToProductListCustomerClientInterfaceMock->expects($this->atLeastOnce())
            ->method('getProductListCollectionByCustomerId')
            ->with($this->customerTransferMock)
            ->willReturn($this->productListCollectionTransferMock);

        $this->productListCollectionTransferMock->expects($this->atLeastOnce())
            ->method('getProductLists')
            ->willReturn(new ArrayObject([]));

        $this->customerTransferMock->expects($this->atLeastOnce())
            ->method('getCompanyUserTransfer')
            ->willReturn($this->companyUserTransferMock);

        $this->companyUserTransferMock->expects($this->atLeastOnce())
            ->method('getCompany')
            ->willReturn($this->companyTransferMock);

        $this->productListsRestApiToProductListCompanyClientInterfaceMock->expects($this->atLeastOnce())
            ->method('getProductListCollectionByCompanyId')
            ->with($this->companyTransferMock)
            ->willReturn($this->productListCollectionTransferMock);

        $this->assertIsArray(
            $this->productListsResourceRelationshipExpander->addResourceRelationships(
                $this->resources,
                $this->restRequestInterfaceMock
            )
        );
    }

    /**
     * @return void
     */
    public function testAddResourceRelationshipsPayloadNull(): void
    {
        $this->restResourceInterfaceMock->expects($this->atLeastOnce())
            ->method('getPayload')
            ->willReturn(null);

        $this->assertIsArray(
            $this->productListsResourceRelationshipExpander->addResourceRelationships(
                $this->resources,
                $this->restRequestInterfaceMock
            )
        );
    }

    /**
     * @return void
     */
    public function testAddResourceRelationshipsProductListCollectionGreaterNull(): void
    {
        $this->restResourceInterfaceMock->expects($this->atLeastOnce())
            ->method('getPayload')
            ->willReturn($this->customerTransferMock);

        $this->productListsRestApiToProductListCustomerClientInterfaceMock->expects($this->atLeastOnce())
            ->method('getProductListCollectionByCustomerId')
            ->with($this->customerTransferMock)
            ->willReturn($this->productListCollectionTransferMock);

        $this->productListCollectionTransferMock->expects($this->atLeastOnce())
            ->method('getProductLists')
            ->willReturn($this->productLists);

        $this->productListsMapperInterfaceMock->expects($this->atLeastOnce())
            ->method('mapRestProductListsAttributesTransfer')
            ->with($this->productListTransferMock)
            ->willReturn($this->restProductListsAttributesTransferMock);

        $this->productListTransferMock->expects($this->atLeastOnce())
            ->method('getUuid')
            ->willReturn($this->uuid);

        $this->restResourceBuilderInterfaceMock->expects($this->atLeastOnce())
            ->method('createRestResource')
            ->with(
                ProductListsRestApiConfig::RESOURCE_PRODUCT_LISTS,
                $this->uuid,
                $this->restProductListsAttributesTransferMock
            )->willReturn($this->restResourceInterfaceMock);

        $this->restResourceInterfaceMock->expects($this->atLeastOnce())
            ->method('addRelationship')
            ->with($this->restResourceInterfaceMock)
            ->willReturnSelf();

        $this->assertIsArray(
            $this->productListsResourceRelationshipExpander->addResourceRelationships(
                $this->resources,
                $this->restRequestInterfaceMock
            )
        );
    }

    /**
     * @return void
     */
    public function testAddResourceRelationshipsCompanyUserNull(): void
    {
        $this->restResourceInterfaceMock->expects($this->atLeastOnce())
            ->method('getPayload')
            ->willReturn($this->customerTransferMock);

        $this->productListsRestApiToProductListCustomerClientInterfaceMock->expects($this->atLeastOnce())
            ->method('getProductListCollectionByCustomerId')
            ->with($this->customerTransferMock)
            ->willReturn($this->productListCollectionTransferMock);

        $this->productListCollectionTransferMock->expects($this->atLeastOnce())
            ->method('getProductLists')
            ->willReturn(new ArrayObject([]));

        $this->customerTransferMock->expects($this->atLeastOnce())
            ->method('getCompanyUserTransfer')
            ->willReturn(null);

        $this->assertIsArray(
            $this->productListsResourceRelationshipExpander->addResourceRelationships(
                $this->resources,
                $this->restRequestInterfaceMock
            )
        );
    }

    /**
     * @return void
     */
    public function testAddResourceRelationshipsSecondProductListCollectionGreaterNull(): void
    {
        $this->restResourceInterfaceMock->expects($this->atLeastOnce())
            ->method('getPayload')
            ->willReturn($this->customerTransferMock);

        $this->productListsRestApiToProductListCustomerClientInterfaceMock->expects($this->atLeastOnce())
            ->method('getProductListCollectionByCustomerId')
            ->with($this->customerTransferMock)
            ->willReturn($this->productListCollectionTransferMock);

        $this->productListCollectionTransferMock->expects($this->atLeastOnce())
            ->method('getProductLists')
            ->willReturnOnConsecutiveCalls(
                new ArrayObject([]),
                $this->productLists,
                $this->productLists
            );

        $this->customerTransferMock->expects($this->atLeastOnce())
            ->method('getCompanyUserTransfer')
            ->willReturn($this->companyUserTransferMock);

        $this->companyUserTransferMock->expects($this->atLeastOnce())
            ->method('getCompany')
            ->willReturn($this->companyTransferMock);

        $this->productListsRestApiToProductListCompanyClientInterfaceMock->expects($this->atLeastOnce())
            ->method('getProductListCollectionByCompanyId')
            ->with($this->companyTransferMock)
            ->willReturn($this->productListCollectionTransferMock);

        $this->productListsMapperInterfaceMock->expects($this->atLeastOnce())
            ->method('mapRestProductListsAttributesTransfer')
            ->with($this->productListTransferMock)
            ->willReturn($this->restProductListsAttributesTransferMock);

        $this->productListTransferMock->expects($this->atLeastOnce())
            ->method('getUuid')
            ->willReturn($this->uuid);

        $this->restResourceBuilderInterfaceMock->expects($this->atLeastOnce())
            ->method('createRestResource')
            ->with(
                ProductListsRestApiConfig::RESOURCE_PRODUCT_LISTS,
                $this->uuid,
                $this->restProductListsAttributesTransferMock
            )->willReturn($this->restResourceInterfaceMock);

        $this->restResourceInterfaceMock->expects($this->atLeastOnce())
            ->method('addRelationship')
            ->with($this->restResourceInterfaceMock)
            ->willReturnSelf();

        $this->assertIsArray(
            $this->productListsResourceRelationshipExpander->addResourceRelationships(
                $this->resources,
                $this->restRequestInterfaceMock
            )
        );
    }
}
