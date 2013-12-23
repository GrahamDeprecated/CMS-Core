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

use GrahamCampbell\Credentials\Controllers\AbstractController as Controller;

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
     * A list of methods protected by edit permissions.
     *
     * @var array
     */
    protected $edits = array();

    /**
     * A list of methods protected by blog permissions.
     *
     * @var array
     */
    protected $blogs = array();

    /**
     * Constructor (setup protection and permissions).
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->beforeFilter('auth:edit', array('only' => $this->edits));
        $this->beforeFilter('auth:blog', array('only' => $this->blogs));

        $this->beforeFilter('csrf', array('on' => 'post'));
    }
}
