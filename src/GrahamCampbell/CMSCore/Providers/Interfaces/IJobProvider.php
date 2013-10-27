<?php namespace GrahamCampbell\CMSCore\Providers\Interfaces;

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

interface IJobProvider {

    /**
     * Clear all jobs of specified type.
     *
     * @return null
     */
    public function clear($task);

    /**
     * Clear all cron jobs.
     *
     * @return null
     */
    public function clearCrons();

    /**
     * Clear all the mail jobs.
     *
     * @return null
     */
    public function clearMail();

    /**
     * Clear all jobs except crons, including mail jobs.
     *
     * @return null
     */
    public function clearJobs();

    /**
     * Clear all jobs.
     *
     * @return null
     */
    public function clearAll();

}
