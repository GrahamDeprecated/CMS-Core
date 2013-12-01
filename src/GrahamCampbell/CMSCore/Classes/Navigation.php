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

use Illuminate\Http\Request;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Cache\CacheManager;
use GrahamCampbell\CMSCore\Providers\PageProvider;
use GrahamCampbell\CMSCore\Models\Page;

class Navigation extends BaseClass {

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
     * The request instance.
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * The url instance.
     *
     * @var \Illuminate\Routing\UrlGenerator
     */
    protected $url;

    /**
     * The cache instance.
     *
     * @var \Illuminate\Cache\CacheManager
     */
    protected $cache;

    /**
     * The pageprovider instance.
     *
     * @var \GrahamCampbell\CMSCore\Providers\PageProvider
     */
    protected $pageprovider;

    /**
     * The cache config.
     *
     * @var string
     */
    protected $cacheconfig;

    /**
     * Create a new instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Routing\UrlGenerator  $url
     * @param  \Illuminate\Cache\CacheManager  $cache
     * @param  \GrahamCampbell\CMSCore\Providers\PageProvider  $pageprovider
     * @param  string  $cacheconfig
     * @return void
     */
    public function __construct(Request $request, UrlGenerator $url, Repository $cache, PageProvider $pageprovider, $cacheconfig) {
        $this->request = $request;
        $this->url = $url;
        $this->cache = $cache;
        $this->pageprovider = $pageprovider;
        $this->cacheconfig = $cacheconfig;
    }

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
                if ($this->request->is($value['slug']) || $this->request->is($value['slug'].'/*')) {
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
                $nav[$key]['url'] = $this->url->to($value['slug']);
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
        $nav = $this->goGet('admin');

        // fix the homepage link
        $nav[0]['slug'] = 'pages/'.$nav[0]['slug'];

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
        // check if we are using the cache
        if ($this->cacheconfig === true) {
            // if so, then pull from the cache
            $value = $this->getCache($name);
            // check if the value is valid
            if (!$this->validCache($value)) {
                // if is invalid, do the work
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
        return array($this->pageprovider->find('home', array('title', 'slug', 'icon'))->toArray());
    }

    /**
     * Get the raw nav var by name from the cache.
     *
     * @param  string  $name
     * @return array
     */
    protected function getCache($name) {
        return $this->cache->section('nav')->get($name);
    }

    /**
     * Set the raw nav var by name in the cache.
     *
     * @param  string  $name
     * @param  string  $value
     * @return void
     */
    protected function setCache($name, $value) {
        $this->cache->section('nav')->forever($name, $value);
    }

    /**
     * Flush all nav vars from the cache.
     *
     * @return void
     */
    protected function flushCache() {
        $this->cache->section('nav')->flush();
    }

    /**
     * Purge the nav var by name in the cache.
     *
     * @param  string  $name
     * @return void
     */
    protected function purgeCache($name) {
        $this->cache->section('nav')->forget($name);
    }

    /**
     * Check of the nav var is not corrupt.
     *
     * @param  string  $value
     * @return bool
     */
    protected function validCache($value) {
        if (is_null($value) || !is_array($value)) {
            return false;
        }

        return true;
    }

    /**
     * Flush all nav vars from the cache if the cache in enabled.
     *
     * @return void
     */
    public function flush() {
        if ($this->cacheconfig === true) {
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
        if ($this->cacheconfig === true) {
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
        if ($this->cacheconfig === true) {
            $this->setCache($name, $this->sendGet($name));
        }
    }

    /**
     * Refresh the raw nav var by name in the cache if the cache in enabled.
     *
     * @param  string  $name
     * @return void
     */
    public function regen() {
        if ($this->cacheconfig === true) {
            $this->flushCache();
            $this->setCache('main', $this->sendGet('main'));
            $this->setCache('admin', $this->sendGet('admin'));
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
