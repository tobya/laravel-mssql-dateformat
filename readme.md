# MSSQL Dateformat Fixer

There is an [international date format (ISO standard)](https://www.iso.org/iso-8601-date-and-time-format.html)  (YYYY-MM-DD) `Y-m-d` that is supposed to be universal, however the MSSQL implementation is flawed
and is NOT universal and incorrectly interprets `Y-m-d`  as `Y-d-m` which is beyond idiotic.
Laravel uses `Y-m-d` as their international format, which can lead to errors depending on SQL SERVER Settings.

There is one format `Ymd` which is absolutely gauranteed to always be interpreted by SQLServer as `Ymd`.  This command patches the file in 
illuminate library to use `Ymd` instead of `Y-m-d`.  I [Requested](https://github.com/laravel/framework/issues/49074) that the change be made in the illuminate library but it was felt the change
was too big to be made. 

I hope this is helpful to those of you out there using MSSQL with PHP/Laravel.

## Installation

Install with composer

````dotenv
composer require tobya/laravel-mssql-dateformat
````
### To Run

Run by calling the larvel command

````dotenv
artisan mssql:check-universal-date --update
````
You can run without `--update` to do the check without patching the file.

## Configuration 

It is suggested that you add the following to your project `composer.json` file so this command is automatically run
on install and update.  

````dotenv

"scripts": {
        "post-update-cmd": [
            "@php artisan mssql:check-universal-date --update"
        ],
        "post-install-cmd": [
            "@php artisan mssql:check-universal-date --update"
        ]
   }
````
This is due to the fact that whenever `composer update` or `composer install` is run and the illuminate package
is updated it will overwrite the `SqlServerGrammar.php` with the origional version, so it is necessary to call
the command whenever this has the potential of happening.  If no change has been made to the file it will
not be modified.

#### Further reading on why this is necessary

This is discussed in several places online

 - [sqlblog.org/2009/10/16/bad-habits-to-kick-mis-handling-date-range-queries](https://sqlblog.org/2009/10/16/bad-habits-to-kick-mis-handling-date-range-queries)
 - [stackoverflow.com/questions/19565320/why-is-sql-server-misinterpreting-this-iso-8601-format-date](https://stackoverflow.com/questions/19565320/why-is-sql-server-misinterpreting-this-iso-8601-format-date)
