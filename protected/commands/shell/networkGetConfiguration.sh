#!/bin/bash 

ETH0_IFACE=`augtool match /files/etc/network/*/iface/ eth0`

if [ -n "$ETH0_IFACE" ];
then    
	echo `augtool match ${ETH0_IFACE}/address`
	echo `augtool match ${ETH0_IFACE}/method`
	echo `augtool match ${ETH0_IFACE}/netmask`
	echo `augtool match ${ETH0_IFACE}/network`
	echo `augtool match ${ETH0_IFACE}/broadcast`
	echo `augtool match ${ETH0_IFACE}/gateway`
else
fi

exit 0
