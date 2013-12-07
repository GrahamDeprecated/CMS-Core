<?php namespace GrahamCampbell\CMSCore\Controllers;

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

use App;
use Config;
use Event;
use View;

use Sentry;

use GrahamCampbell\Navigation\Facades\Navigation;
use GrahamCampbell\CMSCore\Facades\PageProvider;
use GrahamCampbell\Core\Controllers\BaseController as Controller;

abstract class BaseController extends Controller {

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
    public function __construct() {
        $this->beforeFilter('csrf', array('on' => 'post'));

        Sentry::getThrottleProvider()->enable();

        $this->beforeFilter('auth:user', array('only' => $this->users));
        $this->beforeFilter('auth:edit', array('only' => $this->edits));
        $this->beforeFilter('auth:blog', array('only' => $this->blogs));
        $this->beforeFilter('auth:mod', array('only' => $this->mods));
        $this->beforeFilter('auth:admin', array('only' => $this->admins));
    }

    /**
     * Make a page view.
     *
     * @return \Illuminate\View\View
     */
    protected function viewMake($view, $data = array(), $admin = false) {
        if (Sentry::check()) {
            PageProvider::setNavUser(true);
            Event::fire('view.make', array(array('View' => $view, 'User' => true)));

            if ($admin) {
                if (Sentry::getUser()->hasAccess('admin')) {
                    $data['site_name'] = 'Admin Panel';
                    $data['navigation'] = Navigation::getHTML('admin', 'admin', array('title' => $data['site_name'], 'side' => Sentry::getUser()->email, 'inverse' => Config::get('theme.inverse')));
                } else {
                    $data['site_name'] = Config::get('cms.name');
                    $data['navigation'] = Navigation::getHTML('default', 'default', array('title' => $data['site_name'], 'side' => Sentry::getUser()->email, 'inverse' => Config::get('theme.inverse')));
                }
            } else {
                $data['site_name'] = Config::get('cms.name');
                $data['navigation'] = Navigation::getHTML('default', 'default', array('title' => $data['site_name'], 'side' => Sentry::getUser()->email, 'inverse' => Config::get('theme.inverse')));
            }
        } else {
            PageProvider::setNavUser(false);
            Event::fire('view.make', array(array('View' => $view, 'User' => false)));

            $data['site_name'] = Config::get('cms.name');
            $data['navigation'] = Navigation::getHTML('default', false, array('title' => $data['site_name'], 'inverse' => Config::get('theme.inverse')));
        }

        return View::make($view, $data);
    }

    /**
     * Set the permission.
     *
     * @pram  string  $action
     * @pram  string  $permission
     * @return void
     */
    protected function setPermission($action, $permission) {
        $this->{$permission.'s'}[] = $action;
    }

    /**
     * Set the permissions.
     *
     * @pram  array  $permissions
     * @return void
     */
    protected function setPermissions($permissions) {
        foreach ($permissions as $action => $permission) {
            $this->setPermission($action, $permission);
        }
    }

    /**
     * Set the user id.
     *
     * @return int
     */
    protected function getUserId() {
        if (Sentry::getUser()) {
            return Sentry::getUser()->getId();
        } else {
            return 1;
        }
    }

    /**
     * Handle calls to missing methods on the controller.
     *
     * @param  array   $parameters
     * @return \Illuminate\Http\Response
     */
    public function missingMethod($parameters = array()) {
        return App::abort(405, 'Missing Controller Method');
    }
}
