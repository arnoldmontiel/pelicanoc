#!/bin/bash
echo " ---------------------- "
echo " Instalando Pelicano    "
echo " ---------------------- "
if [ $# -ne 1 ]
  then
    echo "Invalid argumets"
    echo "Count: "$#
    echo "Usage: "
    echo "sudo install.sh [ID]"
    exit 1
fi

ID=$1
PASS=`curl -s "domasolutions.com/pelicanos/index.php?r=site/installpass&Id=${ID}"`
#MYSQLPASS=`curl -s "domasolutions.com/pelicanos/index.php?r=site/mysqlpass&Id=${ID}"`
if [ -n "$PASS" ];
then
    echo "ID correcto"
    INDEX=0;
    for i in $(echo $PASS | tr ";" "\n")
	do
		case $INDEX in
			0) MYSQLPASS=$i;;
			1) OSPASS=$i;;
			2) LUKSPASS=$i;;
			*) echo "INVALID NUMBER!" ;;
		esac  		
  		((INDEX++))
	done
else
	echo "Error al obtener datos o Id incorrecto"
	exit 1    
fi

SAFE_PETTERN=$(printf '%s\n' "${MYSQLPASS}" | sed 's/[[\.*^$(){}?+|/&!]/\\&/g')

rm -rf /var/lib/apt/lists/*
apt-get update
#ubuntu 14.04
#sed -i "s/\/var\/www\/html/\/var\/www/g" /etc/apache2/sites-available/000-default.conf

#antes para virtual box
#apt-get --yes --force-yes install php5-curl usbmount sabnzbdplus make gcc openssh-client p7zip-full fping libaugeas-ruby augeas-tools
apt-get --yes --force-yes install php5-curl usbmount sabnzbdplus openssh-client p7zip-full fping libaugeas-ruby augeas-tools
cd /opt/
echo " ---------------------- "
echo " Descargando Pelicano   "
echo " ---------------------- "
wget domasolutions.com/downloads/pelicano-beta.tar.gz
tar xvfz pelicano-beta.tar.gz
chown -R www-data.www-data *
rm pelicano-beta.tar.gz
echo ${MYSQLPASS}>pelicano/protected/config/pwd

chmod +x pelicano/protected/commands/shell/*
chmod 777 pelicano/protected/commands/shell
chmod 777 pelicano/nzbReady
chmod +x pelicano/protected/yiic
#por seguridad
chown root.root pelicano/protected/commands/shell/fstabEditor.sh
chown root.root pelicano/protected/commands/shell/startDownload.sh
chown root.root pelicano/protected/commands/shell/heartBeat.sh
chown root.root pelicano/protected/commands/shell/update.sh
chown root.root pelicano/protected/commands/shell/install.sh
chown root.root pelicano/protected/commands/shell/startDecrypt
chmod 700 pelicano/protected/commands/shell/fstabEditor.sh
chmod 700 pelicano/protected/commands/shell/startDownload.sh
chmod 700 pelicano/protected/commands/shell/heartBeat.sh
chmod 700 pelicano/protected/commands/shell/update.sh
chmod 700 pelicano/protected/commands/shell/install.sh
chmod 700 pelicano/protected/commands/shell/startDecrypt
chown root.root pelicano/protected/config/pwd
chmod 600 pelicano/protected/config/pwd
cp *.* /var/www/.

ln -s /opt/pelicano /var/www/pelicano
ln -s /opt/yii /var/www/yii
chown -R www-data.www-data /var/www/*

rm /var/www/index.html
#ubuntu 14.04
#rm -rf /var/www/html
rm /media/usb
echo " ---------------------------- "
echo " Configurando Base De Datos   "
echo " ---------------------------- "

mysql -uroot -ppelicano -e "GRANT ALL ON *.* to pelicano@localhost IDENTIFIED BY '${MYSQLPASS}';"; 
mysql -uroot -ppelicano -e "source /var/www/pelicano/protected/data/PelicanoC-VIRGEN.sql;";
mysql -uroot -ppelicano -e "drop database test;";
mysql -uroot -ppelicano -e "use mysql; DELETE FROM user WHERE user=''; flush privileges;";
mysqladmin -u root -ppelicano password ${MYSQLPASS}
mysql -uroot -p${MYSQLPASS} -e "UPDATE mysql.user set user = 'peliroot' where user = 'root'; flush privileges;";

sed -i "s/placeholderpass/${SAFE_PETTERN}/g" /var/www/pelicano/protected/config/main.php
sed -i "s/placeholderpass/${SAFE_PETTERN}/g" /var/www/pelicano/protected/config/console.php

echo " ---------------------- "
echo " Configurando ambiente  "
echo " ---------------------- "

cd pelicano
cp protected/config/usbmount.conf /etc/usbmount/
cp protected/config/zpelicano.rules /etc/udev/rules.d/.
cp protected/config/default /etc/apache2/sites-available/.

#startup section
mkdir /etc/startDecrypt
echo "url=domasolutions.com">/etc/startDecrypt/startDecrypt.conf
echo "id=${ID}">>/etc/startDecrypt/startDecrypt.conf
cp protected/commands/shell/startDecrypt /etc/init.d/
update-rc.d startDecrypt defaults 99 20

FSTAB_MOUNTED=`augtool match /files/etc/fstab/*/file /opt`
if [ -n "$FSTAB_MOUNTED" ];
then
augtool <<-EOF
rm /files/etc/fstab/*[file = "/opt"]/
save
quit
EOF

fi

CRYPTTAB=`augtool match /files/etc/crypttab/*/file pelis-opt_crypt`
if [ -n "$CRYPTTAB" ];
then
augtool <<-EOF
rm /files/etc/crypttab/*[target = "pelis-opt_crypt"]/
save
quit
EOF

fi

#end startup section

crontab -u pelicano -l > pelicanoCrontab
echo "*/1 * * * * /var/www/pelicano/protected/commands/shell/openConnections.sh">>pelicanoCrontab
crontab -u pelicano pelicanoCrontab
rm pelicanoCrontab

crontab -u root -l > rootCrontab
echo "*/10 * * * * /var/www/pelicano/protected/commands/shell/heartBeat.sh">>rootCrontab
echo "*/30 * * * * /var/www/pelicano/protected/commands/shell/update.sh">>rootCrontab
crontab -u root rootCrontab
rm rootCrontab

#echo " ---------------------- "
#echo " Instalando Virtual Box   "
#echo " ---------------------- "

#wget http://download.virtualbox.org/virtualbox/4.3.12/virtualbox-4.3_4.3.12-93733~Ubuntu~precise_amd64.deb
#wget http://download.virtualbox.org/virtualbox/4.3.14/virtualbox-4.3_4.3.14-95030~Ubuntu~precise_amd64.deb
#dpkg -i virtualbox-4.3_4.3.12-93733~Ubuntu~precise_amd64.deb
#apt-get  --yes --force-yes -f install
#wget http://download.virtualbox.org/virtualbox/4.3.12/Oracle_VM_VirtualBox_Extension_Pack-4.3.12-93733.vbox-extpack
#wget http://download.virtualbox.org/virtualbox/4.3.14/Oracle_VM_VirtualBox_Extension_Pack-4.3.14-95030.vbox-extpack
#VBoxManage extpack install Oracle_VM_VirtualBox_Extension_Pack-4.3.12-93733.vbox-extpack
#wget http://sourceforge.net/projects/phpvirtualbox/files/phpvirtualbox-4.3-1.zip
#echo VBOXWEB_USER=pelicano> /etc/default/virtualbox
echo "GRUB_RECORDFAIL_TIMEOUT=2" >> /etc/default/grub
#ubuntu 14.04
#sed -i "s/quick_boot=\"1\"/quick_boot=\"0\"/g" /etc/grub.d/10_linux
update-grub
mkdir /media/NAS

cp /var/www/pelicano/protected/config/visudo.tmp /etc/sudoers

cp /var/www/pelicano/protected/config/sabnzbdplus /etc/default/sabnzbdplus
service sabnzbdplus start 
echo " ---------------------- "
echo " Creando ssh key "
echo " ---------------------- "

sudo -u pelicano ssh-keygen -f /home/pelicano/.ssh/id_rsa -N ""

echo "pelicano:${OSPASS}" | chpasswd

echo -e pelicano\\n${LUKSPASS}\\n${LUKSPASS}|cryptsetup luksAddKey /dev/mapper/pelis-opt

echo -e pelicano|cryptsetup luksRemoveKey /dev/mapper/pelis-opt

echo " ---------------------- "
echo " Instalacion finalizada "
echo " ---------------------- "
cat /home/pelicano/.sabnzbd/sabnzbd.ini|grep "api_key" |grep -v "disable"
echo " Que lo disfrutes "
exit $?