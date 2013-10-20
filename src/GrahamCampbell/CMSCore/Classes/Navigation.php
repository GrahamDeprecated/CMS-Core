<?php namespace GrahamCampbell\CMSCore\Classes;

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

use Cache;
use Config;
use Request;
use Sentry;
use URL;

use GrahamCampbell\CMSCore\Models\Page;
use GrahamCampbell\CMSCore\Facades\PageProvider;

class Navigation {

    /**
     * An extra array of items to be added to the main nav bar.
     *
     * @var array
     */
    protected $main = array();

    /**
     * An extra array of items to be added to the bar nav bar.
     *
     * @var array
     */
    protected $bar = array();

    /**
     * An extra array of items to be added to the admin nav bar.
     *
     * @var array
     */
    protected $admin = array();

    /**
     * Get the processed nav var by name.
     *
     * @param  string  $name
     * @return array
     */
    public function get($name = 'main') {
        switch ($name) {
            case 'main':
                $nav = $this->getMain();
                break;
            case 'bar':
                $nav = $this->getBar();
                break;
            case 'admin':
                $nav = $this->getAdmin();
                break;
            default:
                throw new \InvalidArgumentException($name.' is not a valid item');
        }

        // check if each item is active
        foreach ($nav as $key => $value) {
            // check if it is local
            if (isset($value['slug'])) {
                // if the request starts with the slug
                if (Request::is($value['slug']) || Request::is($value['slug'].'/*')) {
                    // then the navigation item is active, or selected
                    $nav[$key]['active'] = true;
                } else {
                    // then the navigation item is not active or selected
                    $nav[$key]['active'] = false;
                }
            } else {
                // then the navigation item is not active or selected
                $nav[$key]['active'] = false;
            }
        }

        // convert slugs to urls
        foreach ($nav as $key => $value) {
            // if the url is not set
            if (!isset($value['url'])) {
                // set the url based on the slug
                $nav[$key]['url'] = URL::to($value['slug']);
            }
            // remove any remaining slugs
            unset($nav[$key]['slug']);
        }

        // spit out the nav bar array at the end
        return $nav;
    }

    /**
     * Get the processed main nav var.
     *
     * @return array
     */
    protected function getMain() {
        $raw = $this->goGet('main');

        // separate the first page
        $value = $raw[0];
        unset($raw[0]);
        // the page slug is prepended by 'pages/'
        $value['slug'] = 'pages/'.$value['slug'];
        // make sure it is at the very start of the nav bar
        $nav[] = $value;

        // add the extra items to the nav bar
        foreach ($this->main as $item) {
            $nav[] = $item;
        }

        // add the blog page after the fist page if blogging is enabled
        if (Config::get('cms.blogging')) {
            $nav[] = array('title' => 'Blog', 'slug' => 'blog/posts', 'icon' => 'icon-book');
        }

        // add the events page after the fist page if events are enabled
        if (Config::get('cms.events')) {
            $nav[] = array('title' => 'Events', 'slug' => 'events', 'icon' => 'icon-calendar');
        }

        // add the remaining pages to the nav bar
        foreach ($raw as $key => $value) {
            // each page slug is preppended by 'pages/'
            $value['slug'] = 'pages/'.$raw[$key]['slug'];
            $nav[] = $value;
        }

        // spit out the nav bar array at the end
        return $nav;
    }

    /**
     * Get the processed bar nav var.
     *
     * @return array
     */
    protected function getBar() {
        // $nav = $this->goGet('bar');
        $nav = array();

        // add the profile links
        $nav[] = array('title' => 'View Profile', 'slug' => 'account/profile', 'icon' => 'icon-cog');

        // add the admin links
        if (Sentry::getUser()->hasAccess('admin')) {
            $nav[] = array('title' => 'View Logs', 'slug' => 'logviewer', 'icon' => 'icon-wrench');
            $nav[] = array('title' => 'Cloudflare', 'slug' => 'cloudflare', 'icon' => 'icon-cloud');
        }

        // add the view users link
        if (Sentry::getUser()->hasAccess('mod')) {
            $nav[] = array('title' => 'View Users', 'slug' => 'users', 'icon' => 'icon-user');
        }

        // add the create user link
        if (Sentry::getUser()->hasAccess('admin')) {
            $nav[] = array('title' => 'Create User', 'slug' => 'users/create', 'icon' => 'icon-star');
        }

        // add the create page link
        if (Sentry::getUser()->hasAccess('edit')) {
            $nav[] = array('title' => 'Create Page', 'slug' => 'pages/create', 'icon' => 'icon-pencil');
        }

        // add the create post link
        if (Config::get('cms.blogging')) {
            if (Sentry::getUser()->hasAccess('blog')) {
                $nav[] = array('title' => 'Create Post', 'slug' => 'blog/posts/create', 'icon' => 'icon-book');
            }
        }

        // add the create event link
        if (Config::get('cms.events')) {
            if (Sentry::getUser()->hasAccess('edit')) {
                $nav[] = array('title' => 'Create Event', 'slug' => 'events/create', 'icon' => 'icon-calendar');
            }
        }
        
        // add the extra items to the nav bar
        foreach ($this->bar as $item) {
            $nav[] = $item;
        }

        // spit out the nav bar array at the end
        return $nav;
    }

    /**
     * Get the processed admin nav var.
     *
     * @return array
     */
    protected function getAdmin() {
        $raw = $this->goGet('admin');

        // separate the first page
        $value = $raw[0];
        unset($raw[0]);
        // the page slug is prepended by 'pages/'
        $value['slug'] = 'pages/'.$value['slug'];
        // make sure it is at the very start of the nav bar
        $nav[] = $value;

        // add the admin links
        if (Sentry::getUser()->hasAccess('admin')) {
            $nav[] = array('title' => 'Logs', 'slug' => 'logviewer', 'icon' => 'icon-wrench');
            $nav[] = array('title' => 'Cloudflare', 'slug' => 'cloudflare', 'icon' => 'icon-cloud');
        }

        // add the view users link
        if (Sentry::getUser()->hasAccess('mod')) {
            $nav[] = array('title' => 'Users', 'slug' => 'users', 'icon' => 'icon-user');
        }

        // add the extra items to the nav bar
        foreach ($this->admin as $item) {
            $nav[] = $item;
        }

        // spit out the nav bar array at the end
        return $nav;
    }

    /**
     * Get the raw nav var by name.
     *
     * @param  string  $name
     * @return array
     */
    protected function goGet($name) {
        // if caching is enabled
        if (Config::get('cms.cache') === true) {
            // check if the cache needs regenerating
            if ($this->validCache($name)) {
                // if not, then pull from the cache
                $value = $this->getCache($name);
                // check if the value is valid
                if ($this->validValue($value)) {
                    // if is invalid, do the work
                    $value = $this->sendGet($name);
                    // add the value from the work to the cache
                    $this->setCache($name, $value);
                }
            } else {
                // if regeneration is needed, do the work
                $value = $this->sendGet($name);
                // add the value from the work to the cache
                $this->setCache($name, $value);
            }
        } else {
            // do the work because caching is disabled
            $value = $this->sendGet($name);
        }

        // spit out the value
        return $value;
    }

    /**
     * Get the raw nav var by name by working.
     *
     * @param  string  $name
     * @return array
     */
    protected function sendGet($name) {
        switch ($name) {
            case 'main':
                return $this->sendGetMain();
            case 'bar':
                return $this->sendGetBar();
            case 'admin':
                return $this->sendGetAdmin();
            default:
                throw new \InvalidArgumentException($name.' is not a valid item');
        }
    }

    /**
     * Get the raw main nav var by working.
     *
     * @return array
     */
    protected function sendGetMain() {
        return Page::where('show_nav', '=', true)->get(array('title', 'slug', 'icon'))->toArray();
    }

    /**
     * Get the raw bar nav var by working.
     *
     * @return array
     */
    protected function sendGetBar() {
        // never called
    }

    /**
     * Get the raw admin nav var by working.
     *
     * @return array
     */
    protected function sendGetAdmin() {
        return array(PageProvider::find('home', array('title', 'slug', 'icon'))->toArray());
    }

    /**
     * Get the raw nav var by name from the cache.
     *
     * @param  string  $name
     * @return array
     */
    protected function getCache($name) {
        return Cache::section('nav')->get($name);
    }

    /**
     * Set the raw nav var by name in the cache.
     *
     * @param  string  $name
     * @param  string  $value
     * @return void
     */
    protected function setCache($name, $value) {
        Cache::section('nav')->forever($name, $value);
    }

    /**
     * Flush all nav vars from the cache.
     *
     * @return void
     */
    protected function flushCache() {
        Cache::section('nav')->flush();
    }

    /**
     * Purge the nav var by name in the cache.
     *
     * @param  string  $name
     * @return void
     */
    protected function purgeCache($name) {
        Cache::section('nav')->forget($name);
    }

    /**
     * Check of the nav var by name is cached and is current.
     *
     * @param  string  $name
     * @return bool
     */
    protected function validCache($name) {
        return Cache::section('nav')->has($name);
    }

    /**
     * Check of the nav var by name is not corrupt.
     *
     * @param  string  $value
     * @return bool
     */
    protected function validValue($value) {
        return (is_null($value) || !is_array($value));
    }

    /**
     * Flush all nav vars from the cache if the cache in enabled.
     *
     * @return void
     */
    public function flush() {
        if (Config::get('cms.cache') === true) {
            $this->flushCache();
        }
    }

    /**
     * Purge the nav var by name in the cache if the cache in enabled.
     *
     * @param  string  $name
     * @return void
     */
    public function purge($name = 'main') {
        if (Config::get('cms.cache') === true) {
            $this->purgeCache($name);
        }
    }

    /**
     * Refresh the raw nav var by name in the cache if the cache in enabled.
     *
     * @param  string  $name
     * @return void
     */
    public function refresh($name = 'main') {
        if (Config::get('cms.cache') === true) {
            $this->setCache($name, $this->sendGet($name));
        }
    }

    /**
     * Add an extra item to the nav bar.
     *
     * @param  string  $name
     * @param  array   $item
     * @return void
     */
    public function addItem($name, array $item) {
        switch ($name) {
            case 'main':
                $nav = $this->addMain($item);
                break;
            case 'bar':
                $nav = $this->addBar($item);
                break;
            case 'admin':
                $nav = $this->addAdmin($item);
                break;
            default:
                throw new \InvalidArgumentException($name.' is not a valid item');
        }
    }

    /**
     * Add an extra item to the main nav bar.
     *
     * @param  array  $item
     * @return void
     */
    protected function addMain(array $item) {
        $this->main[] = $item;
    }

    /**
     * Add an extra item to the bar nav bar.
     *
     * @param  array  $item
     * @return void
     */
    protected function addBar(array $item) {
        $this->bar[] = $item;
    }

    /**
     * Add an extra item to the admin nav bar.
     *
     * @param  array  $item
     * @return void
     */
    protected function addAdmin(array $item) {
        $this->admin[] = $item;
    }
}
