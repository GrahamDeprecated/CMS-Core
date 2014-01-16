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
use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * This is the database seeder class.
 *
 * @package    CMS-Core
 * @author     Graham Campbell
 * @copyright  Copyright (C) 2013-2014  Graham Campbell
 * @license    https://github.com/GrahamCampbell/CMS-Core/blob/master/LICENSE.md
 * @link       https://github.com/GrahamCampbell/CMS-Core
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeding.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

        $this->call('GrahamCampbell\CMSCore\Seeds\GroupsTableSeeder');
        $this->call('GrahamCampbell\CMSCore\Seeds\UsersTableSeeder');
        $this->call('GrahamCampbell\CMSCore\Seeds\UsersGroupsTableSeeder');

        $this->call('GrahamCampbell\CMSCore\Seeds\PagesTableSeeder');
        $this->call('GrahamCampbell\CMSCore\Seeds\PostsTableSeeder');
        $this->call('GrahamCampbell\CMSCore\Seeds\CommentsTableSeeder');
        $this->call('GrahamCampbell\CMSCore\Seeds\EventsTableSeeder');
    }
}
