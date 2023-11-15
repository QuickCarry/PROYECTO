#!/bin/bash

clear

#Empezamos limpiando las reglas ya existentes
iptables -F
iptables -X
iptables -Z
iptables -P INPUT DROP
iptables -P FORWARD DROP
iptables -P OUTPUT ACCEPT

#Permitir conexciones ssh
iptables -A INPUT -p tcp --dport 22 -j ACCEPT

#Permitir conexciones HTTP
iptables -A INPUT -p tcp --dport 80 -j ACCEPT

#Guardar las reglas en el archivo /etc/sysconfig/iptables
service iptables save
sleep 5
#activar el firewall y verifica si ocurrieron errores
if systemctl enable iptables && systemctl start iptables; then
	echo "Firewall configuirado y activado con exito"
	sleep 6
else
	echo "ERROR: se produjo un problema al activar el firewall"
	sleep 6
fi
