<?php namespace GrahamCampbell\CMSCore\Classes;

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

use Queue;
use Carbon\Carbon;
use GrahamCampbell\CMSCore\Facades\JobProvider;

class Queuing {

     /**
     * The minimum delay for a queue push.
     *
     * @var array
     */
    protected $delay = 5;

    /**
     * Push a new job onto the queue.
     *
     * @param  string  $job
     * @param  mixed   $data
     * @param  string  $queue
     * @return \GrahamCampbell\CMSCore\Models\Job
     */
    public function push($job, $data = '', $queue = null) {
        return $this->roll(null, $job, $data, $queue);
    }

    /**
     * Push a new delayed job onto the queue.
     *
     * @param  \Carbon\Carbon|int  $delay
     * @param  string  $job
     * @param  mixed   $data
     * @param  string  $queue
     * @return \GrahamCampbell\CMSCore\Models\Job
     */
    public function later($delay, $job, $data = '', $queue = null) {
        return $this->roll($delay, $job, $data, $queue);
    }

    /**
     * Do the queue rolling work.
     *
     * @param  \Carbon\Carbon|int  $delay
     * @param  string  $job
     * @param  mixed   $data
     * @param  string  $queue
     * @return \GrahamCampbell\CMSCore\Models\Job
     */
    protected function roll($delay, $job, $data, $queue) {
        // get the corrected time
        $time = $this->time($delay);

        // push the job and get the id
        $id = Queue::later($time, $job, $data, $queue);

        // if the job has an id, mark it as queued in the database
        if (!empty($id)) {
            return JobProvider::create(array('job_id' => $id));
        }
    }

    /**
     * Convert to a valid time.
     *
     * @return int
     */
    protected function time($time = null) {
        if (get_class($time) == 'Carbon\Carbon') {
            return $this->times(Carbon::now()->diffInSeconds($time));
        }

        if (is_int($time)) {
            return $this->times($time);
        }

        return $this->times();
    }

    /**
     * Convert to a valid time strictly.
     *
     * @return int
     */
    protected function times($time = null) {
        if (is_int($time)) {
            if ($time >= $this->delay) {
                return $time;
            }
        }

        return $this->delay;
    }
}
