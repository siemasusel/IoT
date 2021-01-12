#!/bin/bash
mkdir /usr/iot
wget -O /usr/iot/entry_collector https://github.com/siemasusel/IoT/raw/master/app/bin/entry_collector
wget -O /usr/iot/entry_receiver https://github.com/siemasusel/IoT/raw/master/app/bin/entry_receiver
wget -O /etc/systemd/system/iot_collector.service https://raw.githubusercontent.com/siemasusel/IoT/master/systemd/iot_collector.service
wget -O /etc/systemd/system/iot_receiver.service https://raw.githubusercontent.com/siemasusel/IoT/master/systemd/iot_receiver.service
chmod 755 /usr/iot/entry_collector
chmod 755 /usr/iot/usr/iot/entry_receiver
systemctl start iot_collector
systemctl enable iot_collector
systemctl start iot_receiver
systemctl enable iot_receiver
