package collector

import (
	"context"
	log "github.com/sirupsen/logrus"
	"time"

	influxdb2 "github.com/influxdata/influxdb-client-go/v2"
)

type Point struct {
	Fields map[string]interface{}
	Tags   map[string]string
}

func (p *Point) AddField(name string, value interface{}) {
	p.Fields[name] = value
}

// TODO:
// - collector constructor (tags, )
// - connectToDB
// - sendToDB

type Collector struct {
	influxHost string
	metrics    []Metric
	tags       map[string]string
	// writeAPI 	InfluxWriteApi
}

// Contructor
func MakeCollector(influxHost string) Collector {
	collector := Collector{}
	collector.connectDB(influxHost)

	return collector
}

func (c *Collector) AddMetric(metric Metric) {
	c.metrics = append(c.metrics, metric)
}

func (c *Collector) getCurrentPoints() []Point {
	points := []Point{}
	for _, metric := range c.metrics {
		point := Point{}
		value, err := metric.GetCurrentData()
		if err != nil {
			log.WithFields(log.Fields{
				"name": metric.Name,
			}).Warn("Can't get field")
			continue
		}
		point.AddField(metric.Name, value)
		point.Tags = metric.Tags
		points = append(points, point)
	}
	return points
}

func (c *Collector) connectDB(host string) {

}

func (c *Collector) disconnectDB() {

}

func (c *Collector) sendToDB() {

}

func call() {
	// Create a new client using an InfluxDB server base URL and an authentication token
	client := influxdb2.NewClient("http://localhost:8086", "admin:admin342")
	// Use blocking write client for writes to desired bucket
	writeAPI := client.WriteAPIBlocking("", "metrics_test")
	// Create point using full params constructor
	p := influxdb2.NewPoint("stat",
		map[string]string{"unit": "temperature"},
		map[string]interface{}{"avg": 24.5, "max": 45.0},
		time.Now())
	// write point immediately
	writeAPI.WritePoint(context.Background(), p)
	// // Create point using fluent style
	// p = influxdb2.NewPointWithMeasurement("stat").
	// 	AddTag("unit", "temperature").
	// 	AddField("avg", 23.2).
	// 	AddField("max", 45.0).
	// 	SetTime(time.Now())
	// writeAPI.WritePoint(context.Background(), p)

	// Ensures background processes finishes
	client.Close()
}
