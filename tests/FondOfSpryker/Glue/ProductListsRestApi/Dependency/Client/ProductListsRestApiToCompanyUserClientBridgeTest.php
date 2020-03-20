<?php

namespace FondOfSpryker\Glue\ProductListsRestApi\Dependency\Client;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\CompanyUserCollectionTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Spryker\Client\CompanyUser\CompanyUserClientInterface;

class ProductListsRestApiToCompanyUserClientBridgeTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\ProductListsRestApi\Dependency\Client\ProductListsRestApiToCompanyUserClientBridge
     */
    protected $productListsRestApiToCompanyUserClientBridge;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CustomerTransfer
     */
    protected $customerTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\CompanyUser\CompanyUserClientInterface
     */
    protected $companyUserClientInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyUserCollectionTransfer
     */
    protected $companyUserCollectionTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->companyUserClientInterfaceMock = $this->getMockBuilder(CompanyUserClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerTransferMock = $this->getMockBuilder(CustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserCollectionTransferMock = $this->getMockBuilder(CompanyUserCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListsRestApiToCompanyUserClientBridge = new ProductListsRestApiToCompanyUserClientBridge(
            $this->companyUserClientInterfaceMock
        );
    }

    /**
     * @return void
     */
    public function testGetActiveCompanyUsersByCustomerReference(): void
    {
        $this->companyUserClientInterfaceMock->expects($this->atLeastOnce())
            ->method('getActiveCompanyUsersByCustomerReference')
            ->with($this->customerTransferMock)
            ->willReturn($this->companyUserCollectionTransferMock);

        $this->assertInstanceOf(
            CompanyUserCollectionTransfer::class,
            $this->productListsRestApiToCompanyUserClientBridge->getActiveCompanyUsersByCustomerReference(
                $this->customerTransferMock
            )
        );
    }
}
