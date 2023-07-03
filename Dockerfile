FROM php:latest

COPY prac.php /var/www/html/prac.php
COPY interface.php /var/www/html/interface.php
COPY trait.php /var/www/html/trait.php

WORKDIR /var/www/html

CMD ["php", "prac.php"]
