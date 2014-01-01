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

namespace GrahamCampbell\CMSCore\Models\Relations\Interfaces;

/**
 * This is the belongs to many users interface.
 *
 * @package    CMS-Core
 * @author     Graham Campbell
 * @copyright  Copyright (C) 2013-2014  Graham Campbell
 * @license    https://github.com/GrahamCampbell/CMS-Core/blob/develop/LICENSE.md
 * @link       https://github.com/GrahamCampbell/CMS-Core
 */
interface BelongsToManyUsersInterface
{
    /**
     * Get the event relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function invites();

    /**
     * Get the event collection.
     *
     * @param  array  $columns
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getInvites($columns = null);

    /**
     * Get the specified user.
     *
     * @param  int    $id
     * @param  array  $columns
     * @return \GrahamCampbell\CMSCore\Models\User
     */
    public function findInvite($id, $columns = array('*'));

    /**
     * Link an user.
     *
     * @param  int  $id
     * @return void
     */
    public function addInvite($id);

    /**
     * Unlink an user.
     *
     * @param  int  $id
     * @return void
     */
    public function deleteInvite($id);

    /**
     * Link some users.
     *
     * @param  array  $ids
     * @return void
     */
    public function setInvites($ids);

    /**
     * Unlink all users.
     *
     * @return void
     */
    public function deleteInvites();
}
