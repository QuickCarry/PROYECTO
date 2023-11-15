#!/bin/bash

clear

yum -y install openssh-server
usuario_remoto="root"
servidor_remoto="192.168.1.89"
clave_privada="/root/.ssh/id_rsa"

if [ -n "$clave_privada" ]; then
	echo "la clave es 'root'"
	ssh -i "$clave_privada" "$usuario_remoto@$servidor_remoto"
else
	echo "la clave es 'root'"
	ssh "$usuario_remoto@$servidor_remoto"
fi
