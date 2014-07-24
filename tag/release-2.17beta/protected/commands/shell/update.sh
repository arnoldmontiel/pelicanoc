#!/bin/bash
echo " ---------------------- "
echo " Verificnado Version    "
echo " ---------------------- "

ONLINE_VERSION=`curl gruposmartliving.com/downloads/version`

CURRENT_VERSION=`mysql -upelicano -ppelicano --skip-column-names -e "select version from pelicanoc.setting"`

var=$(awk 'BEGIN{ print "'$CURRENT_VERSION'"<"'$ONLINE_VERSION'" }') 

echo Online Version  : $ONLINE_VERSION
echo Current version : $CURRENT_VERSION

if [ "$var" -eq 1 ]
then
        echo "Actualizando"
        rm pelicano-${ONLINE_VERSION}beta.tar.gz
        wget gruposmartliving.com/downloads/pelicano-${ONLINE_VERSION}beta.tar.gz
        tar xvfz pelicano-${ONLINE_VERSION}beta.tar.gz -C /var/www/
        mysql   --force -upelicano -ppelicano  < /var/www/pelicano/protected/data/update-${ONLINE_VERSION}.sql         
        chown -R www-data.www-data /var/www/*
        chmod +x /var/www/pelicano/protected/commands/shell/*
		chmod 777 /var/www/pelicano/protected/commands/shell
		chmod 777 /var/www/pelicano/nzbReady
		chmod +x /var/www/pelicano/protected/yiic
        /var/www/pelicano/protected/commands/shell/updateFinish.sh
else
        echo "Ultima version instalada"
fi

echo "Ultima version ha sido instalada"

exit $?
