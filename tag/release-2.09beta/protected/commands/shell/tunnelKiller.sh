#!/bin/bash

if [[ ! ("$#" =~ 1 ) ]]; then 
    echo 'bad parameters';
    exit 1
fi

PORT=$1

for KILLPID in `ps aux | ps -ef | grep ssh | grep 'fN' | grep $PORT |grep -v grep | grep -v sshd | awk ' { print $2;}'`; do 
  echo "killing: "$KILLPID;
  kill $KILLPID;
done

exit 0;
