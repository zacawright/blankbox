 _____ __    _____ _____ _____ _____ _____ __ __ 
| __  |  |  |  _  |   | |  |  | __  |     |  |  |
| __ -|  |__|     | | | |    -| __ -|  |  |-   -|
|_____|_____|__|__|_|___|__|__|_____|_____|__|__|


/* Installation Instructions */

These instructions assume that you know a little bit about development and know how to set variables and set up an SQL server.

-- Stage One --

Copy the contents of the folder you downloaded into the home directory of your web server.
This includes the 'utilities' folder and the 'index.php' file and 'installation.php' file.

-- Stage Two --

Open the 'connect.php' document with a text editor. This is located in the 'utilities' folder.
Change the data of the variables $SQL_SERVER_ADDRESS, $SQL_SERVER_USERNAME and $SQL_SERVER_PASSWORD to your server connection information.
Do NOT change the $SQL_SERVER_DATABASE variable yet. We will do that later.

-- Stage Three --

Start your web server and navigate to the 'index.php' file in your browser.
If you see 'server_init_failed' on your screen. Return to stage one and check the data you have used.
If you see a blank page. All is good, move to Stage Three.

-- Stage Four --

Open the 'installation.php' file in a text editor. This is located in the home directory.
Edit lines 7,9,10 and 11 to match the information you want. Line 7 is the database name. Line 9,10 and 11 is the login information for your account.
(You choose the login information)

/* How to use */