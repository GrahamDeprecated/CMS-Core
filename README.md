CMS Core
========


[![Bitdeli Badge](https://d2weczhvl823v0.cloudfront.net/GrahamCampbell/CMS-Core/trend.png)](https://bitdeli.com/free "Bitdeli Badge")
[![Build Status](https://travis-ci.org/GrahamCampbell/CMS-Core.png?branch=master)](https://travis-ci.org/GrahamCampbell/CMS-Core)
[![Latest Version](https://poser.pugx.org/graham-campbell/cms-core/v/stable.png)](https://packagist.org/packages/graham-campbell/cms-core)
[![Total Downloads](https://poser.pugx.org/graham-campbell/cms-core/downloads.png)](https://packagist.org/packages/graham-campbell/cms-core)
[![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/GrahamCampbell/CMS-Core/badges/quality-score.png?s=abade2f7af64ae1b36516618be72c26f9fd560bc)](https://scrutinizer-ci.com/g/GrahamCampbell/CMS-Core)
[![Still Maintained](http://stillmaintained.com/GrahamCampbell/CMS-Core.png)](http://stillmaintained.com/GrahamCampbell/CMS-Core)


## What Is CMS Core?

CMS Core provides some core functionality for [Bootstrap CMS](https://github.com/GrahamCampbell/Bootstrap-CMS).  

* CMS Core was created by, and is maintained by [Graham Campbell](https://github.com/GrahamCampbell).  
* CMS Core uses [Travis CI](https://travis-ci.org/GrahamCampbell/CMS-Core) to run tests to check if it's working as it should.  
* CMS Core uses [Scrutinizer CI](https://scrutinizer-ci.com/g/GrahamCampbell/CMS-Core) to run additional tests and checks.  
* CMS Core uses [Composer](https://getcomposer.org) to load and manage dependencies.  
* CMS Core provides a [change log](https://github.com/GrahamCampbell/CMS-Core/blob/master/CHANGELOG.md), [releases](https://github.com/GrahamCampbell/CMS-Core/releases), and a [wiki](https://github.com/GrahamCampbell/CMS-Core/wiki).  
* CMS Core is licensed under the GNU AGPLv3, available [here](https://github.com/GrahamCampbell/CMS-Core/blob/master/LICENSE.md).  


## System Requirements

* PHP 5.3.3+, 5.4+ or PHP 5.5+ is required.
* You will need [Laravel 4](http://laravel.com) because this package is designed for it.  
* You will need [Composer](https://getcomposer.org) installed to load the dependencies of CMS Core.  


## Installation

Please check the system requirements before installing CMS Core.  

To get the latest version of CMS Core, simply require it in your `composer.json` file.

`"graham-campbell/cms-core": "dev-master"`

You'll then need to run `composer install` or `composer update` to download it and have the autoloader updated.

Once CMS Core is installed, you need to register the service provider. Open up `app/config/app.php` and add the following to the `providers` key.

`'GrahamCampbell\CMSCore\CMSCoreServiceProvider'`

You can register the Navigation facade in the `aliases` key of your `app/config/app.php` file if you like.

`'Navigation' => 'GrahamCampbell\CMSCore\Facades\Navigation'`


## Updating Your Fork

The latest and greatest source can be found on [GitHub](https://github.com/GrahamCampbell/CMS-Core).  
Before submitting a pull request, you should ensure that your fork is up to date.  

You may fork CMS Core:  

    git remote add upstream git://github.com/GrahamCampbell/CMS-Core.git

The first command is only necessary the first time. If you have issues merging, you will need to get a merge tool such as [P4Merge](http://perforce.com/product/components/perforce_visual_merge_and_diff_tools).  

You can then update the branch:  

    git pull --rebase upstream develop
    git push --force origin <branch_name>

Once it is set up, run `git mergetool`. Once all conflicts are fixed, run `git rebase --continue`, and `git push --force origin <branch_name>`.  


## Pull Requests

Please submit pull requests against the develop branch.  

* Any pull requests made against the master branch will be closed immediately.  
* If you plan to fix a bug, please create a branch called `fix-`, followed by an appropriate name.  
* If you plan to add a feature, please create a branch called `feature-`, followed by an appropriate name.  
* Please indent with 4 spaces rather than tabs, and make sure your code is commented.  


## License

GNU AFFERO GENERAL PUBLIC LICENSE  

CMS Core Provides Some Core Functionality For Bootstrap CMS  
Copyright (C) 2013  Graham Campbell  

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU Affero General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.  

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU Affero General Public License for more details.  

You should have received a copy of the GNU Affero General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.  
