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
use GrahamCampbell\Core\Models\Interfaces\ITitleModel;
use GrahamCampbell\Core\Models\Common\TraitTitleModel;
use GrahamCampbell\Core\Models\Interfaces\IBodyModel;
use GrahamCampbell\Core\Models\Common\TraitBodyModel;
use GrahamCampbell\Core\Models\Interfaces\IDateModel;
use GrahamCampbell\Core\Models\Common\TraitDateModel;
use GrahamCampbell\CMSCore\Models\Interfaces\IMailedModel;
use GrahamCampbell\CMSCore\Models\Common\TraitMailedModel;
use GrahamCampbell\CMSCore\Models\Interfaces\ILocationModel;
use GrahamCampbell\CMSCore\Models\Common\TraitLocationModel;
use GrahamCampbell\CMSCore\Models\Relations\Interfaces\IBelongsToUser;
use GrahamCampbell\CMSCore\Models\Relations\Common\TraitBelongsToUser;
use GrahamCampbell\CMSCore\Models\Relations\Interfaces\IBelongsToManyUsers;
use GrahamCampbell\CMSCore\Models\Relations\Common\TraitBelongsToManyUsers;

/**
 * This is the event model class.
 *
 * @package    CMS-Core
 * @author     Graham Campbell
 * @copyright  Copyright (C) 2013  Graham Campbell
 * @license    https://github.com/GrahamCampbell/CMS-Core/blob/develop/LICENSE.md
 * @link       https://github.com/GrahamCampbell/CMS-Core
 */
class Event extends AbstractModel implements ITitleModel, IBodyModel, IDateModel, IMailedModel, ILocationModel, IBelongsToUser, IBelongsToManyUsers
{
    use TraitTitleModel, TraitBodyModel, TraitDateModel, TraitMailedModel, TraitLocationModel, TraitBelongsToUser, TraitBelongsToManyUsers;

    /**
     * The table the events are stored in.
     *
     * @var string
     */
    protected $table = 'events';

    /**
     * The model name.
     *
     * @var string
     */
    public static $name = 'event';

    /**
     * The columns to select when displaying an index.
     *
     * @var array
     */
    public static $index = array('id', 'title', 'date');

    /**
     * The max events per page when displaying a paginated index.
     *
     * @var int
     */
    public static $paginate = 10;

    /**
     * The columns to order by when displaying an index.
     *
     * @var string
     */
    public static $order = 'date';

    /**
     * The direction to order by when displaying an index.
     *
     * @var string
     */
    public static $sort = 'asc';

    /**
     * The event validation rules.
     *
     * @var array
     */
    public static $rules = array(
        'title'    => 'required',
        'location' => 'required',
        'date'     => 'required',
        'body'     => 'required',
        'user_id'  => 'required'
    );

    /**
     * The event factory.
     *
     * @var array
     */
    public static $factory = array(
        'id'       => 1,
        'title'    => 'String',
        'location' => 'text',
        'date'     => '2013-08-01 12:34:56',
        'body'     => 'The body of a post.',
        'mailed'   => 0,
        'user_id'  => 1
    );

    /**
     * Before deleting an existing model.
     *
     * @return mixed
     */
    public function beforeDelete()
    {
        $this->deleteInvites();
    }
}
