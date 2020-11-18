package handlers

import (
	"github.com/siemasusel/IoT/collector"
)

func FetchMovement() (interface{}, error) {
	return 10, nil
}

func MakeMovementMetric() collector.Metric {
	return collector.MakeMetric("movement", FetchMovement, map[string]string{"unit": "celsius"})
}
