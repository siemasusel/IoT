package collector

import (
	"context"
	log "github.com/sirupsen/logrus"
	"time"

	"github.com/influxdata/influxdb-client-go/v2/api"
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
	metrics    []Metric
	Tags       map[string]string
	writeAPI	api.WriteAPIBlocking
	interval	time.Duration
}

// Constructor
func MakeCollector(influxHost string, tags map[string]string, timeStr string) Collector {
	collector := Collector{}
	collector.connectDB(influxHost)
	collector.Tags = tags
	var err error
	collector.interval, err = time.ParseDuration(timeStr)
	if err != nil {
		log.WithFields(log.Fields{
			"error": err,
		}).Fatal("Can't parse time")
	}
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
	client := influxdb2.NewClient("http://"+host, "admin:admin342")
	c.writeAPI = client.WriteAPIBlocking("","metrics_test")
}

func (c *Collector) disconnectDB() {
}

func (c *Collector) sendToDB(points []Point) {
	for _, point := range points {
		p := influxdb2.NewPoint("measurements",
			mergeTags(point.Tags, c.Tags),
			point.Fields,
			time.Now())
		c.writeAPI.WritePoint(context.Background(), p)
	}
}

func mergeTags(ms ...map[string]string) map[string]string {
	res := map[string]string{}
	for _, m := range ms {
		for k, v := range m {
			res[k] = v
		}
	}
	return res
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
