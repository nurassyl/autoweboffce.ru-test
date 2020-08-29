Upgrade system

```bash
sudo apt-get update
sudo apt-get upgrade -y
```


Install htop, git, tmux, vim

```bash
sudo apt-get install -y htop git tmux vim
```


Install tmux

```bash
./tmux_init.sh && source ~/.bashrc
```


Configure GIT

```bash
cp -f .gitconfig ~/.gitconfig
```


Install PHP v7.3

```bash
sudo add-apt-repository ppa:ondrej/php -y
sudo apt-get update
sudo apt-get install -y php7.3
```


Install PHP extensions

```bash
sudo apt-get install -y php7.3-dev php7.3-mbstring php7.3-ctype php7.3-bcmath php7.3-tokenizer php7.3-json php7.3-xml php7.3-opcache php7.3-pdo php7.3-mysql php7.3-intl php7.3-curl php7.3-zip php7.3-xdebug php7.3-memcached php7.3-gettext php7.3-gd php7.3-imagick php7.3-iconv php7.3-fpm php7.3-dom php7.3-xmlrpc
```


Configure PHP

```bash
sudo cp -f php.ini /etc/php/7.3/cli/php.ini
```


Install MySQL v5.7

```bash
sudo apt-get install -y mysql-server
```


Configure MySQL server

```bash
sudo cp -f mysql-conf/mysqld.cnf /etc/mysql/mysql.conf.d/mysqld.cnf
sudo /etc/init.d/mysql restart
```


Set '12345' password for 'root' user.

```bash
sudo mysql_secure_installation
```


MySQL: Create user

```bash
mysql> CREATE USER 'nurassyl'@'localhost' IDENTIFIED BY '12345';
mysql> GRANT ALL PRIVILEGES ON * . * TO 'nurassyl'@'localhost';
mysql> FLUSH PRIVILEGES;
```


MySQL: Create database

```bash
mysql> CREATE DATABASE mydb;
```


Install Apache2 v2.4

```bash
sudo apt-get install -y apache2
```


Install Apache2 mods

```bash
sudo apt install -y libapache2-mod-fcgid
```


Configure Apache2

```bash
sudo cp -f apache2-conf/apache2.conf /etc/apache2/
sudo cp -f apache2-conf/000-default.conf /etc/apache2/sites-available/
sudo cp -f php.ini /etc/php/7.3/apache2/
sudo cp -f php.ini /etc/php/7.3/fpm/
sudo a2dismod php7.3
sudo a2enmod proxy_fcgi setenvif
sudo a2enconf php7.3-fpm
sudo a2enmod fcgid
sudo a2enmod rewrite
sudo service php7.3-fpm restart
sudo systemctl restart apache2
```


Configure app

```bash
vim config/
```


Set APP env

```bash
cp -f env.development.json env.json # for development
cp -f env.production.json env.json # for production
```


Seed the database (admin password is 'admin1234567890')

```bash
php seed.php
```


Which MPM model Apache is running (event, worker, prefork)

```bash
apachectl -V | grep -i mpm # should return 'Server MPM: prefork'
```


View the MySQL all queries log (recommended in development mode)

```bash
sudo bash -c 'echo -e "[mysqld]\ngeneral_log = on\ngeneral_log_file=/tmp/mysql_quires.log" >> /etc/mysql/my.cnf'
sudo /etc/init.d/mysql restart
sudo tail -f /tmp/mysql_quires.log
```

