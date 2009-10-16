<?php
/**********************************************************************************************
 * Content Management System                                                                  *
 * Copyright (C) 2009 Jeff Stubler                                                            *
 *                                                                                            *
 * This program is free software: you can redistribute it and/or modify                       *
 * it under the terms of the GNU General Public License as published by                       *
 * the Free Software Foundation, either version 3 of the License, or                          *
 * (at your option) any later version.                                                        *
 *                                                                                            *
 * This program is distributed in the hope that it will be useful,                            *
 * but WITHOUT ANY WARRANTY; without even the implied warranty of                             *
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the                              *
 * GNU General Public License for more details.                                               *
 *                                                                                            *
 * You should have received a copy of the GNU General Public License                          *
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.                      *
 *                                                                                            *
 * 6 October 2009                                                                             *
 *                                                                                            *
 * database.php                                                                               *
 *                                                                                            *
 * Database class                                                                             *
 *                                                                                            *
 * Encapsulates connection to MySQL database via mysqli driver                                *
 **********************************************************************************************/

class Database {
  
  // Class variables
  private $databaseConnection;
  private $queryResult;
  private $numberOfRows = 0;
  private $numberOfRowsLeft = 0;
  
  // __construct()
  // Connects to database from data from config.php
  
  function __construct() {
    
    global $database_configuration;
    
    // Create database connection
    $this->databaseConnection = new mysqli($database_configuration['HOST'],
                                           $database_configuration['USERNAME'],
                                           $database_configuration['PASSWORD'],
                                           $database_configuration['DATABASE']);

    if(mysqli_connect_errno()) {
      echo 'Cannot connect to database';
      exit;
    }
  }


  
  // query(queryString)
  // Make a query request to the database
  // Replace $$$ with database prefix
  
  function query($queryString) {
    global $database_configuration;
    
    $queryString = str_replace('###', $database_configuration['PREFIX'], $queryString);
    
    $this->queryResult = $this->databaseConnection->query($queryString);
    $this->numberOfRows = $this->queryResult->num_rows;
    $this->numberOfRowsLeft = $this->numberOfRows;
  }
  
  
  
  // getNumberOfRows()
  // Return number of rows from query
  
  function getNumberOfRows() {
    return $this->numberOfRows;
  }
  
  
  
  // getNumberOfRowsLeft()
  // Return number of rows left
  
  function getNumberOfRowsLeft() {
    return $this->numberOfRowsLeft;
  }
  
  
  
  // isRowAvailable()
  // Return 1 if at least one row left
  
  function isRowAvailable() {
    if ($this->numberOfRowsLeft > 0) {
      return 1;
    } else {
      return 0;
    }
  }
  
  
  
  // fetchRow()
  // Fetches current row from result for access to it
  
  function fetchRow() {
    return $this->queryResult->fetch_assoc();
    $this->numberOfRowsLeft--;
  }
  
  
  
  // __destruct()
  // Close database connection upon class destruction
  
  function __destruct() {
    $this->databaseConnection->close();
  }
}
?>