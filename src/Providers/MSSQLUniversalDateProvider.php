<?php

  namespace Tobya\MSSQLDateformat\Providers;



  use Tobya\MSSQLDateformat\Console\CheckSQLGrammerDate;

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
    }
  }