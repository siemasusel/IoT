#!/usr/bin/env python3

import RPi.GPIO as GPIO
import time
import datetime


def detect():
    while True:
        if GPIO.input(18) == True:
            print(str(time.time()) + "    Movement detected.")
            file2 = open("pir.txt", "w")
            file2.write(str(time.time()))
            file2.close()
        else:
            print(str(datetime.datetime.now()) + "    No movement.")
        time.sleep(1)


def motion_detect():
    GPIO.setwarnings(False)
    GPIO.setmode(GPIO.BOARD)
    GPIO.setup(18, GPIO.IN)
    motion = GPIO.input(18)
    GPIO.cleanup()
    return motion

if __name__ == "__main__":
    
    GPIO.setwarnings(False)
    GPIO.setmode(GPIO.BOARD)
    GPIO.setup(18, GPIO.IN)
    file = open("pir.txt", "w")
    detect()
    GPIO.cleanup()
