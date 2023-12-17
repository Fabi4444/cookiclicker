#!/bin/bash
sudo killall python3
sudo killall php
python3 -m http.server 8001 &
sudo php -f index.php -S 192.168.1.228:80 &
