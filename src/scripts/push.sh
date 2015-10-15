#!/bin/bash

USER_KEY="723C516B5EDD7B6872C0C5B8C68ED0A7"
SERVER="http://localhost/ciconia/api/up/"

curl -F "k=$USER_KEY" -F "img=@$1" $SERVER
