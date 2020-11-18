#!/usr/bin/env python3

import RPi.GPIO as GPIO
import time
import datetime


def detect():
    while True:
        if GPIO.input(12) == True:
            print(str(datetime.datetime.now()) + "    Your animal moved.")
            file2 = open("textFile.txt", "a")
            file2.write(str(datetime.datetime.now()) + "    Your animal moved\n")
            file2.close()
        else:
            print(str(datetime.datetime.now()) + "    No movement.")
        time.sleep(1)


def motion_detect():
    GPIO.setwarnings(False)
    GPIO.setmode(GPIO.BOARD)
    GPIO.setup(12, GPIO.IN)
    motion = GPIO.input(12)
    GPIO.cleanup()
    return motion

if __name__ == "__main__":
    
    #!today = datetime.today()
    
    GPIO.setwarnings(False)
    GPIO.setmode(GPIO.BOARD)
    GPIO.setup(12, GPIO.IN)
    file = open("textFile.txt", "w")
    file.write("Hello!\n\n")
    detect()
    GPIO.cleanup()