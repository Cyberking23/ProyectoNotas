#!/bin/bash

while true; do
  php /var/www/html/artisan reminders:send
  sleep 1
done
