# Simple Cloud File Manager (BETA 1.0)

Simple Cloud File Manager ini merupakan Tugas besar kelompok 1 calon kru ARC ITB divisi Web.
Simple Cloud File Manager ini menggunakan PHP framework [Codeigniter](http://www.codeigniter.com) .

## Petunjuk Instalasi

1. Download file yang ada di repositori ini
2. Buat database MySQL dan konfigurasi file [database.php](application/config/database.php)
3. Buat tabel `users` dan `ci_sessions`

SQL script untuk tabel `users`:

    CREATE TABLE IF NOT EXISTS 'users' (
      'id' INT NOT NULL AUTO_INCREMENT,
      'username' VARCHAR(20) NOT NULL,
      'password' VARCHAR(128) NOT NULL,
      'date_created' TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
      'is_admin' INT(1) NOT NULL DEFAULT 0,
      PRIMARY KEY ('id'),
      UNIQUE KEY 'username_UNIQUE' ('username')
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

SQL script untuk tabel `track_record` :

    CREATE TABLE IF NOT EXISTS 'track_record' (
      'id' int(11) NOT NULL AUTO_INCREMENT,
      'user_id' int(11) NOT NULL,
      'type' varchar(45) NOT NULL,
      'action' varchar(45) NOT NULL,
      'content' varchar(128) DEFAULT NULL,
      'time' TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
      PRIMARY KEY ('id')
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

- [X] **USER FEATURES**
  - [X] Upload
  - [X] All extensions
  - [X] Sort by
  - [X] Personalize
- [X] **ADMIN FEATURES**
  - [X] Upload
  - [X] User management
  - [X] Configure
  - [X] Logs
- [ ] **BONUS**
  - [ ] Edit on the spot
  - [ ] File viewer
  - [ ] File sharing

