<?php

namespace FondOfSpryker\Zed\ProductListsRestApi\Business;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\ProductListsRestApi\Business\Reader\ProductListsReaderInterface;
use Generated\Shared\Transfer\ProductListResponseTransfer;
use Generated\Shared\Transfer\ProductListTransfer;

class ProductListsRestApiFacadeTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\ProductListsRestApi\Business\ProductListsRestApiFacade
     */
    protected $productListsRestApiFacade;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\ProductListsRestApi\Business\ProductListsRestApiBusinessFactory
     */
    protected $productListsRestApiBusinessFactoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ProductListTransfer
     */
    protected $productListTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\ProductListsRestApi\Business\Reader\ProductListsReaderInterface
     */
    protected $productListsReaderInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ProductListResponseTransfer
     */
    protected $productListResponseTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->productListsRestApiBusinessFactoryMock = $this->getMockBuilder(ProductListsRestApiBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListTransferMock = $this->getMockBuilder(ProductListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListsReaderInterfaceMock = $this->getMockBuilder(ProductListsReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListResponseTransferMock = $this->getMockBuilder(ProductListResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListsRestApiFacade = new ProductListsRestApiFacade();
        $this->productListsRestApiFacade->setFactory($this->productListsRestApiBusinessFactoryMock);
    }

    /**
     * @return void
     */
    public function testFindProductListByUuid(): void
    {
        $this->productListsRestApiBusinessFactoryMock->expects($this->atLeastOnce())
            ->method('createProductListsRestApiReader')
            ->willReturn($this->productListsReaderInterfaceMock);

        $this->productListsReaderInterfaceMock->expects($this->atLeastOnce())
            ->method('findProductListsByUuid')
            ->with($this->productListTransferMock)
            ->willReturn($this->productListResponseTransferMock);

        $this->assertInstanceOf(
            ProductListResponseTransfer::class,
            $this->productListsRestApiFacade->findProductListByUuid(
                $this->productListTransferMock
            )
        );
    }
}
