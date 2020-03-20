<?php

namespace FondOfSpryker\Glue\ProductListsRestApi\Dependency\Client;

use Codeception\Test\Unit;
use FondOfSpryker\Client\ProductListCompany\ProductListCompanyClientInterface;
use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\ProductListCollectionTransfer;

class ProductListsRestApiToProductListCompanyClientBridgeTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\ProductListsRestApi\Dependency\Client\ProductListsRestApiToProductListCompanyClientBridge
     */
    protected $productListsRestApiToProductListCompanyClientBridge;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Client\ProductListCompany\ProductListCompanyClientInterface
     */
    protected $productListCompanyClientInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyTransfer
     */
    protected $companyTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ProductListCollectionTransfer
     */
    protected $productListCollectionTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->productListCompanyClientInterfaceMock = $this->getMockBuilder(ProductListCompanyClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyTransferMock = $this->getMockBuilder(CompanyTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListCollectionTransferMock = $this->getMockBuilder(ProductListCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListsRestApiToProductListCompanyClientBridge = new ProductListsRestApiToProductListCompanyClientBridge(
            $this->productListCompanyClientInterfaceMock
        );
    }

    /**
     * @return void
     */
    public function testGetProductListCollectionByCompanyId(): void
    {
        $this->productListCompanyClientInterfaceMock->expects($this->atLeastOnce())
            ->method('getProductListCollectionByCompanyId')
            ->with($this->companyTransferMock)
            ->willReturn($this->productListCollectionTransferMock);

        $this->assertInstanceOf(
            ProductListCollectionTransfer::class,
            $this->productListsRestApiToProductListCompanyClientBridge->getProductListCollectionByCompanyId(
                $this->companyTransferMock
            )
        );
    }
}
