Flexperto - Final Application Test
=====================================

THE TASK
--------------

Your task is to build an User-CRUD. You will find an already prepared User model in the common tier, including an authentication life-cycle (sign-up/sign-in/password-reset). What we expect:

Create your local YII 2 environment based on instruction below.

1.  add an Avatar to Users
2.  add a mobile number to Users
3.  build a profile for registered Users (including regular show, editing and canceling the account)


You can use whatever IDE / component / technology  you would like to, as long as this application stays the HTML-generating, server-side component. Keep in mind that your code will have to run in our Apache. An addition to this file for special setup instructions, such for example bower and stuff, would be wise if needed :-)


### The Hook


We really want you to show us your strengths. We tried, but we could not come up with a strict task that both seemed fair but also challenging for your unique mindsets. That's why we decided to design this task in a very open ended manner.

This means that we give you a guideline for 5 hours to solve the general task. How much time you actually spend is totally up to you. It can be less, twice or even ten times 5 hours.


### What to do with the time


Well, first of all you should try to deliver the key task. You are free to set your focus on model || controllers || views if you feel to. If you think that one or several items of the general task are for example generally outdated and bad practice, you can note this at the end of this section of the README, just skip it and get the task done in less than 5 hours. If you feel that there should be more to it, or you want to show us some nifty skills, or js libraries, or whatever - feel free to raise your time budget. You get the idea, right? Get the task done - in a way that you feel comfortable with.


When you are finished and feel the need to, you can also state specific things you focused on here:


### How to proceed

Check out the code using git. Start. When you are finished, pass on the code to Caspar Bauer:

mail:c.bauer@flexperto.com

skype:designtesbrot


Choose the format of submission of your choice :-) ( Mail / Dropbox / FTP / GitHub )


### Questions ?

Feel free to contact Caspar Bauer:

mail:c.bauer@flexperto.com

skype:designtesbrot

available at any time


APPLICATION INTRODUCTION
------------------------ 

This Application is based on the [Yii 2 Advanced Application Template](https://github.com/yiisoft/yii2-app-advanced).

Yii 2 Advanced Application Template is a skeleton Yii 2 application best for
developing complex Web applications with multiple tiers.

The template includes three tiers: front end, back end, and console, each of which
is a separate Yii application.

The template is designed to work in a team development environment. It supports
deploying the application in different environments.


DIRECTORY STRUCTURE
-------------------

```
common
    config/              contains shared configurations
    mail/                contains view files for e-mails
    models/              contains model classes used in both backend and frontend
console
    config/              contains console configurations
    controllers/         contains console controllers (commands)
    migrations/          contains database migrations
    models/              contains console-specific model classes
    runtime/             contains files generated during runtime
backend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains backend configurations
    controllers/         contains Web controller classes
    models/              contains backend-specific model classes
    runtime/             contains files generated during runtime
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
frontend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains frontend configurations
    controllers/         contains Web controller classes
    models/              contains frontend-specific model classes
    runtime/             contains files generated during runtime
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
    widgets/             contains frontend widgets
vendor/                  contains dependent 3rd-party packages
environments/            contains environment-based overrides
tests                    contains various tests for the advanced application
    codeception/         contains tests developed with Codeception PHP Testing Framework
```


REQUIREMENTS
------------

The minimum requirement by this application template that your Web server supports PHP 5.4.0.


INSTALLATION
------------

### Install from an Archive File

Extract the archive file downloaded from [yiiframework.com](http://www.yiiframework.com/download/) to
a directory named `advanced` that is directly under the Web root.

Then follow the instructions given in "GETTING STARTED".


### Install via Composer

If you do not have [Composer](http://getcomposer.org/), you may install it by following the instructions
at [getcomposer.org](http://getcomposer.org/doc/00-intro.md#installation-nix).

You can then install the application using the following command:

~~~
php composer.phar global require "fxp/composer-asset-plugin:1.0.0"
php composer.phar create-project --prefer-dist --stability=dev yiisoft/yii2-app-advanced advanced
~~~


GETTING STARTED
---------------

After you install the application, you have to conduct the following steps to initialize
the installed application. You only need to do these once for all.

1. Run command `init` to initialize the application with a specific environment.
2. Create a new database and adjust the `components['db']` configuration in `common/config/main-local.php` accordingly.
3. Apply migrations with console command `yii migrate`. This will create tables needed for the application to work.
4. Set document roots of your Web server:

- for frontend `/path/to/yii-application/frontend/web/` and using the URL `http://frontend/`
- for backend `/path/to/yii-application/backend/web/` and using the URL `http://backend/`

To login into the application, you need to first sign up, with any of your email address, username and password.
Then, you can login into the application with same email address and password at any time.