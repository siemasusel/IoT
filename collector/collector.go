package collector

import (
	"context"
	log "github.com/sirupsen/logrus"
	"time"

	influxdb2 "github.com/influxdata/influxdb-client-go/v2"
	"github.com/influxdata/influxdb-client-go/v2/api"
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
	Tags         map[string]string
	influxClient influxdb2.Client
	writeAPI     api.WriteAPIBlocking
	interval     time.Duration
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
	c.writeAPI = c.influxClient.WriteAPIBlocking("", "metrics_test")
}

func (c *Collector) disconnectDB() {
	c.influxClient.Close()
}

func (c *Collector) sendToDB(points []Point) {
	for _, point := range points {
		log.Info(point.Fields)
		p := influxdb2.NewPoint("stat",
			mergeTags(point.Tags, c.Tags),
			point.Fields,
			time.Now())
		c.writeAPI.WritePoint(context.Background(), p)
	}
}

func (c *Collector) RunLoop() {
	c.sendToDB(c.getCurrentPoints())
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
