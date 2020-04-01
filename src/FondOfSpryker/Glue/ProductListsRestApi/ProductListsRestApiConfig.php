<?php

namespace FondOfSpryker\Glue\ProductListsRestApi;

use Spryker\Glue\Kernel\AbstractBundleConfig;

class ProductListsRestApiConfig extends AbstractBundleConfig
{
    public const CONTROLLER_PRODUCT_LISTS = 'product-lists-resource';
    public const RESOURCE_PRODUCT_LISTS = 'product-lists';

    public const RESPONSE_CODE_EXTERNAL_REFERENCE_MISSING = '800';
    public const RESPONSE_CODE_PRODUCT_LIST_NOT_FOUND = '801';
    public const RESPONSE_CODE_NO_PERMISSION = '802';

    public const RESPONSE_DETAILS_EXTERNAL_REFERENCE_MISSING = 'External reference is missing.';
    public const RESPONSE_DETAILS_COMPANY_NOT_FOUND = 'Product list not found.';
    public const RESPONSE_DETAILS_NO_PERMISSION = 'No permission to read product list.';
}
