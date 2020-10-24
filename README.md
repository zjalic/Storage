# Storage 
It's simple Storage Server(File Transfer over HTTP)

## Requirements
* PHP 7
* Web Server

Or simply XAMPP


## PHP Settings
Since there is limitations for upload size,post size and some other stuff.\
It would be good to set value as you wish

* php.ini
  * upload_max_filesize
  * post_max_size
  * max_input_time
  * max_execution_time

This version dont support changing within app, but soon maybe will.\
If you want to implement use [.user.ini](https://www.php.net/configuration.file.per-user) for PHP 5.3+, otherwise use [ini_set](https://www.php.net/manual/en/function.ini-set.php)


## Docker Build
Build with docker.\
Open command line in root of project
```
docker build --tag storage:latest .
```
Then run container from that image with volumen so everything is saved in some shared folder 
```
docker run -d -p 8080:80 -v your_folder_for_storage:/var/www/storage --name storage-1 storage
```
Docker repo coming soon (maybe)

