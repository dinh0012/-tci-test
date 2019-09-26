echo ">>>>>>>>>>>>>>> Build Docker image from dockerfile <<<<<<<<<<<<<<"
DIR=$(cd $(dirname $0); pwd)
BASE_DIR="$DIR"
cd $BASE_DIR
sudo docker build -t source-code .
