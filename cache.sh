#!/bin/sh

[ "$DEBUG" = "true" ] && set -x

COMMAND="$@"

START=`date +%s`

# Fix here
chmod +x bin/magento
CMD_MAGENTO="php -dmemory_limit=-1 bin/magento"

echo "Running cache clean.."
$CMD_MAGENTO c:c

echo "Running cache flush.."
$CMD_MAGENTO c:f

echo "Give Permission to pub/static"
chmod -R 0777 pub/static/

echo "Give Permission to var and generated"
chmod -R 0777 var/ generated/

echo "Give Permission to pub/media"
chmod -R 0777 pub/media/

END=`date +%s`
RUNTIME=$((END-START))
echo "Startup preparation finished in ${RUNTIME} seconds"