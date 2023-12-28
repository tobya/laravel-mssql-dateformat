# MSSQL Dateformat Fixer

There is an international date format Y-m-d that is supposed to be universal, however the MSSQL implementation is flawed
and is not universal and incorrect interprets it as Y-d-m which is beyond idiotic.
Laravel uses Y-m-d as their international format, which can lead to errors depending on SQL SERVER Settings.
This command checks the vendor directory for the file and updates it if required.

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