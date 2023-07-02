FROM php:latest
COPY prac.php /var/www/html/prac.php
WORKDIR /var/www/html

CMD ["php", "prac.php"]
