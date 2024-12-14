#!/bin/bash
#server_ip="192.168.100.10"
log_file="ping_log.txt"
rm -f "$log_file"
> "$log_file"
sudo timeout 1 hping3 -1 -i u1000 192.168.100.10 > "$log_file" 2>&1

line_count=$(wc -l < "$log_file" | tr -d '[:space:]')

echo "received packets: $line_count"

if [ "$line_count" -lt 25 ]; then
        echo "success"
else
        echo "failed"
fi

rm -f "$log_file"
