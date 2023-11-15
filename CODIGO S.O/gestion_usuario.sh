#!/bin/bash
function pedir_datos(){
	read -p "Ingrese nombre de usuario: " usuario
	read -p "Ingrese la contraseña: " pass1
	read -p "Repita la contraseña: " pass2
}
function validar_pass(){
	if [ $1 == $2 ]; then
		return 0
	else
		return 1
	fi
}
function cambiar_pass(){
	usermod -p $1 $2
	echo "ERROR>:  $?"
}
function crear_usuario(){
	useradd $1
	cambiar_pass $2 $1
}

op=0
while [ $op -ne 4 ]
do
	clear
	echo "Alta usuario - 1"
	echo "Eliminar usuario - 2"
	echo "Modificar usuario - 3"
	echo "Salir - 4"
	echo ""
	read -p "¿Que quiere hacer?: " op
	case $op in
		1)
			clear
			pedir_datos
			validar_pass $pass1 $pass2; validado=$?
			if [ $validado -eq 0 ]; then
				crear_usuario $usuario $pass
			else
				echo "Error. Las contraseñas no coinciden."
			fi
		;;
		2)
			clear
			read -p "Que usuario decea eliminar: " usuario
			userdel -r $usuario
		;;
	esac
done
