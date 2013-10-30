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

use Carbon\Carbon;

class Queuing extends BaseClass {

    /**
     * The minimum delay for a delayed queue push.
     *
     * @var array
     */
    protected $delay = 5;

    /**
     * Get the queue to use.
     *
     * @param  string  $type
     * @return string
     */
    protected function getQueue($type) {
        if ($this->app['config']['queue.default'] == 'sync') {
            return $type;
        } else {
            return $this->app['config']['queue.connections.'.$this->app['config']['queue.default'].'.'.$type];
        }
    }

    /**
     * Get the task to use.
     *
     * @param  string  $type
     * @return string
     */
    protected function getTask($type) {
        return 'GrahamCampbell\BootstrapCMS\Handlers\\'.ucfirst($type).'Handler';
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

    /**
     * Do the actual job queuing.
     *
     * @param  mixed   $delay
     * @param  string  $task
     * @param  mixed   $data
     * @param  string  $queue
     * @return \GrahamCampbell\CMSCore\Models\Job
     */
    protected function queue($delay, $task, $data, $queue) {
        // check the job
        if ($this->app['config']['queue.default'] == 'sync') {
            if ($this->getTask('cron') = $task) {
                throw new \InvalidArgumentException('A cron job cannot run on the sync queue.');
            }
        }

        // push to the database server
        $model = $this->app['jobprovider']->create(array('task' => $task, 'queue' => $queue));

        // save model id
        $data['model_id'] = $model->getId();

        // push to the queuing server
        if ($delay === false) {
            $this->app['queue']->push($job, $data, $queue);
        } else {
            $time = $this->time($delay);
            $this->app['queue']->later($time, $job, $data, $queue);
        }

        // return the model
        return $model;
    }

    /**
     * Push a new delayed cron job onto the queue.
     *
     * @param  mixed  $delay
     * @param  array  $data
     * @return \GrahamCampbell\CMSCore\Models\Job
     */
    public function laterCron($delay, array $data = array()) {
        return $this->queue($delay, $this->getTask('cron'), $data, $this->getQueue('cron'));
    }

    /**
     * Push a new cron job onto the queue.
     *
     * @param  array  $data
     * @return \GrahamCampbell\CMSCore\Models\Job
     */
    public function pushCron(array $data = array()) {
        return $this->laterCron(false, $job, $data);
    }

    /**
     * Push a new delayed mail job onto the queue.
     *
     * @param  mixed  $delay
     * @param  array  $data
     * @return \GrahamCampbell\CMSCore\Models\Job
     */
    public function laterMail($delay, array $data = array()) {
        return $this->queue($delay, $this->getTask('mail'), $data, $this->getQueue('mail'));
    }

    /**
     * Push a new mail job onto the queue.
     *
     * @param  array  $data
     * @return \GrahamCampbell\CMSCore\Models\Job
     */
    public function pushMail(array $data = array()) {
        return $this->laterMail(false, $job, $data);
    }

    /**
     * Push a new delayed job onto the queue.
     *
     * @param  mixed   $delay
     * @param  string  $job
     * @param  array   $data
     * @return \GrahamCampbell\CMSCore\Models\Job
     */
    public function laterJob($delay, $job, array $data = array()) {
        return $this->queue($delay, $this->getTask($job), $data, $this->getQueue('queue'));
    }

    /**
     * Push a new job onto the queue.
     *
     * @param  string  $job
     * @param  array   $data
     * @return \GrahamCampbell\CMSCore\Models\Job
     */
    public function pushJob($job, array $data = array()) {
        return $this->laterJob(false, $job, $data);
    }

    /**
     * Clear the specified queue.
     *
     * @param  string  $type
     * @return void
     */
    protected function clear($type) {
        $this->app['jobprovider']->clearQueue($type);
        $queue = getQueue($type);

        if ($this->app['config']['queue.default'] == 'beanstalkd') {
            $pheanstalk = $this->app['queue']->getPheanstalk();
            try {
                while($job = $pheanstalk->peekReady($queue)) {
                    $pheanstalk->delete($job);
                }
            } catch (\Pheanstalk_Exception_ServerException $e) {}
            try {
                while($job = $pheanstalk->peekDelayed($queue)) {
                    $pheanstalk->delete($job);
                }
            } catch (\Pheanstalk_Exception_ServerException $e) {}
            try {
                while($job = $pheanstalk->peekBuried($queue)) {
                    $pheanstalk->delete($job);
                }
            } catch (\Pheanstalk_Exception_ServerException $e) {}
        } elseif ($this->app['config']['queue.default'] == 'iron') {
            $iron = $this->app['queue']->getIron();
            $iron->clearQueue();
        }

        $this->app['jobprovider']->clearAll();
    }

    /**
     * Clear all cron jobs.
     *
     * @return void
     */
    public function clearCron() {
        $this->clear('cron');
        $this->clear('cron');
    }

    /**
     * Clear all mail jobs.
     *
     * @return void
     */
    public function clearMail() {
        $this->clear('mail');
        $this->clear('mail');
    }

    /**
     * Clear all other jobs.
     *
     * @return void
     */
    public function clearJobs() {
        $this->clear('jobs');
        $this->clear('jobs');
    }

    /**
     * Clear all jobs.
     *
     * @return void
     */
    public function clearAll() {
        $this->clear('cron');
        $this->clear('mail');
        $this->clear('jobs');
        $this->clear('cron');
        $this->clear('mail');
        $this->clear('jobs');
        $this->app['jobprovider']->clearAll();
    }

    /**
     * Get the queue length.
     *
     * @param  string  $queue
     * @return int
     */
    public function length($queue) {
        return $this->app['jobprovider']->count();
    }
}
