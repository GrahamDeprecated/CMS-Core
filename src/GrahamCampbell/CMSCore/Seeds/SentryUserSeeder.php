<?php namespace GrahamCampbell\CMSCore\Seeds;

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

use DateTime;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Cartalyst\Sentry\Facades\Laravel\Sentry;

class SentryUserSeeder extends Seeder {

    /**
     * Run the database seeding.
     *
     * @return void
     */
    public function run() {
        DB::table('users')->delete();

        $user = array(
            'first_name'   => 'CMS',
            'last_name'    => 'Admin',
            'email'        => 'admin@dsmg.co.uk',
            'password'     => 'password',
            'activated'    => 1,
            'activated_at' => new DateTime
        );
        Sentry::getUserProvider()->create($user);

        $user = array(
            'first_name'   => 'CMS',
            'last_name'    => 'Semi-Admin',
            'email'        => 'semiadmin@dsmg.co.uk',
            'password'     => 'password',
            'activated'    => 1,
            'activated_at' => new DateTime
        );
        Sentry::getUserProvider()->create($user);

        $user = array(
            'first_name'   => 'CMS',
            'last_name'    => 'Moderator',
            'email'        => 'moderator@dsmg.co.uk',
            'password'     => 'password',
            'activated'    => 1,
            'activated_at' => new DateTime
        );
        Sentry::getUserProvider()->create($user);

        $user = array(
            'first_name'   => 'CMS',
            'last_name'    => 'Blogger',
            'email'        => 'blogger@dsmg.co.uk',
            'password'     => 'password',
            'activated'    => 1,
            'activated_at' => new DateTime
        );
        Sentry::getUserProvider()->create($user);

        $user = array(
            'first_name'   => 'CMS',
            'last_name'    => 'Editor',
            'email'        => 'editor@dsmg.co.uk',
            'password'     => 'password',
            'activated'    => 1,
            'activated_at' => new DateTime
        );
        Sentry::getUserProvider()->create($user);

        $user = array(
            'first_name'   => 'CMS',
            'last_name'    => 'User',
            'email'        => 'user@dsmg.co.uk',
            'password'     => 'password',
            'activated'    => 1,
            'activated_at' => new DateTime
        );
        Sentry::getUserProvider()->create($user);
    }
}
