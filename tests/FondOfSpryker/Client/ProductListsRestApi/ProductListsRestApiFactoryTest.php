<?php

namespace FondOfSpryker\Client\ProductListsRestApi;

use Codeception\Test\Unit;
use FondOfSpryker\Client\ProductListsRestApi\Dependency\Client\ProductListsRestApiToZedRequestClientInterface;
use FondOfSpryker\Client\ProductListsRestApi\Zed\ProductListsRestApiStubInterface;
use Spryker\Client\Kernel\Container;

class ProductListsRestApiFactoryTest extends Unit
{
    /**
     * @var \FondOfSpryker\Client\ProductListsRestApi\ProductListsRestApiFactory
     */
    protected $productListsRestApiFactory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Client\ProductListsRestApi\Dependency\Client\ProductListsRestApiToZedRequestClientInterface
     */
    protected $productListsRestApiToZedRequestClientInterfaceMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListsRestApiToZedRequestClientInterfaceMock = $this->getMockBuilder(ProductListsRestApiToZedRequestClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListsRestApiFactory = new ProductListsRestApiFactory();
        $this->productListsRestApiFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateZedProductListsRestApiStub(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->with(ProductListsRestApiDependencyProvider::CLIENT_ZED_REQUEST)
            ->willReturn($this->productListsRestApiToZedRequestClientInterfaceMock);

        $this->assertInstanceOf(
            ProductListsRestApiStubInterface::class,
            $this->productListsRestApiFactory->createZedProductListsRestApiStub()
        );
    }
}
