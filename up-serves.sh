#!/bin/bash

# Deploy projeto front ambiente de desenvolvimento
function echoSuccess ()
{
    MSG=$1
    BG_GREEN="\e[42m"
    BG_DEFAULT="\e[49m"
    GREEN="\e[32m"
    RESET="\e[0m"
    echo -e "\n$BG_GREEN SUCESSO $BG_DEFAULT $GREEN $MSG $RESET"
}

function echoError ()
{
    MSG=$1
    BG_RED="\e[41m"
    BG_DEFAULT="\e[49m"
    RED="\e[31m"
    RESET="\e[0m"
    echo -e "\n$BG_RED ERRO $BG_DEFAULT $RED $MSG $RESET"
}

function echoInfo ()
{
    MSG=$1
    BG_CYAN="\e[46m"
    BG_DEFAULT="\e[49m"
    CYAN="\e[36m"
    RESET="\e[0m"
    echo -e "\n$BG_CYAN INFO $BG_DEFAULT $CYAN $MSG $RESET"
}

echoInfo "1 - INICIA SERVE FRONT"
cd front
'C:\Program Files\Git\git-bash.exe'

# echoInfo "1 - INICIA SERVE BACK"
# cd ..
# cd back
# 'C:\Program Files\Git\git-bash.exe'
# php artisan serve


echoSuccess "FIM!!"