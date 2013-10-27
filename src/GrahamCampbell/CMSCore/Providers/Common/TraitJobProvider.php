<?php namespace GrahamCampbell\CMSCore\Providers\Common;

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

trait TraitJobProvider {

    /**
     * Get all jobs of specified type.
     *
     * @param  string  $task
     * @param  array   $columns
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getType($task, array $columns = array('*')) {
        $model = $this->model;
        return $model::where('task', '=', $task)->get($columns);
    }

    /**
     * Clear all jobs of specified type.
     *
     * @param  string  $task
     * @return void
     */
    public function clearType($task) {
        $model = $this->model;
        foreach($this->getType($task, array('id')) as $job) {
            $job->delete();
        }
    }

    /**
     * Get all old jobs of specified type.
     *
     * @param  string  $task
     * @param  int     $age
     * @param  array   $columns
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getOldType($task, $age = 68400, array $columns = array('*')) {
        $model = $this->model;
        return $model::where(function($query) { $query->where('task', '=', $task)->where('timestamp', '<=', time() - ($age)); })->get($columns);
    }

    /**
     * Clear all jobs of specified type.
     *
     * @param  string  $task
     * @param  int     $age
     * @return void
     */
    public function clearOldType($task, $age = 68400) {
        foreach($this->getOldType($task, $age, array('id')) as $job) {
            $job->delete();
        }
    }

    /**
     * Get all cron jobs.
     *
     * @param  array  $columns
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getCrons(array $columns = array('*')) {
        return $this->getType('GrahamCampbell\BootstrapCMS\Handlers\CronHandler', $columns);
    }

    /**
     * Clear all cron jobs.
     *
     * @return void
     */
    public function clearCrons() {
        return $this->clearType('GrahamCampbell\BootstrapCMS\Handlers\CronHandler');
    }

    /**
     * Get all old cron jobs.
     *
     * @param  int    $age
     * @param  array  $columns
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getOldCrons($age = 68400, array $columns = array('*')) {
        return $this->getOldType('GrahamCampbell\BootstrapCMS\Handlers\CronHandler', $age, $columns);
    }

    /**
     * Clear all old cron jobs.
     *
     * @param  int  $age
     * @return void
     */
    public function clearOldCrons($age = 68400) {
        return $this->clearOldType('GrahamCampbell\BootstrapCMS\Handlers\CronHandler', $age);
    }

    /**
     * Get all mail jobs.
     *
     * @param  array  $columns
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getMail(array $columns = array('*')) {
        return $this->getType('GrahamCampbell\BootstrapCMS\Handlers\MailHandler', $columns);
    }

    /**
     * Clear all mail jobs.
     *
     * @return void
     */
    public function clearMail() {
        return $this->clearType('GrahamCampbell\BootstrapCMS\Handlers\MailHandler');
    }

    /**
     * Get all old mail jobs.
     *
     * @param  int    $age
     * @param  array  $columns
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getOldMail($age = 68400, array $columns = array('*')) {
        return $this->getOldType('GrahamCampbell\BootstrapCMS\Handlers\MailHandler', $age, $columns);
    }

    /**
     * Clear all old mail jobs.
     *
     * @param  int  $age
     * @return void
     */
    public function clearOldMail($age = 68400) {
        return $this->clearOldType('GrahamCampbell\BootstrapCMS\Handlers\MailHandler', $age);
    }

    /**
     * Get all jobs except crons, including mail jobs.
     *
     * @param  array  $columns
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getJobs(array $columns = array('*')) {
        $model = $this->model;
        return $model::where('task', '<>', 'GrahamCampbell\BootstrapCMS\Handlers\CronHandler')->get($columns);
    }

    /**
     * Clear all jobs except crons, including mail jobs.
     *
     * @return void
     */
    public function clearJobs() {
        foreach($this->getJobs(array('id')) as $job) {
            $job->delete();
        }
    }

    /**
     * Get all old jobs except crons, including mail jobs.
     *
     * @param  int    $age
     * @param  array  $columns
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getOldJobs($age = 68400, array $columns = array('*')) {
        $model = $this->model;
        return $model::where(function($query) { $query->where('task', '<>', 'GrahamCampbell\BootstrapCMS\Handlers\CronHandler')->where('timestamp', '<=', time() - ($age)); })->get($columns);
    }

    /**
     * Clear all old jobs except crons, including mail jobs.
     *
     * @param  int  $age
     * @return void
     */
    public function clearOldJobs($age = 68400) {
        foreach($this->getOldJobs($age, array('id')) as $job) {
            $job->delete();
        }
    }

    /**
     * Get all jobs.
     *
     * @param  array  $columns
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll(array $columns = array('*')) {
        $model = $this->model;
        return $model::get($columns);
    }

    /**
     * Clear all jobs.
     *
     * @return void
     */
    public function clearAll() {
        foreach($this->getAll(array('id'))) as $job) {
            $job->delete();
        }
    }

    /**
     * Get all old jobs.
     *
     * @param  int    $age
     * @param  array  $columns
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllOld($age = 68400, array $columns = array('*')) {
        $model = $this->model;
        return $model::where('timestamp', '<=', time() - ($age))->get($columns);
    }

    /**
     * Clear all old jobs.
     *
     * @param  int  $age
     * @return void
     */
    public function clearAllOld() {
        foreach($this->getAllOld(array('id'))) as $job) {
            $job->delete();
        }
    }
}
