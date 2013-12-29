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

namespace GrahamCampbell\CMSCore\Providers;

// TODO: inject cache and config instead of using facades
use Illuminate\Support\Facades\Cache;
use GrahamCampbell\Core\Providers\AbstractProvider;
use GrahamCampbell\Core\Providers\Interfaces\PaginateProviderInterface;
use GrahamCampbell\Core\Providers\Common\PaginateProviderTrait;
use GrahamCampbell\Core\Providers\Interfaces\SlugProviderInterface;
use GrahamCampbell\Core\Providers\Common\SlugProviderTrait;

/**
 * This is the page provider class.
 *
 * @package    CMS-Core
 * @author     Graham Campbell
 * @copyright  Copyright (C) 2013  Graham Campbell
 * @license    https://github.com/GrahamCampbell/CMS-Core/blob/develop/LICENSE.md
 * @link       https://github.com/GrahamCampbell/CMS-Core
 */
class PageProvider extends AbstractProvider implements PaginateProviderInterface, SlugProviderInterface
{
    use PaginateProviderTrait, SlugProviderTrait;

    /**
     * A cache of the page navigation.
     *
     * @var array
     */
    protected $nav = array();

    /**
     * The navigation user boolean.
     *
     * @var bool
     */
    protected $user = false;

    /**
     * Get the page navigation.
     *
     * @return array
     */
    public function navigation()
    {
        // caching logic
        if ($this->validCache($this->nav)) {
            // get the value from the class cache
            $value = $this->nav;
        } else {
            // pull from the cache
            $value = $this->getCache();
            // check if the value is valid
            if (!$this->validCache($value)) {
                // if is invalid, do the work
                $value = $this->sendGet();
                // add the value from the work to the cache
                $this->setCache($value);
            }
        }

        // cache the value in the class
        $this->nav = $value;

        // spit out the value
        return $value;
    }

    /**
     * Flush the page navigation from the cache.
     *
     * @return void
     */
    public function flush()
    {
        Cache::forget('navigation');
    }

    /**
     * Refresh the page navigation cache.
     *
     * @return void
     */
    public function refresh()
    {
        $this->setCache($this->sendGet());
    }

    /**
     * Get the page navigation by working.
     *
     * @return array
     */
    protected function sendGet()
    {
        $model = $this->model;
        return $model::where('show_nav', '=', true)->get(array('title', 'slug', 'icon'))->toArray();
    }

    /**
     * Get the page navigation from the cache.
     *
     * @return array
     */
    protected function getCache()
    {
        return Cache::get('navigation');
    }

    /**
     * Set the page navigation in the cache.
     *
     * @param  array  $value
     * @return void
     */
    protected function setCache($value)
    {
        Cache::forever('navigation', $value);
    }

    /**
     * Check of the nav var is not corrupt.
     *
     * @param  array  $value
     * @return bool
     */
    protected function validCache($value)
    {
        if (is_null($value) || !is_array($value) || empty($value)) {
            return false;
        }

        return true;
    }

    /**
     * Get the navigation user boolean.
     *
     * @return bool
     */
    public function getNavUser()
    {
        return $this->user;
    }

    /**
     * Set the navigation user boolean.
     *
     * @param  bool  $user
     * @return void
     */
    public function setNavUser($user)
    {
        $this->user = $user;
    }
}
