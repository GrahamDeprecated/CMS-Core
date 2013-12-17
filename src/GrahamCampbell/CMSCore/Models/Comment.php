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

use GrahamCampbell\Core\Models\BaseModel;
use GrahamCampbell\Core\Models\Interfaces\IBodyModel;
use GrahamCampbell\Core\Models\Common\TraitBodyModel;
use GrahamCampbell\Core\Models\Interfaces\IVersionModel;
use GrahamCampbell\Core\Models\Common\TraitVersionModel;
use GrahamCampbell\CMSCore\Models\Relations\Interfaces\IBelongsToPost;
use GrahamCampbell\CMSCore\Models\Relations\Common\TraitBelongsToPost;
use GrahamCampbell\CMSCore\Models\Relations\Interfaces\IBelongsToUser;
use GrahamCampbell\CMSCore\Models\Relations\Common\TraitBelongsToUser;

class Comment extends BaseModel implements IBodyModel, IVersionModel, IBelongsToPost, IBelongsToUser
{
    use TraitBodyModel, TraitVersionModel, TraitBelongsToPost, TraitBelongsToUser;

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
