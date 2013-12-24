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
        $this->registerCommentProvider();
        $this->registerEventProvider();
        $this->registerFileProvider();
        $this->registerFolderProvider();
        $this->registerPageProvider();
        $this->registerPostProvider();
    }

    /**
     * Register the comment provider class.
     *
     * @return void
     */
    protected function registerCommentProvider()
    {
        $this->app->bindShared('commentprovider', function ($app) {
            $comment = $app['config']['cms-core::comment'];

            return new Providers\CommentProvider($comment);
        });
    }

    /**
     * Register the event provider class.
     *
     * @return void
     */
    protected function registerEventProvider()
    {
        $this->app->bindShared('eventprovider', function ($app) {
            $event = $app['config']['cms-core::event'];

            return new Providers\EventProvider($event);
        });
    }

    /**
     * Register the file provider class.
     *
     * @return void
     */
    protected function registerFileProvider()
    {
        $this->app->bindShared('fileprovider', function ($app) {
            $file = $app['config']['cms-core::file'];

            return new Providers\FileProvider($file);
        });
    }

    /**
     * Register the folder provider class.
     *
     * @return void
     */
    protected function registerFolderProvider()
    {
        $this->app->bindShared('folderprovider', function ($app) {
            $folder = $app['config']['cms-core::folder'];

            return new Providers\FolderProvider($folder);
        });
    }

    /**
     * Register the page provider class.
     *
     * @return void
     */
    protected function registerPageProvider()
    {
        $this->app->bindShared('pageprovider', function ($app) {
            $page = $app['config']['cms-core::page'];

            return new Providers\PageProvider($page);
        });
    }

    /**
     * Register the post provider class.
     *
     * @return void
     */
    protected function registerPostProvider()
    {
        $this->app->bindShared('postprovider', function ($app) {
            $post = $app['config']['cms-core::post'];

            return new Providers\PostProvider($post);
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
