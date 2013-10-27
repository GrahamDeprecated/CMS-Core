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

use Event;
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

        $subscriber = new GrahamCampbell\CMSCore\Subscribers\EventSubscriber;
        Event::subscribe($subscriber);

        $subscriber = new GrahamCampbell\CMSCore\Subscribers\PostSubscriber;
        Event::subscribe($subscriber);

        $subscriber = new GrahamCampbell\CMSCore\Subscribers\UserSubscriber;
        Event::subscribe($subscriber);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {
        $this->app['commentprovider'] = $this->app->share(function($app) {
            return new Providers\CommentProvider;
        });
        $this->app['eventprovider'] = $this->app->share(function($app) {
            return new Providers\EventProvider;
        });
        $this->app['groupprovider'] = $this->app->share(function($app) {
            return new Providers\GroupProvider;
        });
        $this->app['jobprovider'] = $this->app->share(function($app) {
            return new Providers\JobProvider;
        });
        $this->app['pageprovider'] = $this->app->share(function($app) {
            return new Providers\PageProvider;
        });
        $this->app['postprovider'] = $this->app->share(function($app) {
            return new Providers\PostProvider;
        });
        $this->app['userprovider'] = $this->app->share(function($app) {
            return new Providers\UserProvider;
        });
        $this->app['navigation'] = $this->app->share(function($app) {
            return new Classes\Navigation;
        });
        $this->app['queuing'] = $this->app->share(function($app) {
            return new Classes\Queuing;
        });
        $this->app['cron'] = $this->app->share(function($app) {
            return new Classes\Cron;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides() {
        return array('commentprovider', 'eventprovider', 'groupprovider', 'pageprovider', 'postprovider', 'userprovider', 'navigation', 'queuing', 'cron');
    }
}
