#!/bin/sh

# Get Mac Addresses, add missing 0s, only grab the first 8 characters, change to dashes and uppercase
arp -a | awk {'print toupper($4)'} | sed 's/^[0-9A-F]:/0&/g' | sed 's/:\([0-9A-F]\):/:0\1:/g' | cut -c 1-8 | sed 's/:/-/g' > mac.txt

for line in `cat mac.txt`
    do
    echo `grep $line manufacturers.txt`
done