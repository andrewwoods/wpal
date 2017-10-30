#!/bin/bash

standard_install_dir=`pwd`

plugins_dir=$(dirname $standard_install_dir)
wp_content_dir=$(dirname $plugins_dir)
mu_plugins_dir="${wp_content_dir}/mu-plugins"

if [ -d $mu_plugins_dir ]; then
	echo "mu-plugins directory Exists! ${mu_plugins_dir}"
	# do stuff
else
	echo "Creating mu-plugins directory ${mu_plugins_dir}"
	mkdir $mu_plugins_dir
fi

echo "move autoloader.php to ${mu_plugins_dir}"
mv autoloader.php $mu_plugins_dir

echo "move ${standard_install_dir} to ${mu_plugins_dir}"
mv $standard_install_dir $mu_plugins_dir

