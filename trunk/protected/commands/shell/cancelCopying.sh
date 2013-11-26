#!/bin/bash
if [ -z "$1" ]
then
	echo "No argument supplied"
	exit 1
fi

for i in $(ps aux|grep cp|grep "$1"|awk '{print $2}')
{
	kill $i
}
