import platform
from subprocess import check_output
import re

listing = {}
file = open("mac_output.txt","w+")
if (platform.system() == "Linux"):
    print "Unsupported platform!"
elif platform.system() == "Darwin":
    ifconfig = check_output(["/System/Library/PrivateFrameworks/Apple80211.framework/Versions/Current/Resources/airport","-s"])
    words = ifconfig.split("\n")
    for x in range(1,len(words)):
            mac = re.search(r'(((.)+\s([0-9A-F]{2}[:-]){5}|([0-9A-F]{2}))+)', words[x], re.I)
            if mac is not None:
                mac_addr = mac.group().split()
                macList = []
                if mac_addr[0] in listing:
                    macList = listing.get(mac_addr[0])
                macList.append(mac_addr[1])
                listing.update({mac_addr[0] : macList})
                # file.write(mac_addr[1] + "\t\t\t" + mac_addr[0] + "\n")
    for key, value in listing.iteritems():
        file.write("===========" + key + "=========== \n")
        for x in value:
            file.write(x+"\n")
    file.truncate(file.tell()-1)
elif platform.system() == "Windows":
    ipconfig = check_output(["netsh", "wlan", "show", "networks", "mode=bssid"])
    words = ipconfig.split("\n")
    for x in range(len(words)):
        if "BSSID" in words[x].strip():
            mac = re.search(r'([0-9A-F]{2}[:-]){5}([0-9A-F]{2})', words[x], re.I).group()
            file.write(mac + "\n")
    file.truncate(file.tell()-2)
else:
    print "Unsupported platform!"

file.close()