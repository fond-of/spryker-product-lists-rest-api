<?php

namespace FondOfSpryker\Glue\ProductListsRestApi;

use Codeception\Test\Unit;

class ProductListRestApiDependencyProviderTest extends Unit
{
    /**
     * @return void
     */
    protected function _before()
    {
        parent::_before();
    }

    /**
     * @return void
     */
    public function testProvideDependencies(): void
    {
        $this->assertTrue(true);
    }
}
