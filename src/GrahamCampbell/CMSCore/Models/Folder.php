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
use GrahamCampbell\CMSCore\Models\Relations\Interfaces\HasManyFilesInterface;
use GrahamCampbell\CMSCore\Models\Relations\Common\HasManyFilesTrait;
use GrahamCampbell\CMSCore\Models\Relations\Interfaces\BelongsToUserInterface;
use GrahamCampbell\CMSCore\Models\Relations\Common\BelongsToUserTrait;

/**
 * This is the folder model class.
 *
 * @package    CMS-Core
 * @author     Graham Campbell
 * @copyright  Copyright (C) 2013-2014  Graham Campbell
 * @license    https://github.com/GrahamCampbell/CMS-Core/blob/master/LICENSE.md
 * @link       https://github.com/GrahamCampbell/CMS-Core
 */
class Folder extends AbstractModel implements HasManyFilesInterface, BelongsToUserInterface
{
    use HasManyFilesTrait, BelongsToUserTrait;

    /**
     * The table the folders are stored in.
     *
     * @var string
     */
    protected $table = 'folders';

    /**
     * The model name.
     *
     * @var string
     */
    public static $name = 'folder';

    /**
     * The columns to select when displaying an index.
     *
     * @var array
     */
    public static $index = array('id', 'title', 'summary', 'created_at');

    /**
     * The max folders per page when displaying a paginated index.
     *
     * @var int
     */
    public static $paginate = 10;

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
     * The folder validation rules.
     *
     * @var array
     */
    public static $rules = array(
        'title'   => 'required',
        'summary' => 'required',
        'user_id' => 'required'
    );

    /**
     * The folder factory.
     *
     * @var array
     */
    public static $factory = array(
        'id'      => 1,
        'title'   => 'Folder',
        'summary' => 'The is a folder with stuff in.',
        'user_id' => 1
    );

    /**
     * Before deleting an existing model.
     *
     * @return mixed
     */
    public function beforeDelete()
    {
        $this->deleteFiles();
    }
}
