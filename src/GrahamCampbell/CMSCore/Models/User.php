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

use Carbon\Carbon;
use Cartalyst\Sentry\Users\Eloquent\User as SentryUser;
use GrahamCampbell\Core\Models\Interfaces\IBaseModel;
use GrahamCampbell\Core\Models\Common\TraitBaseModel;
use GrahamCampbell\Core\Models\Interfaces\INameModel;
use GrahamCampbell\Core\Models\Common\TraitNameModel;
use GrahamCampbell\CMSCore\Models\Relations\Interfaces\IHasManyPages;
use GrahamCampbell\CMSCore\Models\Relations\Common\TraitHasManyPages;
use GrahamCampbell\CMSCore\Models\Relations\Interfaces\IHasManyPosts;
use GrahamCampbell\CMSCore\Models\Relations\Common\TraitHasManyPosts;
use GrahamCampbell\CMSCore\Models\Relations\Interfaces\IHasManyEvents;
use GrahamCampbell\CMSCore\Models\Relations\Common\TraitHasManyEvents;
use GrahamCampbell\CMSCore\Models\Relations\Interfaces\IHasManyFolders;
use GrahamCampbell\CMSCore\Models\Relations\Common\TraitHasManyFolders;
use GrahamCampbell\CMSCore\Models\Relations\Interfaces\IHasManyFiles;
use GrahamCampbell\CMSCore\Models\Relations\Common\TraitHasManyFiles;
use GrahamCampbell\CMSCore\Models\Relations\Interfaces\IHasManyComments;
use GrahamCampbell\CMSCore\Models\Relations\Common\TraitHasManyComments;
use GrahamCampbell\CMSCore\Models\Relations\Interfaces\IBelongsToManyEvents;
use GrahamCampbell\CMSCore\Models\Relations\Common\TraitBelongsToManyEvents;

/**
 * This is the user model class.
 *
 * @package    CMS-Core
 * @author     Graham Campbell
 * @copyright  Copyright (C) 2013  Graham Campbell
 * @license    https://github.com/GrahamCampbell/CMS-Core/blob/develop/LICENSE.md
 * @link       https://github.com/GrahamCampbell/CMS-Core
 */
class User extends SentryUser implements IBaseModel, INameModel, IHasManyPages, IHasManyPosts, IHasManyEvents, IHasManyFolders, IHasManyFiles, IHasManyComments, IBelongsToManyEvents
{
    use TraitBaseModel, TraitNameModel, TraitHasManyPages, TraitHasManyPosts, TraitHasManyEvents, TraitHasManyFolders, TraitHasManyFiles, TraitHasManyComments, TraitBelongsToManyEvents;

    /**
     * The table the users are stored in.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The model name.
     *
     * @var string
     */
    public static $name = 'user';

    /**
     * The columns to select when displaying an index.
     *
     * @var array
     */
    public static $index = array('id', 'email', 'first_name', 'last_name');

    /**
     * The max users per page when displaying a paginated index.
     *
     * @var int
     */
    public static $paginate = 20;

    /**
     * The columns to order by when displaying an index.
     *
     * @var string
     */
    public static $order = 'email';

    /**
     * The direction to order by when displaying an index.
     *
     * @var string
     */
    public static $sort = 'asc';

    /**
     * Get email.
     *
     * @param  array  $input
     * @return void
     */
    public function getEmail()
    {
        // TODO: Use the TraitEmailModel from the Core package
        return $this->email;
    }

    /**
     * Get activated.
     *
     * @return bool
     */
    public function getActivated()
    {
        // TODO: Use the TraitActivatedModel from the Core package
        return $this->activated;
    }

    /**
     * Get activated_at.
     *
     * @return \Carbon\Carbon
     */
    public function getActivatedAt()
    {
        // TODO: Use the TraitActivatedModel from the Core package
        $activated_at = $this->activated_at;

        if ($activated_at) {
            return new Carbon($activated_at);
        }

        if ($this->activated) {
            return $this->created_at;
        }

        return null;
    }

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
