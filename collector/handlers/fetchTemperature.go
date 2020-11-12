package handlers

import (
	"github.com/siemasusel/IoT/collector"
)

func FetchTemperature() (interface{}, error) {
	return 10, nil
}

func MakeTempertatureMetric() collector.Metric {
	return collector.MakeMetric("temperature", FetchTemperature, map[string]string{"unit": "celsius"})
}
