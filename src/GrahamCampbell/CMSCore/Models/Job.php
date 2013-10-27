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

class Job extends BaseModel {

    /**
     * The table the jobs are stored in.
     *
     * @var string
     */
    protected $table = 'jobs';

    /**
     * The model name.
     *
     * @var string
     */
    public static $name = 'job';

    /**
     * The columns to select when displaying an index.
     *
     * @var array
     */
    public static $index = array('id', 'tries', 'task');

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
    public static $rules = array('task');

    /**
     * The page factory.
     *
     * @var array
     */
    public static $factory = array(
        'id'    => 1,
        'tries' => 0,
        'task'  => 'GrahamCampbell\BootstrapCMS\Handlers\MailHandler'
    );

    /**
     * Get tries.
     *
     * @return int
     */
    public function getTries() {
        return $this->tries;
    }

    /**
     * Get task.
     *
     * @return string
     */
    public function getTask() {
        return $this->task;
    }
}
