<?php

namespace FondOfSpryker\Zed\ProductListsRestApi\Persistence;

use Generated\Shared\Transfer\ProductListTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfSpryker\Zed\ProductListsRestApi\Persistence\ProductListsRestApiPersistenceFactory getFactory()
 */
class ProductListsRestApiRepository extends AbstractRepository implements ProductListsRestApiRepositoryInterface
{
    /**
     * @param string $productListUuid
     *
     * @throws
     *
     * @return \Generated\Shared\Transfer\ProductListTransfer|null
     */
    public function findProductListByUuid(string $productListUuid): ?ProductListTransfer
    {
        $productListEntity = $this->getFactory()
            ->createProductListQuery()
            ->filterByUuid($productListUuid)
            ->findOne();

        if (!$productListEntity) {
            return null;
        }

        return $this->getFactory()
            ->createProductListsRestApiMapper()
            ->mapEntityToProductListTransfer($productListEntity, new ProductListTransfer());
    }
}
