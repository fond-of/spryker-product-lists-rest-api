<?php

namespace FondOfSpryker\Zed\ProductListsRestApi\Business;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\ProductListsRestApi\Business\Reader\ProductListsReaderInterface;
use FondOfSpryker\Zed\ProductListsRestApi\Persistence\ProductListsRestApiRepository;
use FondOfSpryker\Zed\ProductListsRestApi\ProductListsRestApiDependencyProvider;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\ProductList\Business\ProductListFacadeInterface;

class ProductListsRestApiBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\ProductListsRestApi\Business\ProductListsRestApiBusinessFactory
     */
    protected $productListsRestApiBusinessFactory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\ProductListsRestApi\Persistence\ProductListsRestApiRepository
     */
    protected $productListsRestApiRepositoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\ProductList\Business\ProductListFacadeInterface
     */
    protected $productListFacadeInterfaceMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->productListsRestApiRepositoryMock = $this->getMockBuilder(ProductListsRestApiRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListFacadeInterfaceMock = $this->getMockBuilder(ProductListFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListsRestApiBusinessFactory = new ProductListsRestApiBusinessFactory();
        $this->productListsRestApiBusinessFactory->setRepository($this->productListsRestApiRepositoryMock);
        $this->productListsRestApiBusinessFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateProductListsRestApiReader(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->with(ProductListsRestApiDependencyProvider::PRODUCT_LIST_FACADE)
            ->willReturn($this->productListFacadeInterfaceMock);

        $this->assertInstanceOf(
            ProductListsReaderInterface::class,
            $this->productListsRestApiBusinessFactory->createProductListsRestApiReader()
        );
    }
}
