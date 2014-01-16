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
use GrahamCampbell\Core\Models\Interfaces\BodyModelInterface;
use GrahamCampbell\Core\Models\Common\BodyModelTrait;
use GrahamCampbell\Core\Models\Interfaces\VersionModelInterface;
use GrahamCampbell\Core\Models\Common\VersionModelTrait;
use GrahamCampbell\CMSCore\Models\Relations\Interfaces\BelongsToPostInterface;
use GrahamCampbell\CMSCore\Models\Relations\Common\BelongsToPostTrait;
use GrahamCampbell\CMSCore\Models\Relations\Interfaces\BelongsToUserInterface;
use GrahamCampbell\CMSCore\Models\Relations\Common\BelongsToUserTrait;

/**
 * This is the comment model class.
 *
 * @package    CMS-Core
 * @author     Graham Campbell
 * @copyright  Copyright (C) 2013-2014  Graham Campbell
 * @license    https://github.com/GrahamCampbell/CMS-Core/blob/master/LICENSE.md
 * @link       https://github.com/GrahamCampbell/CMS-Core
 */
class Comment extends AbstractModel implements BodyModelInterface, VersionModelInterface, BelongsToPostInterface, BelongsToUserInterface
{
    use BodyModelTrait, VersionModelTrait, BelongsToPostTrait, BelongsToUserTrait;

    /**
     * The table the comments are stored in.
     *
     * @var string
     */
    protected $table = 'comments';

    /**
     * The model name.
     *
     * @var string
     */
    public static $name = 'comment';

    /**
     * The columns to select when displaying an index.
     *
     * @var array
     */
    public static $index = array('id', 'body', 'user_id', 'created_at', 'version');

    /**
     * The columns to order by when displaying an index.
     *
     * @var string
     */
    public static $order = 'id';

    /**
     * The direction to order by when displaying an index.
     *
     * @var string
     */
    public static $sort = 'desc';

    /**
     * The comment validation rules.
     *
     * @var array
     */
    public static $rules = array(
        'body'    => 'required',
        'user_id' => 'required',
        'post_id' => 'required'
    );

    /**
     * The comment factory.
     *
     * @var array
     */
    public static $factory = array(
        'id'      => 1,
        'body'    => 'This a comment!',
        'user_id' => 1,
        'post_id' => 1,
        'version' => 1
    );
}
