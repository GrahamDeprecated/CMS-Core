<?php namespace GrahamCampbell\CMSCore\Models\Relations\Interfaces;

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

interface IBelongsToManyEvents {

    /**
     * Get the event relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function invites();

    /**
     * Get the event collection.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getInvites();

    /**
     * Get the specified event.
     *
     * @return \GrahamCampbell\CMSCore\Models\Event
     */
    public function findInvite($id, $columns = array('*'));

    /**
     * Link an event.
     *
     * @return void
     */
    public function addInvite($id);

    /**
     * Unlink an event.
     *
     * @return void
     */
    public function deleteInvite($id);
    /**
     * Link some events.
     *
     * @return void
     */
    public function setInvites($ids);

    /**
     * Unlink all events.
     *
     * @return void
     */
    public function deleteInvites();

}
