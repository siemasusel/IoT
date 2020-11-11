package main

// ssh -Llocalhost:8086:10.72.1.106:8086 jtomasik@pluton.kt.agh.edu.pl
import (
	"github.com/siemasusel/IoT/collector"
	"github.com/siemasusel/IoT/collector/handlers"
)

func main() {
	app := collector.MakeCollector("localhost:8086", map[string]string{"device_id": "999"}, "60s")
	app.AddMetric(handlers.MakeTempertatureMetric())
	app.RunLoop()
}
