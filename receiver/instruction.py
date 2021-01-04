f = open('instructins.txt','r')
instruction = f.readline()
if instruction == "tempUp":
    print("Temperature will be raised")
elif instruction == "tempDown":
    print("Temperature will be lowered")
elif instruction == "feed":
    print("Your animal will be fed")
else:
    print("No actions to be taken")
