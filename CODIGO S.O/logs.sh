#!/bin/bash
clear
opcion=0

while [ $opcion -ne 4 ]
do
	clear
	echo "--------------MENU------------"
	echo "Ver intentos de login exitosos - 1"
	echo "Ver intentos de login fallidos - 2"
	echo "Ver intentos de login reportados - 3"
	echo "Salir - 4"
	echo ""
	read -p "Seleccione una opcion: " opcion

	case $opcion in
		1)
			clear
			last
			sleep 5
			;;
		2)
			clear
			lastb
			sleep 5
			;;
	esac	
done
