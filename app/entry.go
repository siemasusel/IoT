package main

// ssh -Llocalhost:8086:10.72.1.106:8086 jtomasik@pluton.kt.agh.edu.pl
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
