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

ADDRESS=$1
METHOD=$2
NETMASK=$3
NETWORK=$4 
BROADCAST=$5
GATEWAY=$6

ETH0_IFACE=`augtool match /files/etc/network/*/iface/ eth0`

if [ -n "$ETH0_IFACE" ];
then
    echo "Updating existing item"
    
if [ -n "$ADDRESS" ];
then

augtool <<-EOF
set $ETH0_IFACE/address "${ADDRESS}"
save
quit
EOF

else

augtool <<-EOF
rm $ETH0_IFACE/address
save
quit
EOF

fi

if [ -n "$METHOD" ];
then

augtool <<-EOF
set $ETH0_IFACE/method "${METHOD}"
save
quit
EOF

else

augtool <<-EOF
rm $ETH0_IFACE/method
save
quit
EOF

fi

if [ -n "$NETMASK" ];
then

augtool <<-EOF
set $ETH0_IFACE/netmask "${NETMASK}"
save
quit
EOF

else

augtool <<-EOF
rm $ETH0_IFACE/netmask
save
quit
EOF

fi

if [ -n "$NETWORK" ];
then
augtool <<-EOF
set $ETH0_IFACE/network "${NETWORK}"
save
quit
EOF

else

augtool <<-EOF
rm $ETH0_IFACE/network
save
quit
EOF

fi

if [ -n "$BROADCAST" ];
then
augtool <<-EOF
set $ETH0_IFACE/broadcast "${BROADCAST}"
save
quit
EOF

else

augtool <<-EOF
rm $ETH0_IFACE/broadcast
save
quit
EOF

fi

if [ -n "$GATEWAY" ];
then
augtool <<-EOF
set $ETH0_IFACE/gateway "${GATEWAY}"
save
quit
EOF

else

augtool <<-EOF
rm $ETH0_IFACE/gateway
save
quit
EOF

fi

else
    echo "ERROR ETH0 not found"
fi

exit 0
