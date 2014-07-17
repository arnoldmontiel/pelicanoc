#!/bin/bash
if [ "$ACTION" = "add" ]
then
    if [ "$DEVNAME" != "" ]
    #DEVNAME_FAKE="/dev/sdb1"
    then
      for i in $(mount|grep $DEVNAME|awk '{print $3}')
      {
	USBPATH=$i
      }
      #echo $DEVNAME>>/home/arnold/usb_arnold.txt
      #echo $USBPATH>>/home/arnold/usb_arnold.txt
      #echo $ID_FS_LABEL>>/home/arnold/usb_arnold.txt
      if [ "$USBPATH" != "" ]
      then
	if [ "$ID_FS_LABEL" != "" ]
	then
	  /var/www/pelicano/protected/yiic folder AddedExternalStorage --label=$ID_FS_LABEL --path=$USBPATH
	else
	  /var/www/pelicano/protected/yiic folder AddedExternalStorage --label=$ID_VENDOR --path=$USBPATH
	fi
      fi
    fi
fi

if [ "$ACTION" = "remove" ]
then
  /var/www/pelicano/protected/yiic folder RemovedExternalStorage
fi


