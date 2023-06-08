#! /bin/bash

PKG=pkg_`date "+%H%M%S_%d%m%Y"`.zip
zip -r ../${PKG} *
echo "pkg $PKG created successfully."
