#! /bin/bash

PKG=pkg_`date "+%H%M%S_%d%m%Y"`.zip
zip -r -y ../pkg_`date "+%H%M%S_%d%m%Y"`.zip * -x CustomersImages\* BookimngImages\* VehicleImages\* public/CustomersImages public/VehicleImages public/BookimngImages .env
echo "pkg $PKG created successfully."
