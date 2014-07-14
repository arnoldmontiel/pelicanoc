#!/bin/bash
echo " ---------------------- "
echo " Verificnado Version    "
echo " ---------------------- "
sudo -u www-data wget gruposmartliving.com/downloads/version
NLINE_VERSION=`cat version`
CURRENT_VERSION=`mysql -upelicano -ppelicano --skip-column-names -e "select version from pelicanoc.setting"`

if [ ONLINE_VERSION -gt  CURRENT_VERSION ]
then
        echo "Actualizando"
else
        echo "Ultima version instalada"
fi

exit $?