<?php

  namespace Tobya\Fixsqldate\Providers;



  use Tobya\FixSQLDate\Console\CheckSQLGrammerDate;

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