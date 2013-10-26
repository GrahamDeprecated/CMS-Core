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

use Event as LaravelEvent;

class Job extends BaseModel implements Interfaces\IJobModel {

    use Common\TraitJobModel;

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
    public static $index = array('id', 'tries');

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
    public static $rules = array();

    /**
     * The page factory.
     *
     * @var array
     */
    public static $factory = array(
        'id'    => 1,
        'tries' => 0
    );

    /**
     * Create a new job.
     *
     * @param  array  $input
     * @return \GrahamCampbell\CMSCore\Models\Job
     */
    public static function create(array $input) {
        $return = parent::create($input);
        LaravelEvent::fire('job.created');
        return $return;
    }

    /**
     * Update an existing job.
     *
     * @param  array  $input
     * @return \GrahamCampbell\CMSCore\Models\Job
     */
    public function update(array $input = array()) {
        $return = parent::update($input);
        LaravelEvent::fire('job.updated');
        return $return;
    }

    /**
     * Delete an existing job.
     *
     * @param  array  $input
     * @return void
     */
    public function delete() {
        $return = parent::delete();
        LaravelEvent::fire('job.deleted');
        return $return;
    }
}
