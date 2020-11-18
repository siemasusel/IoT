package main

// ssh -Llocalhost:8086:10.72.1.106:8086 jtomasik@pluton.kt.agh.edu.pl
import (
	"flag"
	"strconv"
	"time"

	"github.com/siemasusel/IoT/collector"
	"github.com/siemasusel/IoT/collector/handlers"
	log "github.com/sirupsen/logrus"
)

var (
	intervalStr string
	dbName      string
	deviceId    int
)

func parseInterval(intervalStr string) time.Duration {
	interval_duration, err := time.ParseDuration(intervalStr)
	if err != nil {
		log.WithFields(log.Fields{
			"error": err,
		}).Fatal("Can't parse time")
	}
	return interval_duration
}

func parseTags(device_id int) map[string]string {
	return map[string]string{
		"device_id": strconv.Itoa(device_id),
	}
}

func init() {
	flag.StringVar(&intervalStr, "interval", "1m", "how often to collect metrics (eg. '30s', '5m20s', '1h10m15s')")
	flag.StringVar(&dbName, "db_name", "metrics_test", "InfluxDB Database name")
	flag.IntVar(&deviceId, "device_id", 999, "device ID")
	flag.Parse()
}

func main() {
	interval := parseInterval(intervalStr)
	tags := parseTags(deviceId)
	app := collector.MakeCollector("localhost:8086", tags, interval, dbName)
	defer app.Stop()
	app.AddMetric(handlers.MakeTempertatureMetric())
	app.AddMetric(handlers.MakeReactionMetric())
	app.AddMetric(handlers.MakeMovementMetric())
	app.RunLoop()
}
