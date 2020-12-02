package handlers

import (
	"io/ioutil"
	"log"

	"github.com/siemasusel/IoT/collector"
)

func FetchTemperature() (interface{}, error) {
	content, err := ioutil.ReadFile("/var/sensors/DHT_22.txt")
	if err != nil {
		log.Fatal(err)
	}
	return string(content), nil
}

func MakeTempertatureMetric() collector.Metric {
	return collector.MakeMetric("temperature", FetchTemperature, map[string]string{"unit": "cellsius"})
}
