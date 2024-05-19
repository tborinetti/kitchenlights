import cv2
from mjpeg_streamer import MjpegServer, Stream

cap = cv2.VideoCapture(0)

stream = Stream("camera", size=(640, 480), quality=50, fps=15)

server = MjpegServer("192.168.1.194", 8080)
server.add_stream(stream)
server.start()

def checkColours(img):
	dir(img)
	pixelArray = img[320][240]
	pixelSum = int(pixelArray[0]) + int(pixelArray[1]) + int(pixelArray[2])
	pixelSum = pixelSum / 3
#	print("sum: ", pixelSum)
#	print(pixelArray)
	return int(pixelSum)
	
while True:
	_, frame = cap.read()
	cv2.imshow(stream.name, frame)
	if cv2.waitKey(1) == ord("q"):
		break
	stream.set_frame(frame)
	if checkColours(frame)  >= 70:
		print("lights on")
	else:
		print("lights off")

	


server.stop()
cap.release()
cv2.destroyAllWindows()
