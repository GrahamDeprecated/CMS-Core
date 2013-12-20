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

use GrahamCampbell\Tests\CMSCore\Models\Relations\Interfaces\BelongsToUserTestCaseInterface;
use GrahamCampbell\Tests\CMSCore\Models\Relations\Common\BelongsToUserTestCaseTrait;

/**
 * This is the comment test case class.
 *
 * @package    CMS-Core
 * @author     Graham Campbell
 * @copyright  Copyright (C) 2013  Graham Campbell
 * @license    https://github.com/GrahamCampbell/CMS-Core/blob/develop/LICENSE.md
 * @link       https://github.com/GrahamCampbell/CMS-Core
 */
class CommentTest extends AbstractModelTestCase implements BelongsToUserTestCaseInterface
{
    use BelongsToUserTestCaseTrait;

    protected $model = 'GrahamCampbell\CMSCore\Models\Comment';

    protected function extraModelTests()
    {
        $this->assertInstanceOf('GrahamCampbell\Core\Models\AbstractModel', $this->object);
    }

    public function testGetBody()
    {
        $this->assertEquals($this->instance->getBody(), $this->instance->body);
    }

    public function testGetPostId()
    {
        $this->assertEquals($this->instance->getPostId(), $this->instance->post_id);
    }

    public function testRelationWithPost()
    {
        $this->assertEquals($this->instance->post->first(), $this->instance->getPost());
        $this->assertEquals($this->instance->post_id, $this->instance->getPost()->id);
    }

    public function testRelationWithPostId()
    {
        $this->assertEquals($this->instance->getPostId(), $this->instance->getPost()->id);
    }
}
