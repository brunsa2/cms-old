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
 * admin.php                                                                                  *
 *                                                                                            *
 * Admin page display                                                                         *
 *                                                                                            *
 * Displays either login or admin page, handles admin login and logout                        *
 **********************************************************************************************/

include('../system/config.php');
include('../system/database.php');
include('../system/user.php');

$argumentsPassed = explode('/', $_GET['x']);

for ($count = 0; $count < sizeof($argumentsPassed); $count++) {
  $argumentsPassed[$count] = htmlentities(strip_tags($argumentsPassed[$count]));
}

$database = new Database();
$user = new User();

// If necessary, logout
if ($argumentsPassed[0] == 'logout') {
  $user->logout();
}

// If necessary, login
if (isset($_POST['username']) && isset($_POST['password'])) {
  $user->setUserCredentials(mysql_real_escape_string($_POST['username']),
                            mysql_real_escape_string($_POST['password']));
  $user->login();
}

// If logged out, display login form
// Otherwise, display logged-in state
if ($user->isLoggedIn() == 0) {
  include('login.php');
} else {
  echo "Logged in";
}
?>