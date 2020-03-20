<?php

namespace FondOfSpryker\Zed\ProductListsRestApi\Business\Reader;

use FondOfSpryker\Zed\ProductListsRestApi\Persistence\ProductListsRestApiRepositoryInterface;
use Generated\Shared\Transfer\ProductListResponseTransfer;
use Generated\Shared\Transfer\ProductListTransfer;
use Spryker\Zed\ProductList\Business\ProductListFacadeInterface;

interface ProductListsReaderInterface
{
    /**
     * @param \FondOfSpryker\Zed\ProductListsRestApi\Persistence\ProductListsRestApiRepositoryInterface $productListsRestApiRepository
     * @param \Spryker\Zed\ProductList\Business\ProductListFacadeInterface $productListFacade
     */
    public function __construct(
        ProductListsRestApiRepositoryInterface $productListsRestApiRepository,
        ProductListFacadeInterface $productListFacade
    );

    /**
     * @param \Generated\Shared\Transfer\ProductListTransfer $productListTransfer
     *
     * @return \Generated\Shared\Transfer\ProductListResponseTransfer
     */
    public function findCompanyByUuid(ProductListTransfer $productListTransfer): ProductListResponseTransfer;
}
