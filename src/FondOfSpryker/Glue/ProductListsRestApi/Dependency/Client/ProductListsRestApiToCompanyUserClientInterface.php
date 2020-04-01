<?php

namespace FondOfSpryker\Glue\ProductListsRestApi\Dependency\Client;

use Generated\Shared\Transfer\CompanyUserCollectionTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Spryker\Client\CompanyUser\CompanyUserClientInterface;

interface ProductListsRestApiToCompanyUserClientInterface
{
    /**
     * @param \Spryker\Client\CompanyUser\CompanyUserClientInterface $companyUserClient
     */
    public function __construct(CompanyUserClientInterface $companyUserClient);

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUserCollectionTransfer
     */
    public function getActiveCompanyUsersByCustomerReference(CustomerTransfer $customerTransfer): CompanyUserCollectionTransfer;
}
