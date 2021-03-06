package handlers

import (
	"io/ioutil"
	"log"
	"strings"

	"github.com/siemasusel/IoT/collector"
)

func FetchTemperature() (interface{}, error) {
	content, err := ioutil.ReadFile("/var/sensors/DHT22_temp.txt")
	if err != nil {
		log.Fatal(err)
	}
	return strings.TrimSuffix(string(content), "\n"), nil
}

func MakeTempertatureMetric() collector.Metric {
	return collector.MakeMetric("temperature", FetchTemperature, map[string]string{"unit": "cellsius"})
}
