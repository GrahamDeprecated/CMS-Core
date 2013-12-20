<?php namespace GrahamCampbell\Tests\CMSCore\Models;

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

use GrahamCampbell\Tests\CMSCore\Models\Relations\Interfaces\BelongsToUserTestCaseInterface;
use GrahamCampbell\Tests\CMSCore\Models\Relations\Common\BelongsToUserTestCaseTrait;

/**
 * This is the post test case class.
 *
 * @package    CMS-Core
 * @author     Graham Campbell
 * @copyright  Copyright (C) 2013  Graham Campbell
 * @license    https://github.com/GrahamCampbell/CMS-Core/blob/develop/LICENSE.md
 * @link       https://github.com/GrahamCampbell/CMS-Core
 */
class PostTest extends AbstractModelTestCase implements BelongsToUserTestCaseInterface
{
    use BelongsToUserTestCaseTrait;

    protected $model = 'GrahamCampbell\CMSCore\Models\Post';

    protected function extraModelTests()
    {
        $this->assertInstanceOf('GrahamCampbell\Core\Models\AbstractModel', $this->object);
    }

    public function testGetTitle()
    {
        $this->assertEquals($this->instance->getTitle(), $this->instance->title);
    }

    public function testGetSummary()
    {
        $this->assertEquals($this->instance->getSummary(), $this->instance->summary);
    }

    public function testGetBody()
    {
        $this->assertEquals($this->instance->getBody(), $this->instance->body);
    }

    // TODO: test comment relationships
}
