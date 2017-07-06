# VATeir Website and Training System

In order to get this website to work on your own server you must see to the following:

## Website -> Database
* Rename core/init_demo.php to core/init.php.
* Insert relevant details to your setup.

## Website -> VATSIM SSO -> Website
* Rename login/configdemo.php to login/config.php.
* This will allow you to use the DEMO SSO logins (see the VATSIM forums for these) to login.

## PHPBB 3 Forum Integration
* You will need to modify the default PHPBB database schema to include a column called `vatsim_id` in the phpbb_users table.

