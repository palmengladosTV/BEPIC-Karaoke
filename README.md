# BEPIC-Karaoke

This is a small project of a karaoke list for the annual BEPIC-Fest at Ulm University. You can add songs, remove them and change the order of the songs. The insert form has an autocompletable drop down menu of valid songs. If you want to add songs, you need to put them into the `songs.json` file.

## Requirements

- Linux of course
- MySQL / MariaDB Server
- Webserver with PHP
- php-mysql for your distribution

## Setup

1. Execute `KARAOKE.SQL` to create the required database and tables
2. Change username (`$db_user`) and password (`$db_pw`) to fit your database in `globals.php`
3. Change the login password (`$PASSWORD`) in `globals.php`, so you're allowed to add, move and delete entries.
4. Start the webserver and you're good to go


© 2022 Fabian Lippold & Tim Palm
