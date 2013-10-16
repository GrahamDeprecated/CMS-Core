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

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use VTalbot\Markdown\Facades\Markdown;
use Illuminate\Support\Facades\File;
use DateTime;

class PagesTableSeeder extends Seeder {

    /**
     * Run the database seeding.
     *
     * @return void
     */
    public function run() {
        DB::table('pages')->delete();

        $home = array(
            'title' => 'Home',
            'slug'  => 'home',
            'body'  => Markdown::string(File::get(dirname(__FILE__).'/page-home.md')),
            'show_title' => false,
            'icon'       => 'icon-home',
            'user_id'    => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime,
        );

        DB::table('pages')->insert($home);

        $about = array(
            'title' => 'About',
            'slug'  => 'about',
            'body'  => '<div class="row-fluid"><div class="span8">'.Markdown::string(File::get(dirname(__FILE__).'/page-about.md')).'</div></div>',
            'user_id'    => 1,
            'icon'       => 'icon-info-sign',
            'created_at' => new DateTime,
            'updated_at' => new DateTime,
        );

        DB::table('pages')->insert($about);
    }
}
