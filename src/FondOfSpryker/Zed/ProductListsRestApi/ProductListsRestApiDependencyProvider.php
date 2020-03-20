<?php

namespace FondOfSpryker\Zed\ProductListsRestApi;

use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class ProductListsRestApiDependencyProvider extends AbstractBundleDependencyProvider
{
    public const PRODUCT_LIST_FACADE = 'PRODUCT_LIST_FACADE';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container = $this->addProductListFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addProductListFacade(Container $container): Container
    {
        $container[static::PRODUCT_LIST_FACADE] = static function (Container $container) {
            return $container->getLocator()->productList()->facade();
        };

        return $container;
    }
}
