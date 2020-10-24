# Storage 
It's simple File Transfer over HTTP

### Requirements
* PHP
* Web Server


### Docker Build
Build with docker
Open command line in root of project (Where Dockerfile is)
```
docker build --tag storage:latest .
```
Then run container from that image with volumen so everything is saved in some shared folder 
```
docker run -d -p 8080:80 -v your_folder_for_storage:/var/www/storage --name storage-1 storage
```


