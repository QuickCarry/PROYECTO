#!/bin/bash

usuarios="/etc/passwd"
contrasenias="/etc/shadow"
grupos="/etc/group"
centro_computo="operador_computo.sh"
gestion_usuarios="gestion_usuario.sh"
respaldo="respaldo.sh"
DC="~/docker_compose/docker-compose.yml"

destino="/opt/destino"
destinoDC="/opt/docker-compose"

fecha=$(date +%Y%m%d)
carpeta_respaldo="$destino/respaldo_$fecha"
carpeta_respaldo_docker_compose="$destinoDC$fecha"

mkdir -p "$carpeta_respaldo"
mkdir -p "$carpeta_respaldo_docker_compose"

rsync -av "$usuarios" "$carpeta_respaldo" #copia del archivo de usuarios
rsync -av "$contrasenias" "$carpeta_respaldo" #copia del archivo de las contraseñas
rsync -av "$grupos" "$carpeta_respaldo" #copia del archivo de los grupos
rsync -av "$centro_computo" "$carpeta_respaldo" #copia del centro de computo
rsync -av "$respaldo" "$carpeta_respaldo" #copia del script de respaldo
rsync -av "$gestion_usuarios" "$carpeta_respaldo" #copia del script de gestion de usuarios
rsync -av "$DC" "$carpeta_respaldo_docker_compose" #copia del archivo docker compose


echo "Copia de seguridad completada en $carpeta_respaldo"
