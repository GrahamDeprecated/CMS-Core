<?php namespace GrahamCampbell\CMSCore\Models\Relations\Common;

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

trait TraitHasManyPages {

    /**
     * Get the page relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOneOrMany
     */
    public function pages() {
        return $this->hasMany('GrahamCampbell\CMSCore\Models\Page');
    }

    /**
     * Get the page collection.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getPages() {
        $model = 'GrahamCampbell\CMSCore\Models\Page';

        if (property_exists($model, 'order')) {
            return $this->pages()->orderBy($model::$order, $model::$sort)->get($model::$index);
        }

        return $this->pages()->get($model::$index);
    }

    /**
     * Get the specified page.
     *
     * @return \GrahamCampbell\CMSCore\Models\Page
     */
    public function findPage($slug, $columns = array('*')) {
        return $this->pages()->where('slug', '=', $slug)->first($columns);
    }

    /**
     * Delete all pages.
     *
     * @return void
     */
    public function deletePages() {
        foreach($this->getPages(array('id')) as $page) {
            $page->delete();
        }
    }
}
