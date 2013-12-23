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

namespace GrahamCampbell\CMSCore\Classes;

use Cartalyst\Sentry\Sentry;
use Illuminate\Config\Repository;
use Illuminate\Events\Dispatcher;
use Illuminate\View\Environment;
use GrahamCampbell\Navigation\Classes\Navigation;
use GrahamCampbell\CMSCore\Providers\PageProvider;
use GrahamCampbell\Credentials\Classes\Viewer as CredentialsViewer;

/**
 * This is the view class.
 *
 * @package    CMS-Core
 * @author     Graham Campbell
 * @copyright  Copyright (C) 2013  Graham Campbell
 * @license    https://github.com/GrahamCampbell/CMS-Core/blob/develop/LICENSE.md
 * @link       https://github.com/GrahamCampbell/CMS-Core
 */
class Viewer extends CredentialsViewer
{
    /**
     * The config instance.
     *
     * @var \Illuminate\Config\Repository
     */
    protected $config;

    /**
     * The event instance.
     *
     * @var \Illuminate\Events\Dispatcher
     */
    protected $event;

    /**
     * The navigation instance.
     *
     * @var \GrahamCampbell\Navigation\Classes\Navigation
     */
    protected $navigation;

    /**
     * The page provider instance.
     *
     * @var \GrahamCampbell\CMSCore\Providers\PageProvider
     */
    protected $pageprovider;

    /**
     * Constructor (setup protection and permissions).
     *
     * @param  \Illuminate\View\Engines\EngineResolver  $engines
     * @param  \Illuminate\View\ViewFinderInterface  $finder
     * @param  \Illuminate\Events\Dispatcher  $event
     * @param  \Cartalyst\Sentry\Sentry  $sentry
     * @return void
     */
    public function __construct(Environment $view, Sentry $sentry, Repository $config, Dispatcher $event, Navigation $navigation, PageProvider $pageprovider)
    {
        parent::__construct($view, $sentry);

        $this->config = $config;
        $this->event = $event;
        $this->navigation = $navigation;
        $this->pageprovider = $pageprovider;
    }

    /**
     * Get a evaluated view contents for the given view.
     *
     * @param  string  $view
     * @param  array   $data
     * @param  array   $mergeData
     * @param  bool    $admin
     * @return \Illuminate\View\View
     */
    public function make($view, $data = array(), $admin = false)
    {
        if ($this->sentry->check()) {
            $this->pageprovider->setNavUser(true);
            $this->event->fire('viewer.make', array(array('View' => $view, 'User' => true, 'Admin' => $admin)));

            if ($admin) {
                if ($this->sentry->getUser()->hasAccess('admin')) {
                    $data['site_name'] = 'Admin Panel';
                    $data['navigation'] = $this->navigation->getHTML('admin', 'admin', array('title' => $data['site_name'], 'side' => $this->sentry->getUser()->email, 'inverse' => $this->config['theme.inverse']));
                } else {
                    $data['site_name'] = $this->config['platform.name'];
                    $data['navigation'] = $this->navigation->getHTML('default', 'default', array('title' => $data['site_name'], 'side' => $this->sentry->getUser()->email, 'inverse' => $this->config['theme.inverse']));
                }
            } else {
                $data['site_name'] = $this->config['platform.name'];
                $data['navigation'] = $this->navigation->getHTML('default', 'default', array('title' => $data['site_name'], 'side' => $this->sentry->getUser()->email, 'inverse' => $this->config['theme.inverse']));
            }
        } else {
            $this->pageprovider->setNavUser(false);
            $this->event->fire('viewer.make', array(array('View' => $view, 'User' => false, 'Admin' => $admin)));

            $data['site_name'] = $this->config['platform.name'];
            $data['navigation'] = $this->navigation->getHTML('default', false, array('title' => $data['site_name'], 'inverse' => $this->config['theme.inverse']));
        }

        return $this->make($view, $data);
    }
}
