import cv2
import json
from mjpeg_streamer import MjpegServer, Stream
import socket

# finds the current ip address
s = socket.socket(socket.AF_INET, socket.SOCK_DGRAM)
s.connect(("8.8.8.8", 80))
ipAddress = s.getsockname()[0]
s.close()

# stream setup
cap = cv2.VideoCapture(0)
stream = Stream("camera", size=(640, 480), quality=50, fps=15)
server = MjpegServer(ipAddress, 8080)
server.add_stream(stream)
server.start()

# Json setup
previousState = False
jsonFile = open("../info.json", "r+")

# average the middle pixels of image passed
def checkPixels(img):
	pixelArray = img[320][240]
	pixelSum = int(pixelArray[0]) + int(pixelArray[1]) + int(pixelArray[2])
	pixelSum = pixelSum / 3

	if pixelSum >= 70:
		return True
	else:
		return False


# always running
while True:
	# init stream
	_, frame = cap.read()
	if cv2.waitKey(1) == ord("q"):
		break
	stream.set_frame(frame)

	#checks pixels
	state = checkPixels(frame)
	print(state)
	if state == previousState:
		pass
	else:
		jsonData = {"lightsOn" : str(state)}
		jsonFile.seek(0)
		print(jsonFile.write(json.dumps(jsonData)))
		jsonFile.truncate()
		previousState = state


# safe cancel
server.stop()
cap.release()
cv2.destroyAllWindows()
