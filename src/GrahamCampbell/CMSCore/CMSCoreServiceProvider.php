<?php namespace GrahamCampbell\CMSCore;

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
        $this->app['commentprovider'] = $this->app->share(function($app) {
            return new Providers\CommentProvider($app);
        });
        $this->app['eventprovider'] = $this->app->share(function($app) {
            return new Providers\EventProvider($app);
        });
        $this->app['groupprovider'] = $this->app->share(function($app) {
            return new Providers\GroupProvider($app);
        });
        $this->app['jobprovider'] = $this->app->share(function($app) {
            return new Providers\JobProvider($app);
        });
        $this->app['pageprovider'] = $this->app->share(function($app) {
            return new Providers\PageProvider($app);
        });
        $this->app['postprovider'] = $this->app->share(function($app) {
            return new Providers\PostProvider($app);
        });
        $this->app['userprovider'] = $this->app->share(function($app) {
            return new Providers\UserProvider($app);
        });
        $this->app['navigation'] = $this->app->share(function($app) {
            return new Classes\Navigation($app);
        });
        $this->app['queuing'] = $this->app->share(function($app) {
            return new Classes\Queuing($app);
        });
        $this->app['cron'] = $this->app->share(function($app) {
            return new Classes\Cron($app);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides() {
        return array('commentprovider', 'eventprovider', 'groupprovider', 'jobprovider', 'pageprovider', 'postprovider', 'userprovider', 'navigation', 'queuing', 'cron');
    }
}
