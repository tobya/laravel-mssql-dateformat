<?php

namespace Tobya\FixSQLDate\Console;


use Illuminate\Console\Command;

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
    protected $description = 'Checks if the illuminate files in vendor directory are using incorrect date format. ';

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
        $filetocheck = base_path('vendor\laravel\framework\src\Illuminate\Database\Query\Grammars\SqlServerGrammar.php');
        if (file_exists($filetocheck)){
            $file_txt = Str(file_get_contents($filetocheck));
            $datestr = 'return \'Y-m-d H:i:s.v\';';
            if ($file_txt->contains($datestr)){
                if ($this->option('update')){
                    $UpdatedFile_txt = $file_txt->replace($datestr, 'return \'Ymd H:i:s.v\';');
                    file_put_contents($filetocheck,$UpdatedFile_txt);

                    $this->comment("
**********************************                    
Incorrect Date Format value found
********************************** 
File on disk: $filetocheck");
                    $this->info('
------------------
Updated
------------------');
                    return 0;
                } else {
                    $this->warn( $this->NoUpdateMessage($filetocheck));
                    $this->warn('Not Updated');
                    return 0;
                }

            }
        }
        $this->info( "Date Format Appears to be ok.");
        return 0;
    }

    public function NoUpdateMessage($filetocheck){
        return  "
$filetocheck
  has been overwritten with the wrong date format.  mssql:CheckSQLDate --update to update the file. ";
    }
}
