

### **1. Install Apache on Ubuntu**
Run the following command to install Apache:
```bash
sudo apt install apache2 -y
```

Start and enable Apache:
```bash
sudo systemctl enable apache2
sudo systemctl start apache2
```

Verify Apache is running:
```bash
sudo systemctl status apache2
```

---

### **2. Install PHP on Ubuntu**
Install PHP and required modules:
```bash
sudo apt install php libapache2-mod-php php-cli php-mysql -y
```

Verify PHP version:
```bash
php -v
```

Restart Apache:
```bash
sudo systemctl restart apache2
```

Test PHP by creating a file:
```bash
echo "<?php phpinfo(); ?>" | sudo tee /var/www/html/info.php
```
Visit `http://localhost/info.php` in your browser to check PHP info.

---

### **3. Install Composer on Ubuntu**
Install required dependencies:
```bash
sudo apt update
sudo apt install curl unzip -y
```

Download and install Composer:
```bash
curl -sS https://getcomposer.org/installer | php
```

Move Composer to a globally accessible directory:
```bash
sudo mv composer.phar /usr/local/bin/composer
```

Verify Composer installation:
```bash
composer -V
```

---

### **4. Apache Permission Issue**
If you encounter the error:
```
Permission denied: access to / denied (filesystem path '/home/ubuntu/www') because search permissions are missing on a component of the path
```
Fix it by adjusting the directory permissions:
```bash
sudo chown -R www-data:www-data /home/ubuntu/www
sudo chmod -R 755 /home/ubuntu/www
```

Also, ensure that the `/home/ubuntu` directory has execute permissions:
```bash
sudo chmod +x /home/ubuntu
```

---

### **5. Enable `mod_rewrite` for `.htaccess`**
If you get an error like:
```
Invalid command 'RewriteEngine', perhaps misspelled or defined by a module not included in the server configuration
```
Enable `mod_rewrite`:
```bash
sudo a2enmod rewrite
```

Edit the VirtualHost file (typically `/etc/apache2/sites-available/000-default.conf`):
```bash
sudo nano /etc/apache2/sites-available/000-default.conf
```

Ensure the `<Directory>` block is configured like this:
```apache
<Directory /home/ubuntu/www>
    AllowOverride All
    Require all granted
</Directory>
```

Restart Apache:
```bash
sudo systemctl restart apache2
```

---

### **6. Check Apache Logs**
If problems persist, check Apache’s error logs for more details:
```bash
sudo tail -f /var/log/apache2/error.log
```