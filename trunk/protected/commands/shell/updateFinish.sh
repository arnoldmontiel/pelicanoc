#!/bin/bash
echo " ------------------------- "
echo " Terminando actualizacion  "
echo " ------------------------- "

chmod +x /var/www/pelicano/protected/commands/shell/*
chmod 777 /var/www/pelicano/protected/commands/shell
chmod 777 /var/www/pelicano/nzbReady
chmod +x /var/www/pelicano/protected/yiic
chown root.root /var/www/pelicano/protected/commands/shell/fstabEditor.sh
chown root.root /var/www/pelicano/protected/commands/shell/startDownload.sh
chown root.root /var/www/pelicano/protected/commands/shell/heartBeat.sh
chown root.root /var/www/pelicano/protected/commands/shell/update.sh
chown root.root /var/www/pelicano/protected/commands/shell/install.sh
chown root.root /var/www/pelicano/protected/commands/shell/startDecrypt
chmod 700 /var/www/pelicano/protected/commands/shell/fstabEditor.sh
chmod 700 /var/www/pelicano/protected/commands/shell/startDownload.sh
chmod 700 /var/www/pelicano/protected/commands/shell/heartBeat.sh
chmod 700 /var/www/pelicano/protected/commands/shell/update.sh
chmod 700 /var/www/pelicano/protected/commands/shell/install.sh
chmod 700 /var/www/pelicano/protected/commands/shell/startDecrypt
chown root.root /var/www/pelicano/protected/config/pwd
chmod 600 /var/www/pelicano/protected/config/pwd

exit $?
