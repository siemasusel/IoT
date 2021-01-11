package handlers

import (
	"io/ioutil"
	"log"
	"strings"

	"github.com/siemasusel/IoT/collector"
)

func FetchHumidity() (interface{}, error) {
	content, err := ioutil.ReadFile("/var/sensors/DHT22_humidity.txt")
	if err != nil {
		log.Fatal(err)
	}

	return strings.TrimSuffix(string(content), "\n"), nil
}

func MakeHumidityMetric() collector.Metric {
	return collector.MakeMetric("humidity", FetchHumidity, map[string]string{"unit": "percentage"})
}
