<?php

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
 */

namespace GrahamCampbell\CMSCore\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Cartalyst\Sentry\Facades\Laravel\Sentry;

/**
 * This is the users/groups table seeder class.
 *
 * @package    CMS-Core
 * @author     Graham Campbell
 * @copyright  Copyright (C) 2013  Graham Campbell
 * @license    https://github.com/GrahamCampbell/CMS-Core/blob/develop/LICENSE.md
 * @link       https://github.com/GrahamCampbell/CMS-Core
 */
class UsersGroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeding.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users_groups')->delete();

        $this->matchUser('admin@dsmg.co.uk', 'Admins');
        $this->matchUser('semiadmin@dsmg.co.uk', 'Moderators');
        $this->matchUser('semiadmin@dsmg.co.uk', 'Bloggers');
        $this->matchUser('semiadmin@dsmg.co.uk', 'Editors');
        $this->matchUser('moderator@dsmg.co.uk', 'Moderators');
        $this->matchUser('blogger@dsmg.co.uk', 'Bloggers');
        $this->matchUser('editor@dsmg.co.uk', 'Editors');
        $this->matchUser('user@dsmg.co.uk', 'Users');
    }

    /**
     * Add the user by email to a group.
     *
     * @param  string  $email
     * @param  string  $group
     * @return void
     */
    protected function matchUser($email, $group)
    {
        return Sentry::getUserProvider()->findByLogin($email)->addGroup(Sentry::getGroupProvider()->findByName($group));
    }
}
