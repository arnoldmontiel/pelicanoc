#!/bin/bash 

if [ $# -ne 6 ]
  then
    echo "Invalid argumets"
    echo "Count: "$#
    exit 1
fi
echo "Params were"

echo address  =$1
echo method   =$2
echo netmask  =$3
echo network  =$4 
echo broadcast=$5
echo gateway  =$6

ADDRESS  =$1
METHOD   =$2
NETMASK  =$3
NETWORK  =$4 
BROADCAST=$5
GATEWAY  =$6

ETH0_IFACE=`augtool match /files/etc/network/*/iface/ eth0`

if [ -n "$ETH0_IFACE" ];
then
    echo "Updating existing item"
    
augtool <<-EOF
set $ETH0_IFACE/address "$ADDRESS"
set $ETH0_IFACE/method "$METHOD"
set $ETH0_IFACE/netmask "$NETMASK"
set $ETH0_IFACE/network "$NETWORK"
set $ETH0_IFACE/broadcast "$BROADCAST"
set $ETH0_IFACE/gateway "$GATEWAY"

save
quit
EOF

else
    echo "ERROR ETH0 not found"
fi

exit 0
