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

interface IHasManyReplies {

    /**
     * Get the reply relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOneOrMany
     */
    public function replies();

    /**
     * Get the reply collection.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getReplies($columns = null);

    /**
     * Get the specified reply.
     *
     * @return \GrahamCampbell\CMSCore\Models\Reply
     */
    public function findReply($id, $columns = array('*'));

    /**
     * Delete all replies.
     *
     * @return void
     */
    public function deleteReplies();

}
