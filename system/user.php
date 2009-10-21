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
 * user.php                                                                                   *
 *                                                                                            *
 * User class                                                                                 *
 *                                                                                            *
 * Encapsulates user information, priveleges, and login/logout functionality                  *
 **********************************************************************************************/

class User {
  
  // Class variables
  private $isLoggedIn;
  
  private $username;
  private $passwordHash;
  
  // __construct()
  // Starts a new session if necessary and loads current user information
  
  function __construct() {
    session_start();
    
    if(isset($_SESSION['isLoggedIn'])) {
      $this->isLoggedIn = $_SESSION['isLoggedIn'];
    }
    
    if($this->isLoggedIn == 1) {
      $this->username = $_SESSION['username'];
      $this->passwordHash = $_SESSION['passwordHash'];
    }
  }
  
  
  
  // setUserCredentials(username, password)
  // Set username and password in order to login
  
  function setUserCredentials($username, $password) {
    if($this->isLoggedIn == 0) {
      $this->username = $username;
      $this->passwordHash = sha1($password);
    }
  }
  
  
  
  // login()
  // Attempts to login
  
  function login() {
    global $database;
    
    $database->query("SELECT * FROM ###users WHERE username='$this->username' AND "
                     . "passwordHash='$this->passwordHash'");
    $numberOfRows = $database->getNumberOfRows();
    
    if($numberOfRows == 1) {
      $_SESSION['isLoggedIn'] = 1;
      $_SESSION['username'] = $this->username;
      $_SESSION['passwordHash'] = $this->passwordHash;
      $this->isLoggedIn = 1;
    } else {
      $_SESSION['isLoggedIn'] = 0;
      $this->isLoggedIn = 0;
    }
  }
  
  
  
  // logout()
  // Attempts to logout
  
  function logout() {
    if($this->isLoggedIn == 1) {
      
      $this->isLoggedIn = 0;
      unset($_SESSION['isLoggedIn']);
      $destroyResult = session_destroy();
      
      if($destroyResult) {
        return 1;
      } else {
        throw new Exception('Could not log out.');
      }
    } else {
      throw new Exception('Alreagy logged out.');
    }
  }
  
  
  
  // isLoggedIn()
  // Returns 1 if user is already logged in, 0 otherwise
  
  function isLoggedIn() {
    return $this->isLoggedIn;
  }
}
?>