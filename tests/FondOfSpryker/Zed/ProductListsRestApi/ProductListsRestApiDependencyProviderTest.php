<?php

namespace FondOfSpryker\Zed\ProductListsRestApi;

use Codeception\Test\Unit;
use Spryker\Zed\Kernel\Container;

class ProductListsRestApiDependencyProviderTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\ProductListsRestApi\ProductListsRestApiDependencyProvider
     */
    protected $productListsRestApiDependencyProvider;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListsRestApiDependencyProvider = new ProductListsRestApiDependencyProvider();
    }

    /**
     * @return void
     */
    public function testProvideBusinessLayerDependencies(): void
    {
        $this->assertInstanceOf(
            Container::class,
            $this->productListsRestApiDependencyProvider->provideBusinessLayerDependencies(
                $this->containerMock
            )
        );
    }
}
