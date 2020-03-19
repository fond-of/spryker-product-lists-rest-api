<?php


namespace FondOfSpryker\Glue\ProductListsRestApi\Plugin;

use FondOfSpryker\Glue\ProductListsRestApi\ProductListsRestApiConfig;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRelationshipPluginInterface;
use Spryker\Glue\Kernel\AbstractPlugin;

/**
 * @method \FondOfSpryker\Glue\ProductListsRestApi\ProductListsRestApiFactory getFactory()
 */
class ProductListsCompanyUsersResourcesRelationshipPlugin extends AbstractPlugin implements ResourceRelationshipPluginInterface
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface[] $resources
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return void
     */
    public function addResourceRelationships(array $resources, RestRequestInterface $restRequest): void
    {
        $this->getFactory()
            ->createProductListsResourceRelationshipExpander()
            ->addResourceRelationships($resources, $restRequest);
    }

    /**
     * @return string
     */
    public function getRelationshipResourceType(): string
    {
        return ProductListsRestApiConfig::RESOURCE_PRODUCT_LISTS;
    }
}
