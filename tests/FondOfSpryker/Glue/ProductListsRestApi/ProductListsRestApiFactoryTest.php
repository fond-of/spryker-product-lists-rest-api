<?php

namespace FondOfSpryker\Glue\ProductListsRestApi;

use Codeception\Test\Unit;
use FondOfSpryker\Glue\ProductListsRestApi\Processor\ProductLists\ProductListsMapperInterface;
use FondOfSpryker\Glue\ProductListsRestApi\Processor\Validation\RestApiError;

class ProductListsRestApiFactoryTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\ProductListsRestApi\ProductListsRestApiFactory
     */
    protected $productListsRestApiFactory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilder
     */
    protected $restResourceBuilderMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->productListsRestApiFactory = new ProductListsRestApiFactory();
    }

    /**
     * @return void
     */
    public function testCreateProductListMapper(): void
    {
        $this->assertInstanceOf(
            ProductListsMapperInterface::class,
            $this->productListsRestApiFactory->createProductListsMapper()
        );
    }

    /**
     * @return void
     */
    public function testCreateRestApiError(): void
    {
        $this->assertInstanceOf(
            RestApiError::class,
            $this->productListsRestApiFactory->createRestApiError()
        );
    }
}
