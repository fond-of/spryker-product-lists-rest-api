<?php

namespace FondOfSpryker\Glue\ProductListsRestApi\Dependency\Client;

use FondOfSpryker\Client\ProductListCustomer\ProductListCustomerClientInterface;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\ProductListCollectionTransfer;

class ProductListsRestApiToProductListCustomerClientBridge implements ProductListsRestApiToProductListCustomerClientInterface
{
    /**
     * @var \FondOfSpryker\Client\ProductListCustomer\ProductListCustomerClientInterface
     */
    protected $productListCustomerClient;

    /**
     * @param \FondOfSpryker\Client\ProductListCustomer\ProductListCustomerClientInterface $productListCustomerClient
     */
    public function __construct(ProductListCustomerClientInterface $productListCustomerClient)
    {
        $this->productListCustomerClient = $productListCustomerClient;
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\ProductListCollectionTransfer
     */
    public function getProductListCollectionByCustomerId(CustomerTransfer $customerTransfer): ProductListCollectionTransfer
    {
        return $this->productListCustomerClient->getProductListCollectionByCustomerId($customerTransfer);
    }
}
