Nette, Webloader, Texyla example
================================
This is Nette, Webloader, Texyla and Twitter, from Bootstrap minimal working example (skeleton of project). 

Authors
-------
I just compiled Nette framework with libs - all merit have authors of:

**[Nette](http://www.nette.org "Nette framework")** - [Nette Foundation](http://nettefoundation.com/ "Nette foundation") - https://github.com/nette/nette

**[Texyla](https://github.com/janmarek/Texyla)** - Jan Marek

**[Webloader](https://github.com/janmarek/WebLoader)** - Jan Marek

**[Twitter, from Bootstrap](https://github.com/twitter/bootstrap)** - [Twitter, inc](http://www.twitter.com)

**[Composer](http://getcomposer.org)**

The first concept of this skeleton is from Jan Suchánek.

Thanks!

Use
---
Only think to do after download is (pwd is root of project):
```bash
mkdir log              # make directory for cache
mkdir -p temp/cache    # make directory for temp
mkdir -p www/webtemp   # make directory for webtemp
chown -R www-data:www-data log temp www/webtemp
composer install       # composer install dependencies
scrips/move_resources_to_root.sh # copy resources from libs to the webtemp
```
Tip: If you get only Homepage and another pages send "Not Found" then you have bad configure (or haven't) mod_rewrite.

How does this work
------------------
Nette BasePresenter provide components for: Texyla, css, js. Each component call loader (instance of webloader) and them webloader provide minified compilation of css/js/texyla dependecy. Dependency are determinate in loaders.

Nette have very good work witch cache, you don't have to worry about efficiency. Webloader run only if you change source files.

Database model
--------------
Create sql skript:
```sql
SET NAMES utf8;

CREATE DATABASE `nwt_test`;
USE `nwt_test`;

CREATE TABLE `article` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_czech_ci NOT NULL,
  `keywords` varchar(45) COLLATE utf8_czech_ci DEFAULT NULL,
  `insert_datetime` datetime NOT NULL,
  `last_modification` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `content_texy` text COLLATE utf8_czech_ci NOT NULL,
  `content_html` text COLLATE utf8_czech_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;
```
DB user test, password test, create:
```bash
mysql> grant usage on *.* to test@localhost identified by 'test';
Query OK, 0 rows affected (0.00 sec)
mysql> grant all privileges on nwt_test.* to test@localhost ;
Query OK, 0 rows affected (0.06 sec)
```