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
 * 18 October 2009                                                                            *
 *                                                                                            *
 * log.php                                                                                    *
 *                                                                                            *
 * Log class                                                                                  *
 *                                                                                            *
 * Encapsulates writes to system log                                                          *
 **********************************************************************************************/

class Log {
  
  // Class variables
  private $logFile;
  
  // __construct()
  // Opens log file in preparation for loggin
  
  function __construct() {
    global $logFilePath;
    
    $logFile = '..' . $logFilePath;
    $this->logFile = fopen($logFile, 'a');
  }
  
  
  
  // log(origin, entry)
  // Logs date, time, origin, and entry to log
  
  function log($origin, $entry) {
    fwrite($this->logFile, date('m-d-Y H:i:s'));
    fwrite($this->logFile, ' ' . $origin . ' ');
    fwrite($this->logFile, $entry . "\n");
  }
  
  
  
  // __destruct()
  // Closes log file
  
  function __destruct() {
    fclose($this->logFile);
  }
}
?>