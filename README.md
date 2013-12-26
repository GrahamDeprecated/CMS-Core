CMS Core
========


[![Bitdeli Badge](https://d2weczhvl823v0.cloudfront.net/GrahamCampbell/CMS-Core/trend.png)](https://bitdeli.com/free "Bitdeli Badge")
[![Build Status](https://travis-ci.org/GrahamCampbell/CMS-Core.png?branch=develop)](https://travis-ci.org/GrahamCampbell/CMS-Core)
[![Coverage Status](https://coveralls.io/repos/GrahamCampbell/CMS-Core/badge.png?branch=develop)](https://coveralls.io/r/GrahamCampbell/CMS-Core)
[![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/GrahamCampbell/CMS-Core/badges/quality-score.png?s=abade2f7af64ae1b36516618be72c26f9fd560bc)](https://scrutinizer-ci.com/g/GrahamCampbell/CMS-Core)
[![Latest Version](https://poser.pugx.org/graham-campbell/cms-core/v/stable.png)](https://packagist.org/packages/graham-campbell/cms-core)
[![Still Maintained](http://stillmaintained.com/GrahamCampbell/CMS-Core.png)](http://stillmaintained.com/GrahamCampbell/CMS-Core)


## WARNING

#### This branch currently holds the very unstable 0.2 code. Expect things to be broken and tests to fail, and documentation to be inaccurate in places.


## What Is CMS Core?

CMS Core provides some core functionality for applications like [Bootstrap CMS](https://github.com/GrahamCampbell/Bootstrap-CMS).  

* CMS Core was created by, and is maintained by [Graham Campbell](https://github.com/GrahamCampbell).  
* CMS Core relies on many of my packages including [Laravel Core](https://github.com/GrahamCampbell/Laravel-Core) and [Laravel Queuing](https://github.com/GrahamCampbell/Laravel-Queuing).  
* CMS Core uses [Travis CI](https://travis-ci.org/GrahamCampbell/CMS-Core) to run tests to check if it's working as it should.  
* CMS Core uses [Scrutinizer CI](https://scrutinizer-ci.com/g/GrahamCampbell/CMS-Core) and [Coveralls](https://coveralls.io/r/GrahamCampbell/CMS-Core) to run additional tests and checks.  
* CMS Core uses [Composer](https://getcomposer.org) to load and manage dependencies.  
* CMS Core provides a [change log](https://github.com/GrahamCampbell/CMS-Core/blob/master/CHANGELOG.md), [releases](https://github.com/GrahamCampbell/CMS-Core/releases), and a [wiki](https://github.com/GrahamCampbell/CMS-Core/wiki).  
* CMS Core is licensed under the GNU AGPLv3, available [here](https://github.com/GrahamCampbell/CMS-Core/blob/master/LICENSE.md).  


## System Requirements

* PHP 5.4.7+ or PHP 5.5+ is required.  
* You will need [Laravel 4.1](http://laravel.com) because this package is designed for it.  
* You will need [Composer](https://getcomposer.org) installed to load the dependencies of CMS Core.  


## Installation

Please check the system requirements before installing CMS Core.  

To get the latest version of CMS Core, simply require it in your `composer.json` file.  

`"graham-campbell/cms-core": "dev-master"`  

You'll then need to run `composer install` or `composer update` to download it and have the autoloader updated.  

You will need to register many service providers before you attempt to load the CMS Core service provider. Open up `app/config/app.php` and add the following to the `providers` key.  

`'Lightgear\Asset\AssetServiceProvider'`  
`'Cartalyst\Sentry\SentryServiceProvider'`  
`'GrahamCampbell\Viewer\ViewerServiceProvider'`  
`'GrahamCampbell\Queuing\QueuingServiceProvider'`  
`'GrahamCampbell\HTMLMin\HTMLMinServiceProvider'`  
`'GrahamCampbell\Markdown\MarkdownServiceProvider'`  
`'GrahamCampbell\Security\SecurityMinServiceProvider'`  
`'GrahamCampbell\Binput\BinputServiceProvider'`  
`'GrahamCampbell\Passwd\PasswdServiceProvider'`  
`'GrahamCampbell\Throttle\ThrottleServiceProvider'`  
`'GrahamCampbell\Credentials\CredentialsServiceProvider'`  
`'GrahamCampbell\Navigation\NavigationServiceProvider'`  

Once CMS Core is installed, you need to register the service provider. Open up `app/config/app.php` and add the following to the `providers` key.  

`'GrahamCampbell\CMSCore\CMSCoreServiceProvider'`  


## Usage

There is currently no usage documentation besides the [API Documentation](http://grahamcampbell.github.io/CMS-Core) for CMS Core.  

You may see an example of implementation in [Bootstrap CMS](https://github.com/GrahamCampbell/Bootstrap-CMS). [CMS CloudFlare](https://github.com/GrahamCampbell/CMS-CloudFlare), [CMS Contact](https://github.com/GrahamCampbell/CMS-Contact), and [CMS LogViewer](https://github.com/GrahamCampbell/CMS-LogViewer) are all examples of plugins for the CMS.  


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
* Please follow the [PSR-2 Coding Style](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md) and [PHP-FIG Naming Conventions](https://github.com/php-fig/fig-standards/blob/master/bylaws/002-psr-naming-conventions.md).  


## License

GNU AFFERO GENERAL PUBLIC LICENSE  

CMS Core Provides Some Core Functionality For Applications Like Bootstrap CMS  
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
