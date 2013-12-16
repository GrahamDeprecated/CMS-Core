<?php namespace GrahamCampbell\CMSCore\Tests;

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
 *
 * @package    CMS-Core
 * @author     Graham Campbell
 * @license    GNU AFFERO GENERAL PUBLIC LICENSE
 * @copyright  Copyright (C) 2013  Graham Campbell
 * @link       https://github.com/GrahamCampbell/CMS-Core
 */

use Orchestra\Testbench\TestCase as Testbench;

abstract class TestCase extends Testbench
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
            'GrahamCampbell\Queuing\QueuingServiceProvider',
            'GrahamCampbell\HTMLMin\HTMLMinServiceProvider',
            'GrahamCampbell\Markdown\MarkdownServiceProvider',
            'GrahamCampbell\Security\SecurityServiceProvider',
            'GrahamCampbell\Binput\BinputServiceProvider',
            'GrahamCampbell\Passwd\PasswdServiceProvider',
            'GrahamCampbell\Navigation\NavigationServiceProvider',
            'GrahamCampbell\CMSCore\Support\CMSCoreServiceProvider'
        );
    }
}
