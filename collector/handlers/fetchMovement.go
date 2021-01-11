package handlers

import (
	"io/ioutil"
	"log"
	"strings"

	"github.com/siemasusel/IoT/collector"
)

func FetchMovement() (interface{}, error) {
	content, err := ioutil.ReadFile("/var/sensors/pir.txt")
	if err != nil {
		log.Fatal(err)
	}

	return strings.TrimSuffix(string(content), "\n"), nil
}

func MakeMovementMetric() collector.Metric {
	return collector.MakeMetric("movement", FetchMovement, map[string]string{"unit": "timestamp"})
}
