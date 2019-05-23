<?php

namespace FondOfSpryker\Glue\ProductListsRestApi\Dependency\Client;

use FondOfSpryker\Client\ProductListCompany\ProductListCompanyClientInterface;
use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\ProductListCollectionTransfer;

class ProductListsRestApiToProductListCompanyClientBridge implements ProductListsRestApiToProductListCompanyClientInterface
{
    /**
     * @var \FondOfSpryker\Client\ProductListCompany\ProductListCompanyClientInterface
     */
    protected $productListCompanyClient;

    /**
     * @param \FondOfSpryker\Client\ProductListCompany\ProductListCompanyClientInterface $productListCompanyClient
     */
    public function __construct(ProductListCompanyClientInterface $productListCompanyClient)
    {
        $this->productListCompanyClient = $productListCompanyClient;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return \Generated\Shared\Transfer\ProductListCollectionTransfer
     */
    public function getProductListCollectionByCompanyId(CompanyTransfer $companyTransfer): ProductListCollectionTransfer
    {
        return $this->productListCompanyClient->getProductListCollectionByCompanyId($companyTransfer);
    }
}
