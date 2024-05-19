#!/bin/bash
IP_ADDRESS=$(ifconfig | grep -Eo 'inet (addr:)?([0-9]*\.){3}[0-9]*' | grep -Eo '([0-9]*\.){3}[0-9]*' | grep -v '127.0.0.1')
echo $IP_ADDRESS
cvlc --no-audio v4l2:///dev/video0 --v4l2-chroma MJPG --sout "#standard{access=http,mux=mpjpeg,dst=${IP_ADDRESS}:8554}"
