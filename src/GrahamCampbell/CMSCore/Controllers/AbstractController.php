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

namespace GrahamCampbell\CMSCore\Controllers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use Cartalyst\Sentry\Facades\Laravel\Sentry;
use GrahamCampbell\Navigation\Facades\Navigation;
use GrahamCampbell\CMSCore\Facades\PageProvider;
use GrahamCampbell\Core\Controllers\AbstractController as Controller;

/**
 * This is the abstract controller class.
 *
 * @package    CMS-Core
 * @author     Graham Campbell
 * @copyright  Copyright (C) 2013  Graham Campbell
 * @license    https://github.com/GrahamCampbell/CMS-Core/blob/develop/LICENSE.md
 * @link       https://github.com/GrahamCampbell/CMS-Core
 */
abstract class AbstractController extends Controller
{
    /**
     * A list of methods protected by user permissions.
     *
     * @var array
     */
    private $users = array();

    /**
     * A list of methods protected by edit permissions.
     *
     * @var array
     */
    private $edits = array();

    /**
     * A list of methods protected by blog permissions.
     *
     * @var array
     */
    private $blogs = array();

    /**
     * A list of methods protected by mod permissions.
     *
     * @var array
     */
    private $mods = array();

    /**
     * A list of methods protected by admin permissions.
     *
     * @var array
     */
    private $admins = array();

    /**
     * Constructor (setup protection and permissions).
     *
     * @return void
     */
    public function __construct()
    {
        $this->beforeFilter('csrf', array('on' => 'post'));

        Sentry::getThrottleProvider()->enable();

        $this->beforeFilter('auth:user', array('only' => $this->users));
        $this->beforeFilter('auth:edit', array('only' => $this->edits));
        $this->beforeFilter('auth:blog', array('only' => $this->blogs));
        $this->beforeFilter('auth:mod', array('only' => $this->mods));
        $this->beforeFilter('auth:admin', array('only' => $this->admins));
    }

    /**
     * Set the permission.
     *
     * @pram  string  $action
     * @pram  string  $permission
     * @return void
     */
    protected function setPermission($action, $permission)
    {
        $this->{$permission.'s'}[] = $action;
    }

    /**
     * Set the permissions.
     *
     * @pram  array  $permissions
     * @return void
     */
    protected function setPermissions($permissions)
    {
        foreach ($permissions as $action => $permission) {
            $this->setPermission($action, $permission);
        }
    }

    /**
     * Set the user id.
     *
     * @return int
     */
    protected function getUserId()
    {
        if (Sentry::getUser()) {
            return Sentry::getUser()->getId();
        } else {
            return 1;
        }
    }
}
