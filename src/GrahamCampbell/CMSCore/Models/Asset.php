<?php namespace GrahamCampbell\CMSCore\Models;

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

use File;
use Event;

class Asset {

    protected $attributes;

    /**
     * Create a new Asset model instance.
     *
     * @param  array  $attributes
     * @return void
     */
    public function __construct(array $attributes = array()) {
        $this->attributes = $attributes;
    }

    public function getPath() {
        return $this->attributes['path'];
    }

    public function getName() {
        return $this->attributes['name'];
    }

    public function getType() {
        return $this->attributes['type'];
    }

    public function getBody() {
        return $this->attributes['body'];
    }

    public function setBody($body) {
        return $this->attributes['body'] = $body;
        File::put($this->attributes['path'], $body);
        Event::fire('asset.update');
    }
}
