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

use GrahamCampbell\Core\Providers\AbstractProvider;
use GrahamCampbell\Core\Providers\Interfaces\PaginateProviderInterface;
use GrahamCampbell\Core\Providers\Common\PaginateProviderTrait;

/**
 * This is the post provider class.
 *
 * @package    CMS-Core
 * @author     Graham Campbell
 * @copyright  Copyright (C) 2013  Graham Campbell
 * @license    https://github.com/GrahamCampbell/CMS-Core/blob/develop/LICENSE.md
 * @link       https://github.com/GrahamCampbell/CMS-Core
 */
class PostProvider extends AbstractProvider implements PaginateProviderInterface
{
    use PaginateProviderTrait;

    /**
     * The name of the model to provide.
     *
     * @var string
     */
    protected $model = 'GrahamCampbell\CMSCore\Models\Post';
}
