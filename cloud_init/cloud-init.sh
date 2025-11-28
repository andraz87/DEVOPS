#!/bin/bash

vmname="primary"

output=$(multipass list | grep "^$vmname ")

if [[ $output == *"$vmname"* ]]; then
  echo VM "$vmname" exists. starting...
  multipass start "$vmname"
  multipass info | grep IPv4
else
  echo VM "$vmname" does not exist. launching...
  multipass launch \
	--cloud-init /home/mversnjak/DEVOPS/cloud_init/user-data.yaml \
	--name "$vmname" &&
  multipass transfer -r /home/mversnjak/DEVOPS/app/ "$vmname":/home/ubuntu/app &&
  multipass exec "$vmname" -- sudo mv /home/ubuntu/app /var/www/html/sport-app &&
  multipass exec "$vmname" -- bash -c "cat /var/www/html/sport-app/sql/db.sql | sudo mysql" &&
  multipass info | grep IPv4
fi
