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

/**
 * This is the user provider facade test case class.
 *
 * @package    CMS-Core
 * @author     Graham Campbell
 * @copyright  Copyright (C) 2013  Graham Campbell
 * @license    https://github.com/GrahamCampbell/CMS-Core/blob/develop/LICENSE.md
 * @link       https://github.com/GrahamCampbell/CMS-Core
 */
class UserProviderTest extends AbstractFacadeTestCase
{
    protected function getFacadeAccessor() {
        return 'userprovider';
    }

    protected function getFacadeClass() {
        return 'GrahamCampbell\CMSCore\Facades\UserProvider';
    }

    protected function getFacadeRoot() {
        return 'GrahamCampbell\CMSCore\Providers\UserProvider';
    }
}
