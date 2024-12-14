sudo iptables -A INPUT -p icmp --icmp-type echo-request -m limit --limit 5/second --limit-burst 10 -j ACCEPT
sudo iptables -A INPUT -j DROP
