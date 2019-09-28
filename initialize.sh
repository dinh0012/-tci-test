#!/bin/bash

echo "#### INIT FOR PHP-CI ############"
ln -s ./pre-push-hooks.sh .git/hooks/pre-push
docker exec -it source-code-tci sh -c "sh ../php-ci/bin/initialize.sh"
./ru