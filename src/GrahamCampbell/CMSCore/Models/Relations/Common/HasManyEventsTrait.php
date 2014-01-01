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

namespace GrahamCampbell\CMSCore\Models\Relations\Common;

/**
 * This is the has many events trait.
 *
 * @package    CMS-Core
 * @author     Graham Campbell
 * @copyright  Copyright (C) 2013-2014  Graham Campbell
 * @license    https://github.com/GrahamCampbell/CMS-Core/blob/develop/LICENSE.md
 * @link       https://github.com/GrahamCampbell/CMS-Core
 */
trait HasManyEventsTrait
{
    /**
     * Get the event relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOneOrMany
     */
    public function events()
    {
        return $this->hasMany('GrahamCampbell\CMSCore\Models\Event');
    }

    /**
     * Get the event collection.
     *
     * @param  array  $columns
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getEvents($columns = null)
    {
        $model = 'GrahamCampbell\CMSCore\Models\Event';

        if (is_null($columns)) {
            $columns = $model::$index;
        }

        if (property_exists($model, 'order')) {
            return $this->events()->orderBy($model::$order, $model::$sort)->get($columns);
        }

        return $this->events()->get($columns);
    }

    /**
     * Get the specified event.
     *
     * @param  int    $id
     * @param  array  $columns
     * @return \GrahamCampbell\CMSCore\Models\Event
     */
    public function findEvent($id, $columns = array('*'))
    {
        return $this->events()->find($id, $columns);
    }

    /**
     * Delete all events.
     *
     * @return void
     */
    public function deleteEvents()
    {
        foreach ($this->getEvents(array('id')) as $event) {
            $event->delete();
        }
    }
}
