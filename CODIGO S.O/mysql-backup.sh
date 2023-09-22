#/vim/bash

fecha=$(date +%Y%m%d)

mkdir -p "/opt/mysql/mysqlbackup/respaldo$fecha" #Crea la carpeta donde se almacenara el respaldo si no exite con la fecha al final.

tar -cvf "/opt/mysql/mysqlbackup/respaldo$fecha/respaldoBD" "/opt/mysql/SinerGync" #empaqueta la base de datos "SinerGync" y redirige a "/opt/mysql/mysqlbackup/respaldo(fecha)/respaldoBD"
