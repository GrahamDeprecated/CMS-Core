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

trait TraitHasManyFolders
{
    /**
     * Get the folder relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOneOrMany
     */
    public function folders()
    {
        return $this->hasMany('GrahamCampbell\CMSCore\Models\Folder');
    }

    /**
     * Get the folder collection.
     *
     * @param  array  $columns
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getFolders($columns = null)
    {
        $model = 'GrahamCampbell\CMSCore\Models\Folder';

        if (is_null($columns)) {
            $columns = $model::$index;
        }

        if (property_exists($model, 'order')) {
            return $this->folders()->orderBy($model::$order, $model::$sort)->get($columns);
        }        

        return $this->folders()->get($columns);
    }

    /**
     * Get the specified folder.
     *
     * @param  int    $id
     * @param  array  $columns
     * @return \GrahamCampbell\CMSCore\Models\Folder
     */
    public function findFolder($id, $columns = array('*'))
    {
        return $this->folders()->find($id, $columns);
    }

    /**
     * Delete all folders.
     *
     * @return void
     */
    public function deleteFolders()
    {
        foreach ($this->getFolders(array('id')) as $folder) {
            $folder->delete();
        }
    }
}
