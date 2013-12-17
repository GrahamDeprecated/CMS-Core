<?php namespace GrahamCampbell\CMSCore\Models;

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

use Cartalyst\Sentry\Throttling\Eloquent\Throttle as SentryThrottle;
use GrahamCampbell\Core\Models\Interfaces\IBaseModel;
use GrahamCampbell\Core\Models\Common\TraitBaseModel;

class Throttle extends SentryThrottle implements IBaseModel
{
    use TraitBaseModel;

    /**
     * The table the throttles are stored in.
     *
     * @var string
     */
    protected $table = 'throttle';

    /**
     * The model name.
     *
     * @var string
     */
    public static $name = 'throttle';
}
