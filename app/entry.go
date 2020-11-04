package main

import (
	"fmt"

	"github.com/siemasusel/IoT/collector"
	"github.com/siemasusel/IoT/reciever"
)

func main() {
	reciever.Run()
	collector.Run()
	fmt.Println("Hello, world.")
}
