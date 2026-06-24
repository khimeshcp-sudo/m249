#!/bin/sh

#[ "$DEBUG" = "true" ] && set -eo pipefail
[ "$DEBUG" = "true" ] && set -x

COMMAND="$@"

START=`date +%s`

# ✅ Fix: apply chmod only to bin/magento
chmod +x bin/magento
CMD_MAGENTO="php -dmemory_limit=-1 bin/magento"

echo "Running compile.."
$CMD_MAGENTO setup:di:compile

END=`date +%s`
RUNTIME=$((END-START))
echo "Startup preparation finished in ${RUNTIME} seconds"