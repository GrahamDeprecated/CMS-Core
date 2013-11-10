<?php namespace GrahamCampbell\CMSCore\Handlers;

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

use Mail;

class MailHandler extends BaseHandler {

    /**
     * Run the task (called by BaseHandler).
     *
     * @return void
     */
    protected function run() {
        $data = $this->data;
        if (!is_array($this->data['email'])) {
            $this->data['email'] = array($this->data['email']);
        }
        foreach($this->data['email'] as $email) {
            $data['email'] = $email;
            Mail::send($data['view'], $data, function($mail) use($data) {
                $mail->to($data['email'])->subject($data['subject']);
            });
        }
    }
}
