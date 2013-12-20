<?php namespace GrahamCampbell\Tests\CMSCore\Facades;

/**
 * This file is part of CMS Core by Graham Campbell.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 */

use ReflectionClass;
use GrahamCampbell\Tests\CMSCore\AbstractTestCase;

/**
 * This is the abstract facade test case class.
 *
 * @package    CMS-Core
 * @author     Graham Campbell
 * @copyright  Copyright (C) 2013  Graham Campbell
 * @license    https://github.com/GrahamCampbell/CMS-Core/blob/develop/LICENSE.md
 * @link       https://github.com/GrahamCampbell/CMS-Core
 */
abstract class AbstractFacadeTestCase extends AbstractTestCase
{
    abstract protected function getFacadeAccessor();

    abstract protected function getFacadeClass();

    abstract protected function getFacadeRoot();

    protected function getFacade() {
        return new $this->getFacadeClass();
    }

    public function testIsAFacade()
    {
        $this->assertInstanceOf('Illuminate\Support\Facades\Facade', $this->getFacade());
    }

    public function testFacadeAccessor() {
        $reflection = new ReflectionClass($this->getFacadeClass());
        $method = $reflection->getMethod("getFacadeAccessor");
        $method->setAccessible(true);

        $this->assertEquals($this->getFacadeAccessor(), $method->invoke($this->getFacade()));
    }

    public function testFacadeRoot() {
        $this->assertInstanceOf($this->getFacadeRoot(), $this->getFacade()->getFacadeRoot());
    }
}
