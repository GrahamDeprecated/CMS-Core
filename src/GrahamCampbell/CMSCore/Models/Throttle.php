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

namespace GrahamCampbell\CMSCore\Models;

use Cartalyst\Sentry\Throttling\Eloquent\Throttle as SentryThrottle;
use GrahamCampbell\Core\Models\Interfaces\IBaseModel;
use GrahamCampbell\Core\Models\Common\TraitBaseModel;

/**
 * This is the throttle model class.
 *
 * @package    CMS-Core
 * @author     Graham Campbell
 * @copyright  Copyright (C) 2013  Graham Campbell
 * @license    https://github.com/GrahamCampbell/CMS-Core/blob/develop/LICENSE.md
 * @link       https://github.com/GrahamCampbell/CMS-Core
 */
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
