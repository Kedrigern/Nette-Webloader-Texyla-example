#!/bin/bash
# author: Ondřej Profant

www="../www/"
webtemp="${www}webtemp/"

if ! cp TwitterControl/client-side/TwitterControl-sprite.png $webtemp ; then
    echo "[fail] twitter images";
fi;

if ! cp -r Bootstrap/img/ $www ; then
    echo "[fail] bootstrap images";
fi;

if [ ! -d ${www}/texyla ]; then
    echo "[fail] texyla dir doesnt exists";
fi;
