<?php

namespace FondOfSpryker\Glue\ProductListsRestApi\Plugin;

use Codeception\Test\Unit;
use FondOfSpryker\Glue\ProductListsRestApi\Processor\ProductLists\ProductListsResourceRelationshipExpanderInterface;
use FondOfSpryker\Glue\ProductListsRestApi\ProductListsRestApiConfig;
use FondOfSpryker\Glue\ProductListsRestApi\ProductListsRestApiFactory;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class ProductListsCompanyUsersResourcesRelationshipPluginTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\ProductListsRestApi\Plugin\ProductListsCompanyUsersResourcesRelationshipPlugin
     */
    protected $productListsCompanyUsersResourcesRelationshipPlugin;

    /**
     * @var array
     */
    protected $resources;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface
     */
    protected $restRequestInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Glue\ProductListsRestApi\ProductListsRestApiFactory
     */
    protected $productListsRestApiFactoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Glue\ProductListsRestApi\Processor\ProductLists\ProductListsResourceRelationshipExpanderInterface
     */
    protected $productListsResourceRelationshipExpanderInterfaceMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->productListsRestApiFactoryMock = $this->getMockBuilder(ProductListsRestApiFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->resources = [];

        $this->restRequestInterfaceMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListsResourceRelationshipExpanderInterfaceMock = $this->getMockBuilder(ProductListsResourceRelationshipExpanderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListsCompanyUsersResourcesRelationshipPlugin = new ProductListsCompanyUsersResourcesRelationshipPlugin();
        $this->productListsCompanyUsersResourcesRelationshipPlugin->setFactory($this->productListsRestApiFactoryMock);
    }

    /**
     * @return void
     */
    public function testAddResourceRelationships(): void
    {
        $this->productListsRestApiFactoryMock->expects($this->atLeastOnce())
            ->method('createProductListsResourceRelationshipExpander')
            ->willReturn($this->productListsResourceRelationshipExpanderInterfaceMock);

        $this->productListsResourceRelationshipExpanderInterfaceMock->expects($this->atLeastOnce())
            ->method('addResourceRelationships')
            ->with($this->resources, $this->restRequestInterfaceMock);

        $this->productListsCompanyUsersResourcesRelationshipPlugin->addResourceRelationships(
            $this->resources,
            $this->restRequestInterfaceMock
        );
    }

    /**
     * @return void
     */
    public function testGetRelationshipResourceType(): void
    {
        $this->assertSame(
            ProductListsRestApiConfig::RESOURCE_PRODUCT_LISTS,
            $this->productListsCompanyUsersResourcesRelationshipPlugin->getRelationshipResourceType()
        );
    }
}
