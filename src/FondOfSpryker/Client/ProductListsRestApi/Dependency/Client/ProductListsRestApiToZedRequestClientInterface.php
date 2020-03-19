<?php

namespace FondOfSpryker\Client\ProductListsRestApi\Dependency\Client;

use Spryker\Client\ZedRequest\ZedRequestClientInterface;
use Spryker\Shared\Kernel\Transfer\TransferInterface;

interface ProductListsRestApiToZedRequestClientInterface
{
    /**
     * @param \Spryker\Client\ZedRequest\ZedRequestClientInterface $zedRequestClient
     */
    public function __construct(ZedRequestClientInterface $zedRequestClient);

    /**
     * @param string $url
     * @param \Spryker\Shared\Kernel\Transfer\TransferInterface $object
     * @param array|null $requestOptions
     *
     * @return \Spryker\Shared\Kernel\Transfer\TransferInterface
     */
    public function call(string $url, TransferInterface $object, $requestOptions = null): TransferInterface;
}
