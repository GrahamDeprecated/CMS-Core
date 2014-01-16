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

namespace GrahamCampbell\CMSCore\Models;

use GrahamCampbell\Credentials\Models\User as CredentialsUser;
use GrahamCampbell\CMSCore\Models\Relations\Interfaces\HasManyPagesInterface;
use GrahamCampbell\CMSCore\Models\Relations\Common\HasManyPagesTrait;
use GrahamCampbell\CMSCore\Models\Relations\Interfaces\HasManyPostsInterface;
use GrahamCampbell\CMSCore\Models\Relations\Common\HasManyPostsTrait;
use GrahamCampbell\CMSCore\Models\Relations\Interfaces\HasManyEventsInterface;
use GrahamCampbell\CMSCore\Models\Relations\Common\HasManyEventsTrait;
use GrahamCampbell\CMSCore\Models\Relations\Interfaces\HasManyFoldersInterface;
use GrahamCampbell\CMSCore\Models\Relations\Common\HasManyFoldersTrait;
use GrahamCampbell\CMSCore\Models\Relations\Interfaces\HasManyFilesInterface;
use GrahamCampbell\CMSCore\Models\Relations\Common\HasManyFilesTrait;
use GrahamCampbell\CMSCore\Models\Relations\Interfaces\HasManyCommentsInterface;
use GrahamCampbell\CMSCore\Models\Relations\Common\HasManyCommentsTrait;
use GrahamCampbell\CMSCore\Models\Relations\Interfaces\BelongsToManyEventsInterface;
use GrahamCampbell\CMSCore\Models\Relations\Common\BelongsToManyEventsTrait;

/**
 * This is the user model class.
 *
 * @package    CMS-Core
 * @author     Graham Campbell
 * @copyright  Copyright (C) 2013-2014  Graham Campbell
 * @license    https://github.com/GrahamCampbell/CMS-Core/blob/master/LICENSE.md
 * @link       https://github.com/GrahamCampbell/CMS-Core
 */
class User extends CredentialsUser implements HasManyPagesInterface, HasManyPostsInterface, HasManyEventsInterface, HasManyFoldersInterface, HasManyFilesInterface, HasManyCommentsInterface, BelongsToManyEventsInterface
{
    use HasManyPagesTrait, HasManyPostsTrait, HasManyEventsTrait, HasManyFoldersTrait, HasManyFilesTrait, HasManyCommentsTrait, BelongsToManyEventsTrait;

    /**
     * Before deleting an existing model.
     *
     * @return mixed
     */
    public function beforeDelete()
    {
        $this->deleteInvites();
        $this->deletePages();
        $this->deletePosts();
        $this->deleteEvents();
        $this->deleteFolders();
        $this->deleteFiles();
        $this->deleteComments();
    }
}
