<?php

  namespace Tobya\MSSQLDateformat\Providers;



  use Tobya\MSSQLDateformat\Console\CheckSQLGrammerDate;
  use Illuminate\Support\Facades\DB;

  class MSSQLUniversalDateProvider extends \Illuminate\Support\ServiceProvider
  {
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->commands([
          CheckSQLGrammerDate::class
        ]);

        DB::connection()->setQueryGrammar(new \Tobya\MSSQLDateformat\Grammars\MSSQLGrammar(DB::connection()));
    }
  }
