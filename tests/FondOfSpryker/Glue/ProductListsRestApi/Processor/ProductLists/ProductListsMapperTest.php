<?php

namespace FondOfSpryker\Glue\ProductListsRestApi\Processor\ProductLists;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\ProductListTransfer;
use Generated\Shared\Transfer\RestProductListsAttributesTransfer;

class ProductListsMapperTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\ProductListsRestApi\Processor\ProductLists\ProductListsMapper
     */
    protected $productListsMapper;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ProductListTransfer
     */
    protected $productListTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestProductListsAttributesTransfer
     */
    protected $restProductListsAttributesTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->productListTransferMock = $this->getMockBuilder(ProductListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restProductListsAttributesTransferMock = $this->getMockBuilder(RestProductListsAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListsMapper = new ProductListsMapper();
    }

    /**
     * @return void
     */
    public function testMapRestProductListsAttributesTransfer(): void
    {
        $this->productListTransferMock->expects($this->atLeastOnce())
            ->method('toArray')
            ->willReturn([]);

        $this->assertInstanceOf(
            RestProductListsAttributesTransfer::class,
            $this->productListsMapper->mapRestProductListsAttributesTransfer(
                $this->productListTransferMock
            )
        );
    }

    /**
     * @return void
     */
    public function testMapProductListTransferToRestProductListResponseAttributesTransfer(): void
    {
        $this->productListTransferMock->expects($this->atLeastOnce())
            ->method('toArray')
            ->willReturn([]);

        $this->restProductListsAttributesTransferMock->expects($this->atLeastOnce())
            ->method('fromArray')
            ->with([])
            ->willReturnSelf();

        $this->assertInstanceOf(
            RestProductListsAttributesTransfer::class,
            $this->productListsMapper->mapProductListTransferToRestProductListResponseAttributesTransfer(
                $this->productListTransferMock,
                $this->restProductListsAttributesTransferMock
            )
        );
    }
}
