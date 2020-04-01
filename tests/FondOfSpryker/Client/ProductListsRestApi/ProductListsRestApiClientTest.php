<?php

namespace FondOfSpryker\Client\ProductListsRestApi;

use Codeception\Test\Unit;
use FondOfSpryker\Client\ProductListsRestApi\Zed\ProductListsRestApiStubInterface;
use Generated\Shared\Transfer\ProductListResponseTransfer;
use Generated\Shared\Transfer\ProductListTransfer;

class ProductListsRestApiClientTest extends Unit
{
    /**
     * @var \FondOfSpryker\Client\ProductListsRestApi\ProductListsRestApiClient
     */
    protected $productListsRestApiClient;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ProductListTransfer
     */
    protected $productListTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Client\ProductListsRestApi\ProductListsRestApiFactory
     */
    protected $productListsRestApiFactoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Client\ProductListsRestApi\Zed\ProductListsRestApiStubInterface
     */
    protected $productListsRestApiStubInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ProductListResponseTransfer
     */
    protected $productListResponseTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->productListsRestApiFactoryMock = $this->getMockBuilder(ProductListsRestApiFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListTransferMock = $this->getMockBuilder(ProductListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListsRestApiStubInterfaceMock = $this->getMockBuilder(ProductListsRestApiStubInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListResponseTransferMock = $this->getMockBuilder(ProductListResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListsRestApiClient = new ProductListsRestApiClient();
        $this->productListsRestApiClient->setFactory($this->productListsRestApiFactoryMock);
    }

    /**
     * @return void
     */
    public function testFindProductListByUuid(): void
    {
        $this->productListsRestApiFactoryMock->expects($this->atLeastOnce())
            ->method('createZedProductListsRestApiStub')
            ->willReturn($this->productListsRestApiStubInterfaceMock);

        $this->productListsRestApiStubInterfaceMock->expects($this->atLeastOnce())
            ->method('findProductListByUuid')
            ->with($this->productListTransferMock)
            ->willReturn($this->productListResponseTransferMock);

        $this->assertInstanceOf(
            ProductListResponseTransfer::class,
            $this->productListsRestApiClient->findProductListByUuid(
                $this->productListTransferMock
            )
        );
    }
}
