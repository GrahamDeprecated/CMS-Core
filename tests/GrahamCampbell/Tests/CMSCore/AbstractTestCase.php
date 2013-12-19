<?php namespace GrahamCampbell\Tests\CMSCore;

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

use Orchestra\Testbench\TestCase as Testbench;

/**
 * This is the abstract test case class.
 *
 * @package    CMS-Core
 * @author     Graham Campbell
 * @copyright  Copyright (C) 2013  Graham Campbell
 * @license    https://github.com/GrahamCampbell/CMS-Core/blob/develop/LICENSE.md
 * @link       https://github.com/GrahamCampbell/CMS-Core
 */
abstract class AbstractTestCase extends Testbench
{
    protected function getEnvironmentSetUp($app)
    {
        $app['path.base'] = realpath(__DIR__.'/../../../../src');

        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', array(
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => ''
        ));
    }

    protected function getPackageProviders()
    {
        return array(
            'Cartalyst\Sentry\SentryServiceProvider',
            'Lightgear\Asset\AssetServiceProvider',
            'VTalbot\Markdown\MarkdownServiceProvider',
            'GrahamCampbell\Queuing\QueuingServiceProvider',
            'GrahamCampbell\HTMLMin\HTMLMinServiceProvider',
            'GrahamCampbell\Security\SecurityServiceProvider',
            'GrahamCampbell\Binput\BinputServiceProvider',
            'GrahamCampbell\Passwd\PasswdServiceProvider',
            'GrahamCampbell\Navigation\NavigationServiceProvider',
            'GrahamCampbell\CMSCore\CMSCoreServiceProvider'
        );
    }
}
