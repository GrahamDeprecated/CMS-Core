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

interface IHasManyPosts
{
    /**
     * Get the post relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOneOrMany
     */
    public function posts();

    /**
     * Get the post collection.
     *
     * @param  array  $columns
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getPosts($columns = null);

    /**
     * Get the specified post.
     *
     * @param  int    $id
     * @param  array  $columns
     * @return \GrahamCampbell\CMSCore\Models\Post
     */
    public function findPost($id, $columns = array('*'));

    /**
     * Delete all posts.
     *
     * @return void
     */
    public function deletePosts();
}
