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

class Reply extends BaseModel implements Interfaces\IBodyModel, Interfaces\IVersionModel, Relations\Interfaces\IBelongsToTopic, Relations\Interfaces\IBelongsToUser {

    use Common\TraitBodyModel, Common\TraitVersionModel, Relations\Common\TraitBelongsToTopic, Relations\Common\TraitBelongsToUser;

    /**
     * The table the replies are stored in.
     *
     * @var string
     */
    protected $table = 'replies';

    /**
     * The model name.
     *
     * @var string
     */
    public static $name = 'reply';

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
     * The reply validation rules.
     *
     * @var array
     */
    public static $rules = array(
        'body'     => 'required',
        'user_id'  => 'required',
        'topic_id' => 'required'
    );

    /**
     * The reply factory.
     *
     * @var array
     */
    public static $factory = array(
        'id'       => 1,
        'body'     => 'This a reply!',
        'user_id'  => 1,
        'topic_id' => 1,
        'version'  => 1
    );
}
