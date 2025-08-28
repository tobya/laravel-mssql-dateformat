<?php

namespace Tobya\MSSQLDateformat\Console;


use Illuminate\Console\Command;
use Illuminate\Support\Str;
/**
 * There is an international date format Y-m-d that is supposed to be universal, however the MSSQL implementation is flawed
 * and is not universal and incorrect interprets it as Y-d-m which is beyond idiotic.
 * Laravel uses Y-m-d as their international format, which can lead to errors depending on SQL SERVER Settings.
 * This command checks the vendor directory for the file and updates it if required.
 *
 * It is suggested that you add the following to your project composer.json file so this command is automatically run
 * on install and update.
 *
 *
"scripts": {
        "post-update-cmd": [
            "@php artisan mssql:check-universal-date --update"
        ],
        "post-install-cmd": [
            "@php artisan mssql:check-universal-date --update"
        ]
   }
 *
 */

 /**
  * Class CheckSQLGrammerDate
 * @package App\Console\Commands
 */
class CheckSQLGrammerDate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mssql:check-universal-date {--update : Overwrite files in Vendor directory.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deprecated: Date Format is now updated by use of inherited grammar.  This command is no longer required. ';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $this->warn( "Deprecated: Date Format is now updated by use of inherited grammar.  This command is no longer required. ");
        return 0;
    }


}
