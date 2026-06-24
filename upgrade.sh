#!/bin/sh

[ "$DEBUG" = "true" ] && set -x

COMMAND="$@"

START=`date +%s`

# Fix here
chmod +x bin/magento
CMD_MAGENTO="php -dmemory_limit=-1 bin/magento"

echo "Running upgrade.."
$CMD_MAGENTO setup:upgrade

END=`date +%s`
RUNTIME=$((END-START))
echo "Startup preparation finished in ${RUNTIME} seconds"