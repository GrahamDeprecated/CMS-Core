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

use Queuing;
use GrahamCampbell\CMSCore\Facades\JobProvider;

class Cron {

    /**
     * Start the cron jobs after a delay.
     *
     * @param  \Carbon\Carbon|int  $delay
     * @return \GrahamCampbell\CMSCore\Models\Job
     */
    public function start($delay = 1000) {
        $this->stop();
        return Queuing::laterCron($delay);
    }

    /**
     * Stop the cron jobs.
     *
     * @return null
     */
    public function stop() {
        return JobProvider::clearCrons();
    }
}
