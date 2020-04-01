<?php

namespace FondOfSpryker\Client\ProductListsRestApi;

use Codeception\Test\Unit;
use Spryker\Client\Kernel\Container;

class ProductListsRestApiDependencyProviderTest extends Unit
{
    /**
     * @var \FondOfSpryker\Client\ProductListsRestApi\ProductListsRestApiDependencyProvider
     */
    protected $productListsRestApiDependencyProvider;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Kernel\Container
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
    public function testProvideServiceLayerDependencies(): void
    {
        $this->assertInstanceOf(
            Container::class,
            $this->productListsRestApiDependencyProvider->provideServiceLayerDependencies($this->containerMock)
        );
    }
}
