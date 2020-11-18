package handlers

import (
	"github.com/siemasusel/IoT/collector"
)

func FetchReaction() (interface{}, error) {
	return 10, nil
}

func MakeReactionMetric() collector.Metric {
	return collector.MakeMetric("reaction", FetchReaction, map[string]string{"unit": "pH"})
}
