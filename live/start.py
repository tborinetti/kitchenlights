import cv2
from mjpeg_streamer import MjpegServer, Stream

cap = cv2.VideoCapture(0)

stream = Stream("camera", size=(640, 480), quality=10, fps=15)

server = MjpegServer("192.168.1.194", 8080)
server.add_stream(stream)
server.start()

def checkColours(img):
	img.convert('RGB')
	pixelArray = img.getpixel((300, 200))
	pixelSum = pixelArray[0] + pixelArray[1] + pixelArray[2]

	print(pixelSum)

while True:
	_, frame = cap.read()
	cv2.imshow(stream.name, frame)
	if cv2.waitKey(1) == ord("q"):
		break
	stream.set_frame(frame)
	checkColours(frame)



server.stop()
cap.release()
cv2.destroyAllWindows()
