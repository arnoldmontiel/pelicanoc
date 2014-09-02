#!/bin/bash 

ETH0_IFACE=`augtool match /files/etc/network/*/iface/ eth0`

if [ -n "$ETH0_IFACE" ];
then
    echo "eth0 found"
else
	echo "looking for em1"
	ETH0_IFACE=`augtool match /files/etc/network/*/iface/ em1`
fi


if [ -n "$ETH0_IFACE" ];
then    
	echo `augtool match ${ETH0_IFACE}/address`
	echo `augtool match ${ETH0_IFACE}/method`
	echo `augtool match ${ETH0_IFACE}/netmask`
	echo `augtool match ${ETH0_IFACE}/network`
	echo `augtool match ${ETH0_IFACE}/broadcast`
	echo `augtool match ${ETH0_IFACE}/gateway`
	echo `augtool match ${ETH0_IFACE}/dns-nameservers`	
fi

exit 0
