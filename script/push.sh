#!/bin/bash

USER_KEY="E352327A27D5DB103DDE280CC876FB1E"
SERVER="http://push.konosprod.fr/api/up/"

curl -A "Mozilla/5.0 (iPhone; U; CPU iPhone OS 4_3_3 like Mac OS X; en-us) AppleWebKit/533.17.9 (KHTML, like Gecko) Version/5.0.2 Mobile/8J2 Safari/6533.18.5" -k -F "k=$USER_KEY" -F "img=@$1" $SERVER
