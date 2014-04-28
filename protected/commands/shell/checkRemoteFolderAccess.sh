#!/bin/bash

server = $1
path = $2

if ssh server test -d path;then
	echo "The directory exists so moving on"
else
	echo "The directory was not found"
fi
