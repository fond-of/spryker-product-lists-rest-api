<?php

namespace FondOfSpryker\Glue\ProductListsRestApi\Dependency\Client;

use Codeception\Test\Unit;
use FondOfSpryker\Client\ProductListCustomer\ProductListCustomerClientInterface;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\ProductListCollectionTransfer;

class ProductListsRestApiToProductListCustomerClientBridgeTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\ProductListsRestApi\Dependency\Client\ProductListsRestApiToProductListCustomerClientBridge
     */
    protected $productListsRestApiToProductListCustomerClientBridge;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Client\ProductListCustomer\ProductListCustomerClientInterface
     */
    protected $productListCustomerClientInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CustomerTransfer
     */
    protected $customerTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ProductListCollectionTransfer
     */
    protected $productListCollectionTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->productListCustomerClientInterfaceMock = $this->getMockBuilder(ProductListCustomerClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerTransferMock = $this->getMockBuilder(CustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListCollectionTransferMock = $this->getMockBuilder(ProductListCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListsRestApiToProductListCustomerClientBridge = new ProductListsRestApiToProductListCustomerClientBridge(
            $this->productListCustomerClientInterfaceMock
        );
    }

    /**
     * @return void
     */
    public function testGetProductListCollectionByCustomerId(): void
    {
        $this->productListCustomerClientInterfaceMock->expects($this->atLeastOnce())
            ->method('getProductListCollectionByCustomerId')
            ->with($this->customerTransferMock)
            ->willReturn($this->productListCollectionTransferMock);

        $this->assertInstanceOf(
            ProductListCollectionTransfer::class,
            $this->productListsRestApiToProductListCustomerClientBridge->getProductListCollectionByCustomerId(
                $this->customerTransferMock
            )
        );
    }
}
