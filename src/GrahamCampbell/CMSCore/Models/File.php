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

use Illuminate\Support\Facades\File as LaravelFile;
use GrahamCampbell\Core\Models\AbstractModel;
use GrahamCampbell\Core\Models\Interfaces\TitleModelInterface;
use GrahamCampbell\Core\Models\Common\TitleModelTrait;
use GrahamCampbell\CMSCore\Models\Interfaces\FileModelInterface;
use GrahamCampbell\CMSCore\Models\Common\FileModelTrait;
use GrahamCampbell\CMSCore\Models\Relations\Interfaces\BelongsToUserInterface;
use GrahamCampbell\CMSCore\Models\Relations\Common\BelongsToUserTrait;
use GrahamCampbell\CMSCore\Models\Relations\Interfaces\BelongsToFolderInterface;
use GrahamCampbell\CMSCore\Models\Relations\Common\BelongsToFolderTrait;

/**
 * This is the file model class.
 *
 * @package    CMS-Core
 * @author     Graham Campbell
 * @copyright  Copyright (C) 2013-2014  Graham Campbell
 * @license    https://github.com/GrahamCampbell/CMS-Core/blob/develop/LICENSE.md
 * @link       https://github.com/GrahamCampbell/CMS-Core
 */
class File extends AbstractModel implements TitleModelInterface, FileModelInterface, BelongsToUserInterface, BelongsToFolderInterface
{
    use TitleModelTrait, FileModelTrait, BelongsToUserTrait, BelongsToFolderTrait;

    /**
     * The table the files are stored in.
     *
     * @var string
     */
    protected $table = 'files';

    /**
     * The model name.
     *
     * @var string
     */
    public static $name = 'file';

    /**
     * The columns to select when displaying an index.
     *
     * @var array
     */
    public static $index = array('id', 'title', 'format', 'created_at');

    /**
     * The max files per page when displaying a paginated index.
     *
     * @var int
     */
    public static $paginate = 20;

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
     * The file validation rules.
     *
     * @var array
     */
    public static $rules = array(
        'title'     => 'required',
        'format'    => 'required',
        'summary'   => 'required',
        'user_id'   => 'required',
        'folder_id' => 'required'
    );

    /**
     * The file factory.
     *
     * @var array
     */
    public static $factory = array(
        'id'        => 1,
        'title'     => 'File',
        'format'    => 'docx',
        'summary'   => 'This is an example word document.',
        'user_id'   => 1,
        'folder_id' => 1
    );

    /**
     * Before deleting an existing model.
     *
     * @return mixed
     */
    public function beforeDelete()
    {
        LaravelFile::delete($this->getPath());
    }
}
