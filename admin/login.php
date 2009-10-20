<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3c.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <title>Login</title>
  </head>
  <body>
    <form method="post" action="<?php echo $sitePath . "administration/"; ?>">
      <input type="text" name="username" id="username" /><br />
      <input type="password" name="password" id="password" /><br />
      <input type="submit" />
    </form>
  </body>
</html>