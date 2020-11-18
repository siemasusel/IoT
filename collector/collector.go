package collector

import (
	"context"
	log "github.com/sirupsen/logrus"
	"time"

	influxdb2 "github.com/influxdata/influxdb-client-go/v2"
	"github.com/influxdata/influxdb-client-go/v2/api"
	"github.com/influxdata/influxdb-client-go/v2/api/write"
)

type Point struct {
	Fields map[string]interface{}
	Tags   map[string]string
}

func (p *Point) AddField(name string, value interface{}) {
	p.Fields[name] = value
}

// TODO:
// - sendToDB

type Collector struct {
	metrics      []Metric
	tags         map[string]string
	interval     time.Duration
	dbName       string
	influxClient influxdb2.Client
	writeAPI     api.WriteAPIBlocking
}

// Constructor
func MakeCollector(influxHost string, tags map[string]string, interval time.Duration, dbName string) Collector {
	collector := Collector{}
	collector.tags = tags
	collector.interval = interval
	collector.dbName = dbName
	collector.connectDB(influxHost)
	return collector
}

func (c *Collector) AddMetric(metric Metric) {
	c.metrics = append(c.metrics, metric)
}

func (c *Collector) getCurrentPoints() []Point {
	points := []Point{}
	for _, metric := range c.metrics {
		point := Point{Fields: map[string]interface{}{}}
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
	c.influxClient = influxdb2.NewClient("http://"+host, "admin:admin342")
	c.writeAPI = c.influxClient.WriteAPIBlocking("", c.dbName)
}

func (c *Collector) Stop() {
	c.influxClient.Close()
}

func (c *Collector) sendToDB(points []Point) {
	p := influxdb2.NewPointWithMeasurement("stat")
	addTags(p, c.tags)
	for _, point := range points {
		log.Info(point.Fields)
		addTags(p, point.Tags)
		addFields(p, point.Fields)
		err := c.writeAPI.WritePoint(context.Background(), p)
		if err != nil {
			log.WithFields(log.Fields{
				"err": err,
			}).Fatal("Can't send data")
		}
	}
}

func (c *Collector) runOnce() {
	c.sendToDB(c.getCurrentPoints())
}

func (c *Collector) RunLoop() {
	uptimeTicker := time.NewTicker(c.interval)
	defer uptimeTicker.Stop()
	for {
		select {
		case <-uptimeTicker.C:
			go c.runOnce()
		}
	}
}

func addTags(point *write.Point, tags map[string]string) {
	for key, value := range tags {
		point.AddTag(key, value)
	}
}

func addFields(point *write.Point, fields map[string]interface{}) {
	for key, value := range fields {
		point.AddField(key, value)
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
