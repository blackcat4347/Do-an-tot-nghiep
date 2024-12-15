sudo iptables -t mangle -I PREROUTING -d 172.17.0.2 -p tcp -m tcp -dport 80 -m u32 -u32 "6&0xFF=0x6 && 32&0xFFFF=0x16D0" -j DROP
