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

namespace GrahamCampbell\CMSCore\Models\Common;

/**
 * This is the page model trait.
 *
 * @package    CMS-Core
 * @author     Graham Campbell
 * @copyright  Copyright (C) 2013-2014  Graham Campbell
 * @license    https://github.com/GrahamCampbell/CMS-Core/blob/master/LICENSE.md
 * @link       https://github.com/GrahamCampbell/CMS-Core
 */
trait PageModelTrait
{
    /**
     * Get css.
     *
     * @return string
     */
    public function getCSS()
    {
        return $this->css;
    }

    /**
     * Get js.
     *
     * @return string
     */
    public function getJS()
    {
        return $this->js;
    }

    /**
     * Get show_title.
     *
     * @return int
     */
    public function getShowTitle()
    {
        return $this->show_title;
    }
}
