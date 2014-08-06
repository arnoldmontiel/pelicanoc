#!/bin/bash
echo " ------------------------- "
echo " Terminando actualizacion  "
echo " ------------------------- "

chown www-data.www-data /var/www/*

exit $?
