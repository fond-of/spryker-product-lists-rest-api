<?php

namespace FondOfSpryker\Zed\ProductListsRestApi\Business\Reader;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\ProductListsRestApi\Persistence\ProductListsRestApiRepositoryInterface;
use Generated\Shared\Transfer\ProductListResponseTransfer;
use Generated\Shared\Transfer\ProductListTransfer;
use Spryker\Zed\ProductList\Business\ProductListFacadeInterface;

class ProductListsReaderTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\ProductListsRestApi\Business\Reader\ProductListsReader
     */
    protected $productListsReader;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\ProductListsRestApi\Persistence\ProductListsRestApiRepositoryInterface
     */
    protected $productListsRestApiRepositoryInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\ProductList\Business\ProductListFacadeInterface
     */
    protected $productListFacadeInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ProductListTransfer
     */
    protected $productListTransferMock;

    /**
     * @var string
     */
    protected $uuid;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->productListsRestApiRepositoryInterfaceMock = $this->getMockBuilder(ProductListsRestApiRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListFacadeInterfaceMock = $this->getMockBuilder(ProductListFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListTransferMock = $this->getMockBuilder(ProductListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->uuid = 'uuid';

        $this->productListsReader = new ProductListsReader(
            $this->productListsRestApiRepositoryInterfaceMock,
            $this->productListFacadeInterfaceMock
        );
    }

    /**
     * @return void
     */
    public function testFindCompanyByUuid(): void
    {
        $this->productListTransferMock->expects($this->atLeastOnce())
            ->method('requireUuid')
            ->willReturnSelf();

        $this->productListTransferMock->expects($this->atLeastOnce())
            ->method('getUuid')
            ->willReturn($this->uuid);

        $this->productListsRestApiRepositoryInterfaceMock->expects($this->atLeastOnce())
            ->method('findProductListByUuid')
            ->with($this->uuid)
            ->willReturn($this->productListTransferMock);

        $this->productListFacadeInterfaceMock->expects($this->atLeastOnce())
            ->method('getProductListById')
            ->with($this->productListTransferMock)
            ->willReturn($this->productListTransferMock);

        $this->assertInstanceOf(
            ProductListResponseTransfer::class,
            $this->productListsReader->findCompanyByUuid(
                $this->productListTransferMock
            )
        );
    }
}
