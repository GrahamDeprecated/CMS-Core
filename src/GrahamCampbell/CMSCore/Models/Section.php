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

class Section extends BaseModel implements Interfaces\ITitleModel, Interfaces\ISummaryModel, Relations\Interfaces\IHasManyTopics, Relations\Interfaces\IBelongsToUser {

    use Common\TraitTitleModel, Common\TraitSummaryModel, Relations\Common\TraitHasManyTopics, Relations\Common\TraitBelongsToUser;

    /**
     * The table the sections are stored in.
     *
     * @var string
     */
    protected $table = 'sections';

    /**
     * The model name.
     *
     * @var string
     */
    public static $name = 'section';

    /**
     * The columns to select when displaying an index.
     *
     * @var array
     */
    public static $index = array('id', 'title', 'summary', 'created_at');

    /**
     * The max sections per page when displaying a paginated index.
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
     * The section validation rules.
     *
     * @var array
     */
    public static $rules = array(
        'title'   => 'required',
        'summary' => 'required',
        'user_id' => 'required'
    );

    /**
     * The section factory.
     *
     * @var array
     */
    public static $factory = array(
        'id'      => 1,
        'title'   => 'Section',
        'summary' => 'The is a section with topics in.',
        'user_id' => 1
    );

    /**
     * Before deleting an existing model.
     *
     * @return mixed
     */
    public function beforeDelete() {
        $this->deleteTopics();
    }
}
