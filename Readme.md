# 🐳 Docker + PHP 8.2 + MySQL + Nginx + Symfony UX 6.2 Skeleton

## Description
This is a complete stack for running Symfony UX 6.2 into Docker containers using docker-compose tool.

It is composed by 4 containers:
- `nginx`, acting as the webserver.
- `php`, the PHP-FPM container with the 8.2 version of PHP.
- `db` which is the MySQL database container with a **MySQL 8.0** image.

## Installation
1. Clone this repo.
2. If you are working with Docker Desktop for Mac, ensure **you have enabled `VirtioFS` for your sharing implementation**. `VirtioFS` brings improved I/O performance for operations on bind mounts. Enabling VirtioFS will automatically enable Virtualization framework.
3. Create the file `./.docker/.env.nginx.local` using `./.docker/.env.nginx` as template. The value of the variable `NGINX_BACKEND_DOMAIN` is the `server_name` used in NGINX. For example `NGINX_BACKEND_DOMAIN=symfony-ux.devel` — remember to add the domain to your `hosts` file.
4. Go inside folder `./docker` and run `docker-compose up -d` to start containers.
5. You should work inside the `php` container in order to run commands like `composer install` or `bin/console`. To do that, run `docker-compose exec php bash`.
6. Use the following value for the DATABASE_URL environment variable — you can find it in the `.env` file:
```
DATABASE_URL=mysql://app_user:helloworld@db:3306/app_db?serverVersion=8.0.33
```
7. Run `composer install` and then `bin/console doctrine:migrations:migrate` to create the database and the tables.
8. Run `yarn install` and then `yarn watch` to build the assets — stimulus, bootstrap, etc.
9. Open your browser and visit the `NGINX_BACKEND_DOMAIN` you have set in the `.env.nginx.local` file.
10. Enjoy! 🎉

## Linux's users having issues with file permissions
As you may know, Docker runs as root. So, if you are using Linux, you may have issues with file permissions. To avoid that, you can run the following command:

```
sudo chown -R $USER:$USER .
```