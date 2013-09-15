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

trait TraitBaseProvider {

    /**
     * Create a new model.
     *
     * @param  array  $input
     * @return mixed
     */
    public function create(array $input) {
        $model = $this->model;
        return $model::create($input);
    }

    /**
     * Find an existing model.
     *
     * @param  int    $id
     * @param  array  $input
     * @return mixed
     */
    public function find($id, array $columns = array('*')) {
        $model = $this->model;
        return $model::find($id, $columns);
    }

    /**
     * Get a list of the models.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index() {
        $model = $this->model;

        if (property_exists($model, 'order')) {
            return $model::orderBy($model::$order, $model::$sort)->get($model::$index);
        }

        return $model::get($model::$index);
    }
}
