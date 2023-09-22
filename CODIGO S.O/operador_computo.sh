#!/bin/bash
opcion=0
while [ $opcion -ne 6 ]
do
	clear
	echo "------------- MENU ----------------"
	echo "Gestion de usuarios - 1"
	echo "Respaldo - 2"
	echo "Log - 3"
	echo "Conexión - 4"
	echo "Generar el firewall en el servidor - 5"
	echo "Salir - 6"
	echo ""
	read -p "ingrese su opcion: " opcion

	case $opcion in
		1)
			bash gestion_usuario.sh
			sleep 1
			;;
	
		2)
			bash respaldo.sh
			sleep 1
			;;
		3)
			bash logs.sh
			sleep 1
			;;
		4)
			bash ssh.sh
			;;
		5)
			bash firewall.sh
			;;
		*)
			echo "Ingrese una opcion correcta por favor."
			;;
	esac
done
echo "Saliendo..."
sleep 1
exit
