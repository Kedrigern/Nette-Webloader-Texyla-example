#!/bin/bash
# author: Ondřej Profant

www="../www/"
webtemp="${www}webtemp/"

if ! cp ../vendor/smasty/TwitterControl/client-side/TwitterControl-sprite.png $webtemp ; then
    echo "[fail] twitter control images, do you run composer update?";
fi;

if ! cp -r ../libs/bootstrap/img/ $www ; then
    echo "[fail] bootstrap images";
fi;

if [ ! -d ${www}/texyla ]; then
    echo "[fail] texyla dir doesnt exists";
fi;

if [ ! -f ../libs