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
        LaravelEvent::fire(static::$name.'.creating');
        $this->beforeCreate($input);
        $return = parent::create($input);
        $this->afterCreate($input, $return);
        LaravelEvent::fire(static::$name.'.created');
        return $return;
    }

    /**
     * Before creating a new model.
     *
     * @param  array  $input
     * @return mixed
     */
    protected function beforeCreate(array $input) {}

    /**
     * After creating a new model.
     *
     * @param  array  $input
     * @param  mixed  $return
     * @return mixed
     */
    protected function afterCreate(array $input, $return) {}

    /**
     * Update an existing model.
     *
     * @param  array  $input
     * @return mixed
     */
    public function update(array $input = array()) {
        LaravelEvent::fire(static::$name.'.updating');
        $this->beforeUpdate($input);
        $return = parent::update($input);
        $this->afterUpdate($input, $return);
        LaravelEvent::fire(static::$name.'.updated');
        return $return;
    }

    /**
     * Before updating an existing new model.
     *
     * @param  array  $input
     * @return mixed
     */
    protected function beforeUpdate(array $input) {}

    /**
     * After updating an existing model.
     *
     * @param  array  $input
     * @param  mixed  $return
     * @return mixed
     */
    protected function afterUpdate(array $input, $return) {}

    /**
     * Delete an existing model.
     *
     * @return void
     */
    public function delete() {
        LaravelEvent::fire(static::$name.'.deleting');
        $this->beforeDelete($input);
        $return = parent::delete();
        $this->afterDelete($input, $return);
        LaravelEvent::fire(static::$name.'.deleted');
        return $return;
    }

    /**
     * Before deleting an existing model.
     *
     * @param  array  $input
     * @return mixed
     */
    protected function beforeDelete(array $input) {}

    /**
     * After deleting an existing model.
     *
     * @param  array  $input
     * @param  mixed  $return
     * @return mixed
     */
    protected function afterDelete(array $input, $return) {}

}
