<?php namespace GrahamCampbell\CMSCore\Providers;

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

class AssetProvider {

    /**
     * The application instance.
     *
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    /**
     * Create a new instance.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    public function __construct($app) {
        $this->app = $app;
    }

    /**
     * Find an existing asset.
     *
     * @param  string  $asset
     * @return mixed
     */
    public function find($asset) {
        $name = basename($asset);
        $type = pathinfo($asset, PATHINFO_EXTENSION);

        if ($type !== 'css' || $type !== 'js') {
            throw new InvalidArgumentException($type.' is not a valid file extension', 1);
        }

        $path = public_path().'/'.$type.'/'.$asset;
        $body = File::get($path);

        return new Asset(array('path' => $path, 'name' => $name, 'type' => $type, 'body' => $body));
    }

    /**
     * List all assets.
     *
     * @return mixed
     */
    public function index($type = 'all') {
        $index = array();

        if ($type == 'css' || $type == 'all') {
            $files = File::files(public_path().'/css');
            array_merge($index, $files);
        }

        if ($type == 'js' || $type == 'all') {
            $files = File::files(public_path().'/js');
            array_merge($index, $files);
        }
        
        return $index;
    }
}
