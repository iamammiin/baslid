#!/bin/bash

touch /var/log/supervisord/schedule_date.log
cd /var/www/
while true; do
    sleep 60
    echo `date` >> /var/log/supervisord/schedule_date.log
    php artisan schedule:run
done
