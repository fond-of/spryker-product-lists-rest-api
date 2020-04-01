<?php

namespace FondOfSpryker\Zed\ProductListsRestApi\Persistence;

use FondOfSpryker\Zed\ProductListsRestApi\Persistence\Mapper\ProductListsMapper;
use FondOfSpryker\Zed\ProductListsRestApi\Persistence\Mapper\ProductListsMapperInterface;
use Orm\Zed\ProductList\Persistence\SpyProductListQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \FondOfSpryker\Zed\ProductListsRestApi\Persistence\ProductListsRestApiRepositoryInterface getRepository()
 */
class ProductListsRestApiPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\ProductList\Persistence\SpyProductListQuery
     */
    public function createProductListQuery(): SpyProductListQuery
    {
        return SpyProductListQuery::create();
    }

    /**
     * @return \FondOfSpryker\Zed\ProductListsRestApi\Persistence\Mapper\ProductListsMapperInterface
     */
    public function createProductListsRestApiMapper(): ProductListsMapperInterface
    {
        return new ProductListsMapper();
    }
}
