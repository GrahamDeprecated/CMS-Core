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

use Cartalyst\Sentry\Users\Eloquent\User as SentryUser;

class User extends SentryUser implements Interfaces\IBaseModel, Interfaces\INameModel, Relations\Interfaces\IHasManyPages, Relations\Interfaces\IHasManyPosts, Relations\Interfaces\IHasManyEvents, Relations\Interfaces\IHasManyComments, Relations\Interfaces\IBelongsToManyEvents {

    use Common\TraitBaseModel, Common\TraitNameModel, Relations\Common\TraitHasManyPages, Relations\Common\TraitHasManyPosts, Relations\Common\TraitHasManyEvents, Relations\Common\TraitHasManyComments, Relations\Common\TraitBelongsToManyEvents;

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
    public function getEmail() {
        return $this->email;
    }


    /**
     * Get activated_at.
     *
     * @return \Carbon\Carbon
     */
    public function getActivatedAt() {
        $activated_at = $this->activated_at;

        if ($activated_at) {
            return new Carbon($activated_at);
        }

        if ($this->activated) {
            return $this->getCreatedAt();
        }

        return null;
    }

    /**
     * Before deleting an existing model.
     *
     * @return mixed
     */
    public function beforeDelete() {
        $this->deleteInvites();
        $this->deletePages();
        $this->deletePosts();
        $this->deleteEvents();
        $this->deleteComments();
    }
}
