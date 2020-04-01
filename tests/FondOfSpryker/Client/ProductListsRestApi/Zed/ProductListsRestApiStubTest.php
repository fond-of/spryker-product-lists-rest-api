<?php

namespace FondOfSpryker\Client\ProductListsRestApi\Zed;

use Codeception\Test\Unit;
use FondOfSpryker\Client\ProductListsRestApi\Dependency\Client\ProductListsRestApiToZedRequestClientInterface;
use Generated\Shared\Transfer\ProductListResponseTransfer;
use Generated\Shared\Transfer\ProductListTransfer;

class ProductListsRestApiStubTest extends Unit
{
    /**
     * @var \FondOfSpryker\Client\ProductListsRestApi\Zed\ProductListsRestApiStub
     */
    protected $productListsRestApiStub;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Client\ProductListsRestApi\Dependency\Client\ProductListsRestApiToZedRequestClientInterface
     */
    protected $productListsRestApiToZedRequestClientInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ProductListTransfer
     */
    protected $productListTransferMock;

    /**
     * @var string
     */
    protected $url;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ProductListResponseTransfer
     */
    protected $productListResponseTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->productListsRestApiToZedRequestClientInterfaceMock = $this->getMockBuilder(ProductListsRestApiToZedRequestClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListTransferMock = $this->getMockBuilder(ProductListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->url = '/product-lists-rest-api/gateway/find-product-list-by-uuid';

        $this->productListResponseTransferMock = $this->getMockBuilder(ProductListResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListsRestApiStub = new ProductListsRestApiStub(
            $this->productListsRestApiToZedRequestClientInterfaceMock
        );
    }

    /**
     * @return void
     */
    public function testFindProductListByUuid(): void
    {
        $this->productListsRestApiToZedRequestClientInterfaceMock->expects($this->atLeastOnce())
            ->method('call')
            ->with($this->url, $this->productListTransferMock)
            ->willReturn($this->productListResponseTransferMock);

        $this->assertInstanceOf(
            ProductListResponseTransfer::class,
            $this->productListsRestApiStub->findProductListByUuid(
                $this->productListTransferMock
            )
        );
    }
}
