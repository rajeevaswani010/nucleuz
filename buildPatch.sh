#! /bin/bash

PKG=patch_`date "+%H%M%S_%d%m%Y"`.zip
zip -r -y ../patch_`date "+%H%M%S_%d%m%Y"`.zip app resources -x "*/.*"
echo "patch $PKG created successfully."
