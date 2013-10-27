<?php namespace GrahamCampbell\CMSCore\Models\Interfaces;

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

interface IBaseModel {

    /**
     * Get id.
     *
     * @return int
     */
    public function getId();

    /**
     * Get created_at.
     *
     * @return \Carbon\Carbon
     */
    public function getCreatedAt();

    /**
     * Get updated_at.
     *
     * @return \Carbon\Carbon
     */
    public function getUpdatedAt();

    /**
     * Create a new model.
     *
     * @param  array  $input
     * @return mixed
     */
    public static function create(array $input);

    /**
     * Before creating a new model.
     *
     * @param  array  $input
     * @return mixed
     */
    public static function beforeCreate(array $input);

    /**
     * After creating a new model.
     *
     * @param  array  $input
     * @param  mixed  $return
     * @return mixed
     */
    public static function afterCreate(array $input, $return);

    /**
     * Update an existing model.
     *
     * @param  array  $input
     * @return mixed
     */
    public function update(array $input = array());

    /**
     * Before updating an existing new model.
     *
     * @param  array  $input
     * @return mixed
     */
    public function beforeUpdate(array $input);

    /**
     * After updating an existing model.
     *
     * @param  array  $input
     * @param  mixed  $return
     * @return mixed
     */
    public function afterUpdate(array $input, $return);

    /**
     * Delete an existing model.
     *
     * @return void
     */
    public function delete();

    /**
     * Before deleting an existing model.
     *
     * @param  array  $input
     * @return mixed
     */
    public function beforeDelete(array $input);

    /**
     * After deleting an existing model.
     *
     * @param  array  $input
     * @param  mixed  $return
     * @return mixed
     */
    public function afterDelete(array $input, $return);

}
