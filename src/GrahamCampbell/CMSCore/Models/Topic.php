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

class Topic extends BaseModel implements Interfaces\ITitleModel, Interfaces\IBodyModel, Interfaces\ISummaryModel, Relations\Interfaces\IHasManyReplies, Relations\Interfaces\IBelongsToSection, Relations\Interfaces\IBelongsToUser {

    use Common\TraitTitleModel, Common\TraitBodyModel, Common\TraitSummaryModel, Relations\Common\TraitHasManyReplies, Relations\Common\TraitBelongsToSection, Relations\Common\TraitBelongsToUser;

    /**
     * The table the topics are stored in.
     *
     * @var string
     */
    protected $table = 'topics';

    /**
     * The model name.
     *
     * @var string
     */
    public static $name = 'topic';

    /**
     * The columns to select when displaying an index.
     *
     * @var array
     */
    public static $index = array('id', 'title', 'summary');

    /**
     * The max topics per page when displaying a paginated index.
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
     * The topic validation rules.
     *
     * @var array
     */
    public static $rules = array(
        'title'      => 'required',
        'summary'    => 'required',
        'body'       => 'required',
        'section_id' => 'required',
        'user_id'    => 'required'
    );

    /**
     * The topic factory.
     *
     * @var array
     */
    public static $factory = array(
        'id'         => 1,
        'title'      => 'String',
        'summary'    => 'Summary of a topic.',
        'body'       => 'The body of a topic.',
        'section_id' => 1,
        'user_id'    => 1
    );

    /**
     * Before deleting an existing model.
     *
     * @return mixed
     */
    public function beforeDelete() {
        $this->deleteReplies();
    }
}
