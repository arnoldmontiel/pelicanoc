#!/bin/bash
echo " ---------------------- "
echo " Instalando Pelicano    "
echo " ---------------------- "
apt-get update
apt-get --yes --force-yes install php5-curl usbmount sabnzbdplus make gcc openssh-client p7zip-full fping libaugeas-ruby augeas-tools
#chown -R www-data.www-data /var/www
#cd /var/www
cd /opt/
echo " ---------------------- "
echo " Descargando Pelicano   "
echo " ---------------------- "
wget gruposmartliving.com/downloads/pelicano-beta.tar.gz
tar xvfz pelicano-beta.tar.gz
chown -R www-data.www-data *
rm pelicano-beta.tar.gz
chmod +x pelicano/protected/commands/shell/*
chmod 777 pelicano/protected/commands/shell
chmod 777 pelicano/nzbReady
chmod +x pelicano/protected/yiic
rm /var/www/index.html
ln -l /opt/pelicano /var/www/pelicano
ln -l /opt/yii /var/www/yii
chown -R www-data.www-data /var/www/*
echo " ---------------------------- "
echo " Configurando Base De Datos   "
echo " ---------------------------- "
mysql -uroot -ppelicano -e "GRANT ALL ON *.* to pelicano@localhost IDENTIFIED BY 'pelicano';"; 
mysql -uroot -ppelicano -e "source /var/www/pelicano/protected/data/PelicanoC-VIRGEN.sql;";
echo " ---------------------- "
echo " Configurando ambiente  "
echo " ---------------------- "

cd pelicano
cp protected/config/usbmount.conf /etc/usbmount/
cp protected/config/zpelicano.rules /etc/udev/rules.d/.
cp protected/config/default /etc/apache2/sites-available/.

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
#dpkg -i virtualbox-4.3_4.3.12-93733~Ubuntu~precise_amd64.deb
#apt-get  --yes --force-yes -f install
#wget http://download.virtualbox.org/virtualbox/4.3.12/Oracle_VM_VirtualBox_Extension_Pack-4.3.12-93733.vbox-extpack
#VBoxManage extpack install Oracle_VM_VirtualBox_Extension_Pack-4.3.12-93733.vbox-extpack
#echo VBOXWEB_USER=pelicano> /etc/default/virtualbox
echo "GRUB_RECORDFAIL_TIMEOUT=2" >> /etc/default/grub
update-grub
mkdir /media/NAS

cp /var/www/pelicano/protected/config/visudo.tmp /etc/sudoers

cp /var/www/pelicano/protected/config/sabnzbdplus /etc/default/sabnzbdplus
service sabnzbdplus start 
echo " ---------------------- "
echo " Creando ssh key "
echo " ---------------------- "

sudo -u pelicano ssh-keygen -f /home/pelicano/.ssh/id_rsa -N ""

echo " ---------------------- "
echo " Instalacion finalizada "
echo " ---------------------- "
cat /home/pelicano/.sabnzbd/sabnzbd.ini|grep "api_key" |grep -v "disable"
echo " Que lo disfrutes "
exit $?