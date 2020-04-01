<?php

namespace FondOfSpryker\Zed\ProductListsRestApi\Business\Reader;

use FondOfSpryker\Zed\ProductListsRestApi\Persistence\ProductListsRestApiRepositoryInterface;
use Generated\Shared\Transfer\ProductListResponseTransfer;
use Generated\Shared\Transfer\ProductListTransfer;
use Spryker\Zed\ProductList\Business\ProductListFacadeInterface;

class ProductListsReader implements ProductListsReaderInterface
{
    /**
     * @var \FondOfSpryker\Zed\ProductListsRestApi\Persistence\ProductListsRestApiRepositoryInterface
     */
    protected $productListsRestApiRepository;

    /**
     * @var \FondOfSpryker\Zed\ProductListsRestApi\Business\ProductListsRestApiFacadeInterface
     */
    protected $productListFacade;

    /**
     * @param \FondOfSpryker\Zed\ProductListsRestApi\Persistence\ProductListsRestApiRepositoryInterface $productListsRestApiRepository
     * @param \Spryker\Zed\ProductList\Business\ProductListFacadeInterface $productListFacade
     */
    public function __construct(
        ProductListsRestApiRepositoryInterface $productListsRestApiRepository,
        ProductListFacadeInterface $productListFacade
    ) {
        $this->productListsRestApiRepository = $productListsRestApiRepository;
        $this->productListFacade = $productListFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\ProductListTransfer $productListTransfer
     *
     * @return \Generated\Shared\Transfer\ProductListResponseTransfer
     */
    public function findProductListsByUuid(ProductListTransfer $productListTransfer): ProductListResponseTransfer
    {
        $productListTransfer->requireUuid();

        $productListTransfer = $this->productListsRestApiRepository->findProductListByUuid(
            $productListTransfer->getUuid()
        );

        $productListTransfer = $this->productListFacade->getProductListById($productListTransfer);

        $productListResponseTransfer = new ProductListResponseTransfer();

        if (!$productListTransfer) {
            return $productListResponseTransfer->setIsSuccessful(false);
        }

        return $productListResponseTransfer
            ->setIsSuccessful(true)
            ->setProductList($productListTransfer);
    }
}
