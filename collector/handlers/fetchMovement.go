package handlers

import (
	"io/ioutil"
	"log"

	"github.com/siemasusel/IoT/collector"
)

func FetchMovement() (interface{}, error) {
	content, err := ioutil.ReadFile("/var/sensors/pir.txt")
	if err != nil {
		log.Fatal(err)
	}

	return string(content), nil
}

func MakeMovementMetric() collector.Metric {
	return collector.MakeMetric("movement", FetchMovement, map[string]string{"unit": "celsius"})
}
