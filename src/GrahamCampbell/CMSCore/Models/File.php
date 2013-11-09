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

use File as LaravelFile;

class File extends BaseModel implements Interfaces\ITitleModel, Relations\Interfaces\IBelongsToUser, Relations\Interfaces\IBelongsToFolder {

    use Common\TraitTitleModel, Relations\Common\TraitBelongsToUser, Relations\Common\TraitBelongsToFolder;

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
     * Get the file format.
     *
     * @return string
     */
    public function getFormat() {
        return $this->format;
    }

    /**
     * Get the file name.
     *
     * @return string
     */
    public function getName() {
        return $this->id.'.'.$this->format;
    }

    /**
     * Get the file path.
     *
     * @return string
     */
    public function getPath() {
        return storage_path().'/files/'.$this->getName();
    }

    /**
     * Before deleting an existing model.
     *
     * @return mixed
     */
    public function beforeDelete() {
        LaravelFile::delete($this->getPath());
    }
}
