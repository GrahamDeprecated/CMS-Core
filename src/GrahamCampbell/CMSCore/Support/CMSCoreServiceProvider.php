<?php namespace GrahamCampbell\CMSCore\Support;

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

use Illuminate\Support\ServiceProvider;
use GrahamCampbell\CMSCore\Providers\CommentProvider;
use GrahamCampbell\CMSCore\Providers\EventProvider;
use GrahamCampbell\CMSCore\Providers\FileProvider;
use GrahamCampbell\CMSCore\Providers\FolderProvider;
use GrahamCampbell\CMSCore\Providers\GroupProvider;
use GrahamCampbell\CMSCore\Providers\PageProvider;
use GrahamCampbell\CMSCore\Providers\PostProvider;
use GrahamCampbell\CMSCore\Providers\UserProvider;

class CMSCoreServiceProvider extends ServiceProvider {

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
    public function boot() {
        $this->package('graham-campbell/cmscore');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {
        $this->app['commentprovider'] = $this->app->share(function ($app) {
            return new CommentProvider;
        });
        $this->app['eventprovider'] = $this->app->share(function ($app) {
            return new EventProvider;
        });
        $this->app['fileprovider'] = $this->app->share(function ($app) {
            return new FileProvider;
        });
        $this->app['folderprovider'] = $this->app->share(function ($app) {
            return new FolderProvider;
        });
        $this->app['groupprovider'] = $this->app->share(function ($app) {
            return new GroupProvider;
        });
        $this->app['pageprovider'] = $this->app->share(function ($app) {
            return new PageProvider;
        });
        $this->app['postprovider'] = $this->app->share(function ($app) {
            return new PostProvider;
        });
        $this->app['userprovider'] = $this->app->share(function ($app) {
            return new UserProvider;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides() {
        return array('commentprovider', 'eventprovider', 'fileprovider', 'folderprovider', 'groupprovider', 'pageprovider', 'postprovider', 'userprovider');
    }
}
