<?php

namespace FondOfSpryker\Glue\ProductListsRestApi;

use Codeception\Test\Unit;
use Spryker\Glue\Kernel\Container;

class ProductListsRestApiDependencyProviderTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\ProductListsRestApi\ProductListsRestApiDependencyProvider
     */
    protected $productListsRestApiDependencyProvider;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\Kernel\Container
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
    public function testProvideDependencies(): void
    {
        $this->assertInstanceOf(
            Container::class,
            $this->productListsRestApiDependencyProvider->provideDependencies($this->containerMock)
        );
    }
}
