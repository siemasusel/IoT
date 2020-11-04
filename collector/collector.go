package collector

import (
	"context"
	"time"

	influxdb2 "github.com/influxdata/influxdb-client-go/v2"
)

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
