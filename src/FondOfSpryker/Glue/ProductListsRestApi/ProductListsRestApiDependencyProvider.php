<?php

namespace FondOfSpryker\Glue\ProductListsRestApi;

use FondOfSpryker\Glue\ProductListsRestApi\Dependency\Client\ProductListsRestApiToCompanyUserClientBridge;
use FondOfSpryker\Glue\ProductListsRestApi\Dependency\Client\ProductListsRestApiToProductListCompanyClientBridge;
use FondOfSpryker\Glue\ProductListsRestApi\Dependency\Client\ProductListsRestApiToProductListCustomerClientBridge;
use Spryker\Glue\Kernel\AbstractBundleDependencyProvider;
use Spryker\Glue\Kernel\Container;

class ProductListsRestApiDependencyProvider extends AbstractBundleDependencyProvider
{
    public const CLIENT_PRODUCT_LIST_CUSTOMER = 'CLIENT_PRODUCT_LIST_CUSTOMER';
    public const CLIENT_PRODUCT_LIST_COMPANY = 'CLIENT_PRODUCT_LIST_COMPANY';
    public const CLIENT_COMPANY_USER = 'CLIENT_COMPANY_USER';

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    public function provideDependencies(Container $container): Container
    {
        $container = parent::provideDependencies($container);

        $container = $this->addProductListCustomerClient($container);
        $container = $this->addProductListCompanyClient($container);
        $container = $this->addCompanyUserClient($container);

        return $container;
    }

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    protected function addProductListCustomerClient(Container $container): Container
    {
        $container[static::CLIENT_PRODUCT_LIST_CUSTOMER] = static function (Container $container) {
            return new ProductListsRestApiToProductListCustomerClientBridge(
                $container->getLocator()->productListCustomer()->client()
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    protected function addProductListCompanyClient(Container $container): Container
    {
        $container[static::CLIENT_PRODUCT_LIST_COMPANY] = static function (Container $container) {
            return new ProductListsRestApiToProductListCompanyClientBridge(
                $container->getLocator()->productListCompany()->client()
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    protected function addCompanyUserClient(Container $container): Container
    {
        $container[static::CLIENT_COMPANY_USER] = static function (Container $container) {
            return new ProductListsRestApiToCompanyUserClientBridge(
                $container->getLocator()->companyUser()->client()
            );
        };

        return $container;
    }
}
