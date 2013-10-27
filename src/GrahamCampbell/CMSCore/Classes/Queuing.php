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
     * The minimum delay for a delayed queue push.
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
    public function push($job, $data = array(), $queue = null) {
        return $this->roll(false, $job, $data, $queue);
    }

    /**
     * Push a new mail job onto the queue.
     *
     * @param  mixed   $data
     * @return \GrahamCampbell\CMSCore\Models\Job
     */
    public function pushMail($data = array(), $queue = null) {
        return $this->roll(false, 'GrahamCampbell\BootstrapCMS\Handlers\MailHandler', $data, $queue);
    }

    /**
     * Push a new cron job onto the queue.
     *
     * @param  mixed   $data
     * @param  string  $queue
     * @return \GrahamCampbell\CMSCore\Models\Job
     */
    public function pushCron($data = array(), $queue = null) {
        return $this->roll(false, 'GrahamCampbell\BootstrapCMS\Handlers\CronHandler', $data, $queue);
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
    public function later($delay, $job, $data = array(), $queue = null) {
        return $this->roll($delay, $job, $data, $queue);
    }

    /**
     * Push a new delayed mail job onto the queue.
     *
     * @param  \Carbon\Carbon|int  $delay
     * @param  mixed   $data
     * @return \GrahamCampbell\CMSCore\Models\Job
     */
    public function laterMail($delay, $data = array(), $queue = null) {
        return $this->roll($delay, 'GrahamCampbell\BootstrapCMS\Handlers\MailHandler', $data, $queue);
    }

    /**
     * Push a new delayed cron job onto the queue.
     *
     * @param  \Carbon\Carbon|int  $delay
     * @param  mixed   $data
     * @param  string  $queue
     * @return \GrahamCampbell\CMSCore\Models\Job
     */
    public function laterCron($delay, $data = array(), $queue = null) {
        return $this->roll($delay, 'GrahamCampbell\BootstrapCMS\Handlers\CronHandler', $data, $queue);
    }

    /**
     * Do the queue rolling work.
     *
     * @param  mixed  $delay
     * @param  string  $job
     * @param  mixed   $data
     * @param  string  $queue
     * @return \GrahamCampbell\CMSCore\Models\Job
     */
    protected function roll($delay, $job, $data, $queue) {
        // push to the database server
        $model = JobProvider::create(array('task' => $job));

        // save job id
        $data['model_id'] = $model->getId();

        // push to the queuing server
        if ($delay === false) {
            Queue::push($job, $data, $queue);
        } else {
            $time = $this->time($delay);
            Queue::later($time, $job, $data, $queue);
        }

        // return the job
        return $model;
    }

    /**
     * Convert to a valid time.
     *
     * @param  mixed  $time
     * @return int
     */
    protected function time($time = null) {
        if (is_object($time)) {
            if (get_class($time) == 'Carbon\Carbon') {
                return $this->times(Carbon::now()->diffInSeconds($time));
            }
        }

        if (is_int($time)) {
            return $this->times($time);
        }

        return $this->times();
    }

    /**
     * Convert to a valid time strictly.
     *
     * @param  mixed  $time
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
