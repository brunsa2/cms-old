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
    $logFilePath = '..' . $logFilePath;
    $this->logFile = fopen($logFilePath);
  }
  
  // __destruct()
  // Closes log file
  
  function __destruct() {
    fclose($logFile);
  }
}
?>