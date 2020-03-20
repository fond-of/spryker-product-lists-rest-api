<?php

namespace FondOfSpryker\Glue\ProductListsRestApi\Processor\ProductLists;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfSpryker\Client\ProductListsRestApi\ProductListsRestApiClientInterface;
use FondOfSpryker\Glue\ProductListsRestApi\Dependency\Client\ProductListsRestApiToCompanyUserClientInterface;
use FondOfSpryker\Glue\ProductListsRestApi\Dependency\Client\ProductListsRestApiToProductListCustomerClientInterface;
use FondOfSpryker\Glue\ProductListsRestApi\Processor\Validation\RestApiErrorInterface;
use FondOfSpryker\Glue\ProductListsRestApi\ProductListsRestApiConfig;
use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\CompanyUserCollectionTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\ProductListCollectionTransfer;
use Generated\Shared\Transfer\ProductListCompanyRelationTransfer;
use Generated\Shared\Transfer\ProductListCustomerRelationTransfer;
use Generated\Shared\Transfer\ProductListResponseTransfer;
use Generated\Shared\Transfer\ProductListTransfer;
use Generated\Shared\Transfer\RestProductListsAttributesTransfer;
use Generated\Shared\Transfer\RestUserTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class ProductListsReaderTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\ProductListsRestApi\Processor\ProductLists\ProductListsReader
     */
    protected $productListsReader;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilderInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Glue\ProductListsRestApi\Processor\Validation\RestApiErrorInterface
     */
    protected $restApiErrorInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Client\ProductListsRestApi\ProductListsRestApiClientInterface
     */
    protected $productListsRestApiClientInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Glue\ProductListsRestApi\Processor\ProductLists\ProductListsMapperInterface
     */
    protected $productListsMapperInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Glue\ProductListsRestApi\Dependency\Client\ProductListsRestApiToCompanyUserClientInterface
     */
    protected $productListsRestApiToCompanyUserClientInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Glue\ProductListsRestApi\Dependency\Client\ProductListsRestApiToProductListCustomerClientInterface
     */
    protected $productListsRestApiToProductListCustomerClientInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface
     */
    protected $restRequestInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected $restResponseInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestUserTransfer
     */
    protected $restUserTransferMock;

    /**
     * @var int
     */
    protected $surrogateIdentifier;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ProductListCollectionTransfer
     */
    protected $productListCollectionTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ProductListTransfer
     */
    protected $productListTransferMock;

    /**
     * @var \ArrayObject|\Generated\Shared\Transfer\ProductListTransfer[]
     */
    protected $productListTransferMocks;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestProductListsAttributesTransfer
     */
    protected $restProductListsAttributesTransferMock;

    /**
     * @var string
     */
    protected $uuid;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface
     */
    protected $restResourceInterfaceMock;

    /**
     * @var string
     */
    protected $id;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ProductListResponseTransfer
     */
    protected $productListResponseTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ProductListCustomerRelationTransfer
     */
    protected $productListCustomerRelationTransferMock;

    /**
     * @var int[]
     */
    protected $customerIds;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ProductListCompanyRelationTransfer
     */
    protected $productListCompanyRelationTransferMock;

    /**
     * @var string
     */
    protected $naturalIdentifier;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyUserCollectionTransfer
     */
    protected $companyUserCollectionTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyUserTransfer
     */
    protected $companyUserTransferMock;

    /**
     * @var \ArrayObject|\Generated\Shared\Transfer\CompanyUserTransfer[]
     */
    protected $companyUserTransferMocks;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyTransfer
     */
    protected $companyTransferMock;

    /**
     * @var int
     */
    protected $idCompany;

    /**
     * @var array
     */
    protected $companyIds;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->restResourceBuilderInterfaceMock = $this->getMockBuilder(RestResourceBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restApiErrorInterfaceMock = $this->getMockBuilder(RestApiErrorInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListsRestApiClientInterfaceMock = $this->getMockBuilder(ProductListsRestApiClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListsMapperInterfaceMock = $this->getMockBuilder(ProductListsMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListsRestApiToCompanyUserClientInterfaceMock = $this->getMockBuilder(ProductListsRestApiToCompanyUserClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListsRestApiToProductListCustomerClientInterfaceMock = $this->getMockBuilder(ProductListsRestApiToProductListCustomerClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRequestInterfaceMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseInterfaceMock = $this->getMockBuilder(RestResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restUserTransferMock = $this->getMockBuilder(RestUserTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->surrogateIdentifier = 1;

        $this->productListCollectionTransferMock = $this->getMockBuilder(ProductListCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListTransferMock = $this->getMockBuilder(ProductListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListTransferMocks = new ArrayObject([
            $this->productListTransferMock,
        ]);

        $this->restProductListsAttributesTransferMock = $this->getMockBuilder(RestProductListsAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->uuid = 'uuid';

        $this->restResourceInterfaceMock = $this->getMockBuilder(RestResourceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->id = 'id';

        $this->productListResponseTransferMock = $this->getMockBuilder(ProductListResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListCustomerRelationTransferMock = $this->getMockBuilder(ProductListCustomerRelationTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerIds = [
          2,
          3,
        ];

        $this->productListCompanyRelationTransferMock = $this->getMockBuilder(ProductListCompanyRelationTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->naturalIdentifier = 'natural-identifier';

        $this->companyUserCollectionTransferMock = $this->getMockBuilder(CompanyUserCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserTransferMock = $this->getMockBuilder(CompanyUserTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserTransferMocks = new ArrayObject([
            $this->companyUserTransferMock,
        ]);

        $this->companyTransferMock = $this->getMockBuilder(CompanyTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->idCompany = 4;

        $this->companyIds = [
            4,
            5,
        ];

        $this->productListsReader = new ProductListsReader(
            $this->restResourceBuilderInterfaceMock,
            $this->restApiErrorInterfaceMock,
            $this->productListsRestApiClientInterfaceMock,
            $this->productListsMapperInterfaceMock,
            $this->productListsRestApiToCompanyUserClientInterfaceMock,
            $this->productListsRestApiToProductListCustomerClientInterfaceMock
        );
    }

    /**
     * @return void
     */
    public function testFindAllProductListsByCustomerId(): void
    {
        $this->restResourceBuilderInterfaceMock->expects($this->atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseInterfaceMock);

        $this->restRequestInterfaceMock->expects($this->atLeastOnce())
            ->method('getRestUser')
            ->willReturn($this->restUserTransferMock);

        $this->restUserTransferMock->expects($this->atLeastOnce())
            ->method('getSurrogateIdentifier')
            ->willReturn($this->surrogateIdentifier);

        $this->productListsRestApiToProductListCustomerClientInterfaceMock->expects($this->atLeastOnce())
            ->method('getProductListCollectionByCustomerId')
            ->willReturn($this->productListCollectionTransferMock);

        $this->productListCollectionTransferMock->expects($this->atLeastOnce())
            ->method('getProductLists')
            ->willReturn($this->productListTransferMocks);

        $this->productListsMapperInterfaceMock->expects($this->atLeastOnce())
            ->method('mapProductListTransferToRestProductListResponseAttributesTransfer')
            ->with($this->productListTransferMock)
            ->willReturn($this->restProductListsAttributesTransferMock);

        $this->restProductListsAttributesTransferMock->expects($this->atLeastOnce())
            ->method('getUuid')
            ->willReturn($this->uuid);

        $this->restResourceBuilderInterfaceMock->expects($this->atLeastOnce())
            ->method('createRestResource')
            ->with(
                ProductListsRestApiConfig::RESOURCE_PRODUCT_LISTS,
                $this->uuid,
                $this->restProductListsAttributesTransferMock
            )->willReturn($this->restResourceInterfaceMock);

        $this->restResponseInterfaceMock->expects($this->atLeastOnce())
            ->method('addResource')
            ->with($this->restResourceInterfaceMock)
            ->willReturnSelf();

        $this->assertInstanceOf(
            RestResponseInterface::class,
            $this->productListsReader->findAllProductListsByCustomerId(
                $this->restRequestInterfaceMock
            )
        );
    }

    /**
     * @return void
     */
    public function testFindAllProductListsByCustomerIdProductListNotFound(): void
    {
        $this->restResourceBuilderInterfaceMock->expects($this->atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseInterfaceMock);

        $this->restRequestInterfaceMock->expects($this->atLeastOnce())
            ->method('getRestUser')
            ->willReturn($this->restUserTransferMock);

        $this->restUserTransferMock->expects($this->atLeastOnce())
            ->method('getSurrogateIdentifier')
            ->willReturn($this->surrogateIdentifier);

        $this->productListsRestApiToProductListCustomerClientInterfaceMock->expects($this->atLeastOnce())
            ->method('getProductListCollectionByCustomerId')
            ->willReturn($this->productListCollectionTransferMock);

        $this->productListCollectionTransferMock->expects($this->atLeastOnce())
            ->method('getProductLists')
            ->willReturn(new ArrayObject([]));

        $this->restApiErrorInterfaceMock->expects($this->atLeastOnce())
            ->method('addProductListNotFoundError')
            ->with($this->restResponseInterfaceMock)
            ->willReturn($this->restResponseInterfaceMock);

        $this->assertInstanceOf(
            RestResponseInterface::class,
            $this->productListsReader->findAllProductListsByCustomerId(
                $this->restRequestInterfaceMock
            )
        );
    }

    /**
     * @return void
     */
    public function testFindProductListByUuid(): void
    {
        $this->restResourceBuilderInterfaceMock->expects($this->atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseInterfaceMock);

        $this->restRequestInterfaceMock->expects($this->atLeastOnce())
            ->method('getResource')
            ->willReturn($this->restResourceInterfaceMock);

        $this->restResourceInterfaceMock->expects($this->atLeastOnce())
            ->method('getId')
            ->willReturn($this->id);

        $this->productListsRestApiClientInterfaceMock->expects($this->atLeastOnce())
            ->method('findProductListByUuid')
            ->willReturn($this->productListResponseTransferMock);

        $this->productListResponseTransferMock->expects($this->atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(true);

        $this->productListResponseTransferMock->expects($this->atLeastOnce())
            ->method('getProductList')
            ->willReturn($this->productListTransferMock);

        $this->restRequestInterfaceMock->expects($this->atLeastOnce())
            ->method('getRestUser')
            ->willReturn($this->restUserTransferMock);

        $this->productListTransferMock->expects($this->atLeastOnce())
            ->method('getProductListCustomerRelation')
            ->willReturn($this->productListCustomerRelationTransferMock);

        $this->restUserTransferMock->expects($this->atLeastOnce())
            ->method('getSurrogateIdentifier')
            ->willReturn($this->surrogateIdentifier);

        $this->productListCustomerRelationTransferMock->expects($this->atLeastOnce())
            ->method('getCustomerIds')
            ->willReturn($this->customerIds);

        $this->productListTransferMock->expects($this->atLeastOnce())
            ->method('getProductListCompanyRelation')
            ->willReturn($this->productListCompanyRelationTransferMock);

        $this->restUserTransferMock->expects($this->atLeastOnce())
            ->method('getNaturalIdentifier')
            ->willReturn($this->naturalIdentifier);

        $this->productListsRestApiToCompanyUserClientInterfaceMock->expects($this->atLeastOnce())
            ->method('getActiveCompanyUsersByCustomerReference')
            ->willReturn($this->companyUserCollectionTransferMock);

        $this->companyUserCollectionTransferMock->expects($this->atLeastOnce())
            ->method('getCompanyUsers')
            ->willReturn($this->companyUserTransferMocks);

        $this->companyUserTransferMock->expects($this->atLeastOnce())
            ->method('getCompany')
            ->willReturn($this->companyTransferMock);

        $this->companyTransferMock->expects($this->atLeastOnce())
            ->method('getIdCompany')
            ->willReturn($this->idCompany);

        $this->productListCompanyRelationTransferMock->expects($this->atLeastOnce())
            ->method('getCompanyIds')
            ->willReturn($this->companyIds);

        $this->productListsMapperInterfaceMock->expects($this->atLeastOnce())
            ->method('mapProductListTransferToRestProductListResponseAttributesTransfer')
            ->with($this->productListTransferMock)
            ->willReturn($this->restProductListsAttributesTransferMock);

        $this->restProductListsAttributesTransferMock->expects($this->atLeastOnce())
            ->method('getUuid')
            ->willReturn($this->uuid);

        $this->restResourceBuilderInterfaceMock->expects($this->atLeastOnce())
            ->method('createRestResource')
            ->with(
                ProductListsRestApiConfig::RESOURCE_PRODUCT_LISTS,
                $this->uuid,
                $this->restProductListsAttributesTransferMock
            )->willReturn($this->restResourceInterfaceMock);

        $this->restResponseInterfaceMock->expects($this->atLeastOnce())
            ->method('addResource')
            ->with($this->restResourceInterfaceMock)
            ->willReturnSelf();

        $this->assertInstanceOf(
            RestResponseInterface::class,
            $this->productListsReader->findProductListByUuid(
                $this->restRequestInterfaceMock
            )
        );
    }

    /**
     * @return void
     */
    public function testFindProductListByUuidCustomerRelation(): void
    {
        $this->restResourceBuilderInterfaceMock->expects($this->atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseInterfaceMock);

        $this->restRequestInterfaceMock->expects($this->atLeastOnce())
            ->method('getResource')
            ->willReturn($this->restResourceInterfaceMock);

        $this->restResourceInterfaceMock->expects($this->atLeastOnce())
            ->method('getId')
            ->willReturn($this->id);

        $this->productListsRestApiClientInterfaceMock->expects($this->atLeastOnce())
            ->method('findProductListByUuid')
            ->willReturn($this->productListResponseTransferMock);

        $this->productListResponseTransferMock->expects($this->atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(true);

        $this->productListResponseTransferMock->expects($this->atLeastOnce())
            ->method('getProductList')
            ->willReturn($this->productListTransferMock);

        $this->restRequestInterfaceMock->expects($this->atLeastOnce())
            ->method('getRestUser')
            ->willReturn($this->restUserTransferMock);

        $this->productListTransferMock->expects($this->atLeastOnce())
            ->method('getProductListCustomerRelation')
            ->willReturn($this->productListCustomerRelationTransferMock);

        $this->restUserTransferMock->expects($this->atLeastOnce())
            ->method('getSurrogateIdentifier')
            ->willReturn(2);

        $this->productListCustomerRelationTransferMock->expects($this->atLeastOnce())
            ->method('getCustomerIds')
            ->willReturn($this->customerIds);

        $this->productListsMapperInterfaceMock->expects($this->atLeastOnce())
            ->method('mapProductListTransferToRestProductListResponseAttributesTransfer')
            ->with($this->productListTransferMock)
            ->willReturn($this->restProductListsAttributesTransferMock);

        $this->restProductListsAttributesTransferMock->expects($this->atLeastOnce())
            ->method('getUuid')
            ->willReturn($this->uuid);

        $this->restResourceBuilderInterfaceMock->expects($this->atLeastOnce())
            ->method('createRestResource')
            ->with(
                ProductListsRestApiConfig::RESOURCE_PRODUCT_LISTS,
                $this->uuid,
                $this->restProductListsAttributesTransferMock
            )->willReturn($this->restResourceInterfaceMock);

        $this->restResponseInterfaceMock->expects($this->atLeastOnce())
            ->method('addResource')
            ->with($this->restResourceInterfaceMock)
            ->willReturnSelf();

        $this->assertInstanceOf(
            RestResponseInterface::class,
            $this->productListsReader->findProductListByUuid(
                $this->restRequestInterfaceMock
            )
        );
    }

    /**
     * @return void
     */
    public function testFindProductListByUuidProductListUuidMissing(): void
    {
        $this->restResourceBuilderInterfaceMock->expects($this->atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseInterfaceMock);

        $this->restRequestInterfaceMock->expects($this->atLeastOnce())
            ->method('getResource')
            ->willReturn($this->restResourceInterfaceMock);

        $this->restResourceInterfaceMock->expects($this->atLeastOnce())
            ->method('getId')
            ->willReturn(null);

        $this->restApiErrorInterfaceMock->expects($this->atLeastOnce())
            ->method('addProductListUuidMissingError')
            ->with($this->restResponseInterfaceMock)
            ->willReturn($this->restResponseInterfaceMock);

        $this->assertInstanceOf(
            RestResponseInterface::class,
            $this->productListsReader->findProductListByUuid(
                $this->restRequestInterfaceMock
            )
        );
    }

    /**
     * @return void
     */
    public function testFindProductListByUuidProductListNotFoundError(): void
    {
        $this->restResourceBuilderInterfaceMock->expects($this->atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseInterfaceMock);

        $this->restRequestInterfaceMock->expects($this->atLeastOnce())
            ->method('getResource')
            ->willReturn($this->restResourceInterfaceMock);

        $this->restResourceInterfaceMock->expects($this->atLeastOnce())
            ->method('getId')
            ->willReturn($this->id);

        $this->productListsRestApiClientInterfaceMock->expects($this->atLeastOnce())
            ->method('findProductListByUuid')
            ->willReturn($this->productListResponseTransferMock);

        $this->productListResponseTransferMock->expects($this->atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(false);

        $this->restApiErrorInterfaceMock->expects($this->atLeastOnce())
            ->method('addProductListNotFoundError')
            ->with($this->restResponseInterfaceMock)
            ->willReturn($this->restResponseInterfaceMock);

        $this->assertInstanceOf(
            RestResponseInterface::class,
            $this->productListsReader->findProductListByUuid(
                $this->restRequestInterfaceMock
            )
        );
    }

    /**
     * @return void
     */
    public function testFindProductListByUuidProductListNoPermission(): void
    {
        $this->restResourceBuilderInterfaceMock->expects($this->atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseInterfaceMock);

        $this->restRequestInterfaceMock->expects($this->atLeastOnce())
            ->method('getResource')
            ->willReturn($this->restResourceInterfaceMock);

        $this->restResourceInterfaceMock->expects($this->atLeastOnce())
            ->method('getId')
            ->willReturn($this->id);

        $this->productListsRestApiClientInterfaceMock->expects($this->atLeastOnce())
            ->method('findProductListByUuid')
            ->willReturn($this->productListResponseTransferMock);

        $this->productListResponseTransferMock->expects($this->atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(true);

        $this->productListResponseTransferMock->expects($this->atLeastOnce())
            ->method('getProductList')
            ->willReturn($this->productListTransferMock);

        $this->restRequestInterfaceMock->expects($this->atLeastOnce())
            ->method('getRestUser')
            ->willReturn($this->restUserTransferMock);

        $this->productListTransferMock->expects($this->atLeastOnce())
            ->method('getProductListCustomerRelation')
            ->willReturn($this->productListCustomerRelationTransferMock);

        $this->restUserTransferMock->expects($this->atLeastOnce())
            ->method('getSurrogateIdentifier')
            ->willReturn($this->surrogateIdentifier);

        $this->productListCustomerRelationTransferMock->expects($this->atLeastOnce())
            ->method('getCustomerIds')
            ->willReturn($this->customerIds);

        $this->productListTransferMock->expects($this->atLeastOnce())
            ->method('getProductListCompanyRelation')
            ->willReturn($this->productListCompanyRelationTransferMock);

        $this->restUserTransferMock->expects($this->atLeastOnce())
            ->method('getNaturalIdentifier')
            ->willReturn($this->naturalIdentifier);

        $this->productListsRestApiToCompanyUserClientInterfaceMock->expects($this->atLeastOnce())
            ->method('getActiveCompanyUsersByCustomerReference')
            ->willReturn($this->companyUserCollectionTransferMock);

        $this->companyUserCollectionTransferMock->expects($this->atLeastOnce())
            ->method('getCompanyUsers')
            ->willReturn($this->companyUserTransferMocks);

        $this->companyUserTransferMock->expects($this->atLeastOnce())
            ->method('getCompany')
            ->willReturn($this->companyTransferMock);

        $this->companyTransferMock->expects($this->atLeastOnce())
            ->method('getIdCompany')
            ->willReturn($this->idCompany);

        $this->productListCompanyRelationTransferMock->expects($this->atLeastOnce())
            ->method('getCompanyIds')
            ->willReturn([]);

        $this->restApiErrorInterfaceMock->expects($this->atLeastOnce())
            ->method('addProductListNoPermissionError')
            ->with($this->restResponseInterfaceMock)
            ->willReturn($this->restResponseInterfaceMock);

        $this->assertInstanceOf(
            RestResponseInterface::class,
            $this->productListsReader->findProductListByUuid(
                $this->restRequestInterfaceMock
            )
        );
    }

    /**
     * @return void
     */
    public function testFindProductListByUuidProductListNoPermissionRestUserNull(): void
    {
        $this->restResourceBuilderInterfaceMock->expects($this->atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseInterfaceMock);

        $this->restRequestInterfaceMock->expects($this->atLeastOnce())
            ->method('getResource')
            ->willReturn($this->restResourceInterfaceMock);

        $this->restResourceInterfaceMock->expects($this->atLeastOnce())
            ->method('getId')
            ->willReturn($this->id);

        $this->productListsRestApiClientInterfaceMock->expects($this->atLeastOnce())
            ->method('findProductListByUuid')
            ->willReturn($this->productListResponseTransferMock);

        $this->productListResponseTransferMock->expects($this->atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(true);

        $this->productListResponseTransferMock->expects($this->atLeastOnce())
            ->method('getProductList')
            ->willReturn($this->productListTransferMock);

        $this->restRequestInterfaceMock->expects($this->atLeastOnce())
            ->method('getRestUser')
            ->willReturn(null);

        $this->restApiErrorInterfaceMock->expects($this->atLeastOnce())
            ->method('addProductListNoPermissionError')
            ->with($this->restResponseInterfaceMock)
            ->willReturn($this->restResponseInterfaceMock);

        $this->assertInstanceOf(
            RestResponseInterface::class,
            $this->productListsReader->findProductListByUuid(
                $this->restRequestInterfaceMock
            )
        );
    }

    /**
     * @return void
     */
    public function testFindProductListByUuidProductListNoPermissionProductListCustomerRelationNull(): void
    {
        $this->restResourceBuilderInterfaceMock->expects($this->atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseInterfaceMock);

        $this->restRequestInterfaceMock->expects($this->atLeastOnce())
            ->method('getResource')
            ->willReturn($this->restResourceInterfaceMock);

        $this->restResourceInterfaceMock->expects($this->atLeastOnce())
            ->method('getId')
            ->willReturn($this->id);

        $this->productListsRestApiClientInterfaceMock->expects($this->atLeastOnce())
            ->method('findProductListByUuid')
            ->willReturn($this->productListResponseTransferMock);

        $this->productListResponseTransferMock->expects($this->atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(true);

        $this->productListResponseTransferMock->expects($this->atLeastOnce())
            ->method('getProductList')
            ->willReturn($this->productListTransferMock);

        $this->restRequestInterfaceMock->expects($this->atLeastOnce())
            ->method('getRestUser')
            ->willReturn($this->restUserTransferMock);

        $this->productListTransferMock->expects($this->atLeastOnce())
            ->method('getProductListCustomerRelation')
            ->willReturn(null);

        $this->restApiErrorInterfaceMock->expects($this->atLeastOnce())
            ->method('addProductListNoPermissionError')
            ->with($this->restResponseInterfaceMock)
            ->willReturn($this->restResponseInterfaceMock);

        $this->assertInstanceOf(
            RestResponseInterface::class,
            $this->productListsReader->findProductListByUuid(
                $this->restRequestInterfaceMock
            )
        );
    }

    /**
     * @return void
     */
    public function testFindProductListByUuidProductListNoPermissionCompanyNull(): void
    {
        $this->restResourceBuilderInterfaceMock->expects($this->atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseInterfaceMock);

        $this->restRequestInterfaceMock->expects($this->atLeastOnce())
            ->method('getResource')
            ->willReturn($this->restResourceInterfaceMock);

        $this->restResourceInterfaceMock->expects($this->atLeastOnce())
            ->method('getId')
            ->willReturn($this->id);

        $this->productListsRestApiClientInterfaceMock->expects($this->atLeastOnce())
            ->method('findProductListByUuid')
            ->willReturn($this->productListResponseTransferMock);

        $this->productListResponseTransferMock->expects($this->atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(true);

        $this->productListResponseTransferMock->expects($this->atLeastOnce())
            ->method('getProductList')
            ->willReturn($this->productListTransferMock);

        $this->restRequestInterfaceMock->expects($this->atLeastOnce())
            ->method('getRestUser')
            ->willReturn($this->restUserTransferMock);

        $this->productListTransferMock->expects($this->atLeastOnce())
            ->method('getProductListCustomerRelation')
            ->willReturn($this->productListCustomerRelationTransferMock);

        $this->restUserTransferMock->expects($this->atLeastOnce())
            ->method('getSurrogateIdentifier')
            ->willReturn($this->surrogateIdentifier);

        $this->productListCustomerRelationTransferMock->expects($this->atLeastOnce())
            ->method('getCustomerIds')
            ->willReturn($this->customerIds);

        $this->productListTransferMock->expects($this->atLeastOnce())
            ->method('getProductListCompanyRelation')
            ->willReturn($this->productListCompanyRelationTransferMock);

        $this->restUserTransferMock->expects($this->atLeastOnce())
            ->method('getNaturalIdentifier')
            ->willReturn($this->naturalIdentifier);

        $this->productListsRestApiToCompanyUserClientInterfaceMock->expects($this->atLeastOnce())
            ->method('getActiveCompanyUsersByCustomerReference')
            ->willReturn($this->companyUserCollectionTransferMock);

        $this->companyUserCollectionTransferMock->expects($this->atLeastOnce())
            ->method('getCompanyUsers')
            ->willReturn($this->companyUserTransferMocks);

        $this->companyUserTransferMock->expects($this->atLeastOnce())
            ->method('getCompany')
            ->willReturn(null);

        $this->restApiErrorInterfaceMock->expects($this->atLeastOnce())
            ->method('addProductListNoPermissionError')
            ->with($this->restResponseInterfaceMock)
            ->willReturn($this->restResponseInterfaceMock);

        $this->assertInstanceOf(
            RestResponseInterface::class,
            $this->productListsReader->findProductListByUuid(
                $this->restRequestInterfaceMock
            )
        );
    }
}
