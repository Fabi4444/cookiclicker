#!/bin/bash
sudo killall python3
sudo killall php
nohup python3 -m http.server 8001 &
nohup sudo php -f index.php -S 192.168.1.228:80 &
