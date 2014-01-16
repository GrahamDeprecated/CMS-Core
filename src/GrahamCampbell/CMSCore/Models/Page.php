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

use GrahamCampbell\Core\Models\AbstractModel;
use GrahamCampbell\Core\Models\Interfaces\TitleModelInterface;
use GrahamCampbell\Core\Models\Common\TitleModelTrait;
use GrahamCampbell\Core\Models\Interfaces\SlugModelInterface;
use GrahamCampbell\Core\Models\Common\SlugModelTrait;
use GrahamCampbell\Core\Models\Interfaces\BodyModelInterface;
use GrahamCampbell\Core\Models\Common\BodyModelTrait;
use GrahamCampbell\CMSCore\Models\Interfaces\NavModelInterface;
use GrahamCampbell\CMSCore\Models\Common\NavModelTrait;
use GrahamCampbell\CMSCore\Models\Interfaces\PageModelInterface;
use GrahamCampbell\CMSCore\Models\Common\PageModelTrait;
use GrahamCampbell\CMSCore\Models\Relations\Interfaces\BelongsToUserInterface;
use GrahamCampbell\CMSCore\Models\Relations\Common\BelongsToUserTrait;

/**
 * This is the page model class.
 *
 * @package    CMS-Core
 * @author     Graham Campbell
 * @copyright  Copyright (C) 2013-2014  Graham Campbell
 * @license    https://github.com/GrahamCampbell/CMS-Core/blob/master/LICENSE.md
 * @link       https://github.com/GrahamCampbell/CMS-Core
 */
class Page extends AbstractModel implements TitleModelInterface, SlugModelInterface, BodyModelInterface, NavModelInterface, PageModelInterface, BelongsToUserInterface
{
    use TitleModelTrait, SlugModelTrait, BodyModelTrait, NavModelTrait, PageModelTrait, BelongsToUserTrait;

    /**
     * The table the pages are stored in.
     *
     * @var string
     */
    protected $table = 'pages';

    /**
     * The model name.
     *
     * @var string
     */
    public static $name = 'page';

    /**
     * The columns to select when displaying an index.
     *
     * @var array
     */
    public static $index = array('id', 'slug', 'title');

    /**
     * The max pages per page when displaying a paginated index.
     *
     * @var int
     */
    public static $paginate = 10;

    /**
     * The columns to order by when displaying an index.
     *
     * @var string
     */
    public static $order = 'slug';

    /**
     * The direction to order by when displaying an index.
     *
     * @var string
     */
    public static $sort = 'asc';

    /**
     * The page validation rules.
     *
     * @var array
     */
    public static $rules = array(
        'title'      => 'required',
        'slug'       => 'required',
        'body'       => 'required',
        'show_title' => 'required',
        'show_nav'   => 'required',
        'user_id'    => 'required'
    );

    /**
     * The page factory.
     *
     * @var array
     */
    public static $factory = array(
        'id'         => 1,
        'title'      => 'Page Title',
        'slug'       => 'page-title',
        'body'       => 'This is the page body!',
        'css'        => 'ccs',
        'js'         => 'js',
        'show_title' => true,
        'show_nav'   => true,
        'icon'       => 'home',
        'user_id'    => 1
    );
}
