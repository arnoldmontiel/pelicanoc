#!/bin/bash
if [[ ! ("$#" =~ 4 ) ]]; then
    echo 'bad parameters';
    exit 1
fi

PORT_FROM=$1
PORT_TO=$2
SERVER=$3
USER=$4
echo "openning port: "$PORT_FROM" TO: "$PORT_TO;
ssh -oStrictHostKeyChecking=no -fN -R $SERVER:$PORT_FROM:127.0.0.1:$PORT_TO $USER@$SERVER
exit 0;
