# Simple Cloud File Manager

Simple Cloud File Manager ini merupakan Tugas besar kelompok 1 calon kru ARC ITB divisi Web.
Simple Cloud File Manager ini menggunakan PHP framework [Codeigniter](http://www.codeigniter.com) .

## Petunjuk Instalasi

1. Download file yang ada di repositori ini
2. Isikan username dan password database server pada file [database.php](application/config/database.php)
2. Buat database MySQL dengan menjalankan file `database.sql`
3. Login sebagai user `admin` dengan password `admin` dan buka Admin Panel > Settings
4. Edit `Upload Path` dengan lokasi penyimpanan file

### Default User
* `admin` : `admin`
* `user` : `user`

## Server Requirements

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

