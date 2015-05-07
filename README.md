# Simple Cloud File Manager

Simple Cloud File Manager ini merupakan Tugas besar kelompok 1 calon kru ARC ITB divisi Web.
Simple Cloud File Manager ini menggunakan PHP framework [Codeigniter](http://www.codeigniter.com) .

## Petunjuk Instalasi

1. Download file yang ada di repositori ini
2. Buat database MySQL dan konfigurasi file [database.php](application/config/database.php)
3. Buat tabel `users` dan `ci_sessions`

SQL script untuk tabel `users`:

        CREATE TABLE 'users' (
          'id' INT NOT NULL AUTO_INCREMENT,
          'email_address' VARCHAR(50) NOT NULL,
          'password' VARCHAR(128) NOT NULL,
          'first_name' VARCHAR(40) NOT NULL,
          'last_name' VARCHAR(45) NOT NULL,
          'created' TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
          'is_admin' INT(1) NOT NULL DEFAULT 0,
          PRIMARY KEY ('id')
        );

SQL script untuk tabel `ci_sessions`:

        CREATE TABLE IF NOT EXISTS 'ci_sessions' (
          'id' varchar(40) NOT NULL,
          'ip_address' varchar(45) NOT NULL,
          'timestamp' int(10) unsigned DEFAULT 0 NOT NULL,
          'data' blob NOT NULL,
          PRIMARY KEY (id),
          KEY 'ci_sessions_timestamp' ('timestamp')
        );

## Server Requirements

* Apache 2 atau Nginx
* PHP 5.6
* MySQL
* PHP 5.6 Extensions:
  * php56-ctype
  * php56-session
  * php56-filter

## To Do List

- [ ] USER FEATURES
  - [ ] Upload
  - [ ] All extensions
  - [ ] Sort by
  - [ ] Personalize
- [ ] ADMIN FEATURES
  - [ ] Upload
  - [ ] User management
  - [ ] Configure
  - [ ] Logs
- [ ] BONUS
  - [ ] Edit on the spot
  - [ ] File viewer
  - [ ] File sharing

