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
 * This is the has many pages trait.
 *
 * @package    CMS-Core
 * @author     Graham Campbell
 * @copyright  Copyright (C) 2013  Graham Campbell
 * @license    https://github.com/GrahamCampbell/CMS-Core/blob/develop/LICENSE.md
 * @link       https://github.com/GrahamCampbell/CMS-Core
 */
trait TraitHasManyPages
{
    /**
     * Get the page relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOneOrMany
     */
    public function pages()
    {
        return $this->hasMany('GrahamCampbell\CMSCore\Models\Page');
    }

    /**
     * Get the page collection.
     *
     * @param  array  $columns
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getPages($columns = null)
    {
        $model = 'GrahamCampbell\CMSCore\Models\Page';

        if (is_null($columns)) {
            $columns = $model::$index;
        }

        if (property_exists($model, 'order')) {
            return $this->pages()->orderBy($model::$order, $model::$sort)->get($columns);
        }

        return $this->pages()->get($columns);
    }

    /**
     * Get the specified page.
     *
     * @param  string  $slug
     * @param  array   $columns
     * @return \GrahamCampbell\CMSCore\Models\Page
     */
    public function findPage($slug, $columns = array('*'))
    {
        return $this->pages()->where('slug', '=', $slug)->first($columns);
    }

    /**
     * Delete all pages.
     *
     * @return void
     */
    public function deletePages()
    {
        foreach ($this->getPages(array('id')) as $page) {
            $page->delete();
        }
    }
}
