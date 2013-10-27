<?php namespace GrahamCampbell\CMSCore\Models\Common;

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

use Event as LaravelEvent;
use Carbon\Carbon;

trait TraitBaseModel {

    /**
     * Get id.
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Get created_at.
     *
     * @return \Carbon\Carbon
     */
    public function getCreatedAt() {
        return new Carbon($this->created_at);
    }

    /**
     * Get updated_at.
     *
     * @return \Carbon\Carbon
     */
    public function getUpdatedAt() {
        return new Carbon($this->updated_at);
    }

    /**
     * Create a new model.
     *
     * @param  array  $input
     * @return mixed
     */
    public static function create(array $input = array()) {
        LaravelEvent::fire(static::$name.'.precreate');
        LaravelEvent::fire(static::$name.'.creating');
        $return = parent::create($input);
        LaravelEvent::fire(static::$name.'.created');
        LaravelEvent::fire(static::$name.'.postcreate');
        return $return;
    }

    /**
     * Update an existing model.
     *
     * @param  array  $input
     * @return mixed
     */
    public function update(array $input = array()) {
        LaravelEvent::fire(static::$name.'.preupdate');
        LaravelEvent::fire(static::$name.'.updating');
        $return = parent::update($input);
        LaravelEvent::fire(static::$name.'.updated');
        LaravelEvent::fire(static::$name.'.postupdate');
        return $return;
    }

    /**
     * Delete an existing model.
     *
     * @return void
     */
    public function delete() {
        LaravelEvent::fire(static::$name.'.predelete');
        LaravelEvent::fire(static::$name.'.deleting');
        $return = parent::delete();
        LaravelEvent::fire(static::$name.'.deleted');
        LaravelEvent::fire(static::$name.'.postdelete');
        return $return;
    }
}
