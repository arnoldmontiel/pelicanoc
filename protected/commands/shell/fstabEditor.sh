#!/bin/bash 
#FSTAB_MOUNTED=`augtool match /files/etc/fstab/*/spec '//192.168.0.105/storage/pelicano'`
#$1 spect
#$2 file
#$3 username
#$4 password

if [ $# -ne 4 ]
  then
    echo "Invalid argumets"
    echo "Count: "$#
    exit 1
fi
echo "Params were"

echo spect   =$1
echo file    =$2
echo username=$3
echo password=$4 

FSTAB_MOUNTED=`augtool match /files/etc/fstab/*/spec ${1}`

if [ -n "$FSTAB_MOUNTED" ];
then
    echo "Updating existing item"
    
augtool <<-EOF
set /files/etc/fstab/*[spec = "$1"]/spec "$1"
set /files/etc/fstab/*[spec = "$1"]/file "$2"
set /files/etc/fstab/*[spec = "$1"]/vfstype  "cifs"
set /files/etc/fstab/*[spec = "$1"]/opt[1] "password"
set /files/etc/fstab/*[spec = "$1"]/opt[1]/value "$4"
set /files/etc/fstab/*[spec = "$1"]/opt[2] "username"
set /files/etc/fstab/*[spec = "$1"]/opt[2]/value "$3"
set /files/etc/fstab/*[spec = "$1"]/opt[3] "uid"
set /files/etc/fstab/*[spec = "$1"]/opt[3]/value "www-data"
set /files/etc/fstab/*[spec = "$1"]/opt[4] "gid"
set /files/etc/fstab/*[spec = "$1"]/opt[4]/value "www-data"
set /files/etc/fstab/*[spec = "$1"]/dump "0"
set /files/etc/fstab/*[spec = "$1"]/passno "0"
save
quit
EOF

else
    echo "Creating new item"
#esto esta identado, de otro modo no funciona.
augtool <<-EOF
set /files/etc/fstab/01/spec "$1"
set /files/etc/fstab/01/file "$2"
set /files/etc/fstab/01/vfstype  "cifs"
set /files/etc/fstab/01/opt[1] "password"
set /files/etc/fstab/01/opt[1]/value "$4"
set /files/etc/fstab/01/opt[2] "username"
set /files/etc/fstab/01/opt[2]/value "$3"
set /files/etc/fstab/01/opt[3] "uid"
set /files/etc/fstab/01/opt[3]/value "www-data"
set /files/etc/fstab/01/opt[4] "gid"
set /files/etc/fstab/01/opt[4]/value "www-data"
set /files/etc/fstab/01/dump "0"
set /files/etc/fstab/01/passno "0"
save
quit
EOF

fi

exit 0
