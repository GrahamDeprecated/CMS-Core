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

namespace GrahamCampbell\Tests\CMSCore\Models;

use Carbon\Carbon;
use GrahamCampbell\Tests\CMSCore\Models\Relations\Interfaces\BelongsToUserTestCaseInterface;
use GrahamCampbell\Tests\CMSCore\Models\Relations\Common\BelongsToUserTestCaseTrait;

/**
 * This is the event test case class.
 *
 * @package    CMS-Core
 * @author     Graham Campbell
 * @copyright  Copyright (C) 2013-2014  Graham Campbell
 * @license    https://github.com/GrahamCampbell/CMS-Core/blob/master/LICENSE.md
 * @link       https://github.com/GrahamCampbell/CMS-Core
 */
class EventTest extends AbstractModelTestCase implements BelongsToUserTestCaseInterface
{
    use BelongsToUserTestCaseTrait;

    protected $model = 'GrahamCampbell\CMSCore\Models\Event';

    protected function extraModelTests()
    {
        $this->assertInstanceOf('GrahamCampbell\Core\Models\AbstractModel', $this->object);
    }

    public function testGetTitle()
    {
        $this->assertEquals($this->instance->getTitle(), $this->instance->title);
    }

    public function testGetDate()
    {
        $this->assertEquals($this->instance->getDate(), $this->instance->date);
    }

    public function testGetFormattedDate()
    {
        $date = new Carbon($this->instance->date);
        $formatteddate = $date->format('l jS F Y \\- H:i:s');
        $this->assertEquals($this->instance->getFormattedDate(), $formatteddate);
    }

    public function testGetLocation()
    {
        $this->assertEquals($this->instance->getLocation(), $this->instance->location);
    }

    public function testGetBody()
    {
        $this->assertEquals($this->instance->getBody(), $this->instance->body);
    }
}
