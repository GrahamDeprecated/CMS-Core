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

trait TraitHasManyFiles {

    /**
     * Get the file relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOneOrMany
     */
    public function files() {
        return $this->hasMany('GrahamCampbell\CMSCore\Models\File');
    }

    /**
     * Get the file collection.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getFiles($columns = null) {
        $model = 'GrahamCampbell\CMSCore\Models\File';

        if (is_null($columns)) {
            $columns = $model::$index;
        }

        if (property_exists($model, 'order')) {
            return $this->files()->orderBy($model::$order, $model::$sort)->get($columns);
        }        
        return $this->files()->get($columns);
    }

    /**
     * Get the specified file.
     *
     * @return \GrahamCampbell\CMSCore\Models\File
     */
    public function findFile($id, $columns = array('*')) {
        return $this->files()->find($id, $columns);
    }

    /**
     * Delete all files.
     *
     * @return void
     */
    public function deleteFiles() {
        foreach($this->getFiles(array('id')) as $file) {
            $file->delete();
        }
    }
}
