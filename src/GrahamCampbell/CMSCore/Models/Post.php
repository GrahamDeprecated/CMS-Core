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

use GrahamCampbell\Core\Models\AbstractModel;
use GrahamCampbell\Core\Models\Interfaces\ITitleModel;
use GrahamCampbell\Core\Models\Common\TraitTitleModel;
use GrahamCampbell\Core\Models\Interfaces\IBodyModel;
use GrahamCampbell\Core\Models\Common\TraitBodyModel;
use GrahamCampbell\Core\Models\Interfaces\ISummaryModel;
use GrahamCampbell\Core\Models\Common\TraitSummaryModel;
use GrahamCampbell\CMSCore\Models\Relations\Interfaces\IHasManyComments;
use GrahamCampbell\CMSCore\Models\Relations\Common\TraitHasManyComments;
use GrahamCampbell\CMSCore\Models\Relations\Interfaces\IBelongsToUser;
use GrahamCampbell\CMSCore\Models\Relations\Common\TraitBelongsToUser;

/**
 * This is the post model class.
 *
 * @package    CMS-Core
 * @author     Graham Campbell
 * @copyright  Copyright (C) 2013  Graham Campbell
 * @license    https://github.com/GrahamCampbell/CMS-Core/blob/develop/LICENSE.md
 * @link       https://github.com/GrahamCampbell/CMS-Core
 */
class Post extends AbstractModel implements ITitleModel, IBodyModel, ISummaryModel, IHasManyComments, IBelongsToUser
{
    use TraitTitleModel, TraitBodyModel, TraitSummaryModel, TraitHasManyComments, TraitBelongsToUser;

    /**
     * The table the posts are stored in.
     *
     * @var string
     */
    protected $table = 'posts';

    /**
     * The model name.
     *
     * @var string
     */
    public static $name = 'post';

    /**
     * The columns to select when displaying an index.
     *
     * @var array
     */
    public static $index = array('id', 'title', 'summary');

    /**
     * The max posts per page when displaying a paginated index.
     *
     * @var int
     */
    public static $paginate = 10;

    /**
     * The columns to order by when displaying an index.
     *
     * @var string
     */
    public static $order = 'id';

    /**
     * The direction to order by when displaying an index.
     *
     * @var string
     */
    public static $sort = 'desc';

    /**
     * The post validation rules.
     *
     * @var array
     */
    public static $rules = array(
        'title'   => 'required',
        'summary' => 'required',
        'body'    => 'required',
        'user_id' => 'required'
    );

    /**
     * The post factory.
     *
     * @var array
     */
    public static $factory = array(
        'id'      => 1,
        'title'   => 'String',
        'summary' => 'Summary of a post.',
        'body'    => 'The body of a post.',
        'user_id' => 1
    );

    /**
     * Before deleting an existing model.
     *
     * @return mixed
     */
    public function beforeDelete()
    {
        $this->deleteComments();
    }
}
