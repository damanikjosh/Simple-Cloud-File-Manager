###################
Simple Cloud File Manager
###################

Tugas besar calon kru ARC ITB divisi Web.
Simple Cloud File Manager ini menggunakan PHP framework [Codeigniter](www.codeigniter.com) .

*******************
Petunjuk Instalasi
*******************

1. Download file yang ada di repositori ini
2. Buat database MySQL dan konfigurasi file application/config/database.php
3. Buat tabel "users" dan "ci_sessions"

Script untuk tabel "users"

```
CREATE TABLE 'users' (
  'id' INT NOT NULL AUTO_INCREMENT,
  'email_address' VARCHAR(50) NOT NULL,
  'password' VARCHAR(128) NOT NULL,
  'first_name' VARCHAR(40) NOT NULL,
  'last_name' VARCHAR(45) NOT NULL,
  'created' TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  'is_admin' INT(1) NOT NULL DEFAULT 0,
  PRIMARY KEY ('id'));
```

**************************
Server Requirements
**************************

* Apache 2 atau Nginx
* PHP 5.6
* MySQL
* PHP 5.6 Extensions:
 * php56-ctype
 * php56-session
 * php56-filter

