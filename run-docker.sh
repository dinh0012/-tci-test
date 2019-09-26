#!/bin/bash
#DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
SCRIPT=`readlink -f $0`
DIR=`dirname $SCRIPT`
PROJECT_DIR="$(dirname $(dirname $DIR))"
DOCKER_FILES="-f docker-compose.yml"

cd $PROJECT_DIR/docker-poilerplate
# Create global network
docker network inspect docker-boilerplate &>/dev/null || docker network create --driver bridge docker-boilerplate

export PROJECT_DIR=$PROJECT_DIR
source "$DIR/env"

#run docker-compose
docker-compose $DOCKER_FILES $@
