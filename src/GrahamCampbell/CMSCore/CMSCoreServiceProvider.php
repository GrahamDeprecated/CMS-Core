<?php

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

namespace GrahamCampbell\CMSCore;

use Illuminate\Support\ServiceProvider;

/**
 * This is the cms core service provider class.
 *
 * @package    CMS-Core
 * @author     Graham Campbell
 * @copyright  Copyright (C) 2013  Graham Campbell
 * @license    https://github.com/GrahamCampbell/CMS-Core/blob/develop/LICENSE.md
 * @link       https://github.com/GrahamCampbell/CMS-Core
 */
class CMSCoreServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('graham-campbell/cms-core');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app['commentprovider'] = $this->app->share(function ($app) {
            $model = $app['config']['graham-campbell/cms-core::comment'];
            return new Providers\CommentProvider($model);
        });

        $this->app['eventprovider'] = $this->app->share(function ($app) {
            $model = $app['config']['graham-campbell/cms-core::event'];
            return new Providers\EventProvider($model);
        });

        $this->app['fileprovider'] = $this->app->share(function ($app) {
            $model = $app['config']['graham-campbell/cms-core::file'];
            return new Providers\FileProvider($model);
        });

        $this->app['folderprovider'] = $this->app->share(function ($app) {
            $model = $app['config']['graham-campbell/cms-core::folder'];
            return new Providers\FolderProvider($model);
        });

        $this->app['pageprovider'] = $this->app->share(function ($app) {
            $model = $app['config']['graham-campbell/cms-core::page'];
            return new Providers\PageProvider($model);
        });

        $this->app['postprovider'] = $this->app->share(function ($app) {
            $model = $app['config']['graham-campbell/cms-core::post'];
            return new Providers\PostProvider($model);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('commentprovider', 'eventprovider', 'fileprovider', 'folderprovider', 'pageprovider', 'postprovider');
    }
}
