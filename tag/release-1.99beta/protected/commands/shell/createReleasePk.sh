#!/bin/bash
echo " ---------------------- "
echo " Creando version ${1}   "
echo " ---------------------- "

VERSION=${1}

rm -rf release-${1}
svn checkout http://pelicanoc.googlecode.com/svn/tag/release-${1} release-${1}
if [ "$?" -eq 0 ]
then
  rm -rf pelicano-${1}
  mkdir pelicano-${1}
  mkdir pelicano-${1}/pelicano
  cp -rp release-${1}/* pelicano-${1}/pelicano/.
  cp -rp pelicano-${1}/pelicano/offline/* pelicano-${1}/.
  cd pelicano-${1}
  tar cvfz pelicano-${1}.tar.gz * 
  ssh gruposmartliving.com "rm pelicano-${1}.tar.gz"
  scp pelicano-${1}.tar.gz gruposmartliving.com:

else
  echo "error descargando version ${1}"
fi

exit $?
