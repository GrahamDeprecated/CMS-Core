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

use Carbon;

trait TraitBaseModel {

    // TODO

    /**
     * PHP call function.
     *
     * @return void
     */
    // public function __call($method, $arguments) {
    //     foreach ($this->relations as $relation) {
    //         if (method_exists($relation, $method)) {
    //             return call_user_func_array(array($relation, $method), $arguments);
    //         }
    //     }

    //     // eloquent method calling
    //     parent::__call;
    // }

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
     * Register some model relations.
     *
     * @return void
     */
    public function registerRelations($relations) {
        // TODO
    }

    protected function belongsToModel($model) {
        return $this->belongsTo($model);
    }

    protected function getBelongsToModel($model, $columns = array('*')) {
        return $this->belongsTo($model)->first($columns);
    }

    protected function getBelongsToModelId(model, $columns = array('*')) {
        return $this->{$model::$name.'_id'};
    }

    /**
     * Get a "has many" model relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOneOrMany
     */
    protected function hasManyModels($model) {
        return $this->hasMany($model);
    }

    /**
     * Get a "has many" model collection.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    protected function getHasManyModels($model) {
        if (property_exists($model, 'order')) {
            return $this->hasMany($model)->orderBy($model::$order, $model::$sort)->get($model::$index);
        }

        return $this->hasMany($model)->get($model::$index);
    }

    /**
     * Get the specified "has many" model.
     *
     * @return mixed
     */
    protected function findHasManyModel($model, $id, $columns = array('*')) {
        return $this->hasMany($model)->find($id, $columns);
    }

    /**
     * Delete all "has many" models.
     *
     * @return void
     */
    protected function deleteHasManyModels($model) {
        $items = $this->hasMany($model)->get(array('id'));

        foreach($items as $item) {
            $item->delete();
        }
    }
}
