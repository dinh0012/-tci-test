#Initialize PHP-CI

./initialize.sh

#Run Docker

./run-docker.sh up

#Run check code
docker exec -it sh -c "make check"

#Run test 
docker exec -it sh -c "make test"
