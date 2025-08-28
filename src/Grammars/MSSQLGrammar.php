<?php

  namespace Tobya\MSSQLDateformat\Grammars;

  use Illuminate\Database\Query\Grammars\SqlServerGrammar;

  class MSSQLGrammar extends SqlServerGrammar
  {

      /**
     * Get the format for database stored dates.
     * Override to use universal MSSQL format
     *
     * @return string
     */
    public function getDateFormat()
    {
        // return 'Y-m-d H:i:s.v';
        return 'Ymd H:i:s.v';
    }
  }
