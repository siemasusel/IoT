package handlers

import (
	"io/ioutil"
	"log"

	"github.com/siemasusel/IoT/collector"
)

func FetchReaction() (interface{}, error) {
	content, err := ioutil.ReadFile("/var/sensors/ph.txt")
	if err != nil {
		log.Fatal(err)
	}
	return string(content), nil
}

func MakeReactionMetric() collector.Metric {
	return collector.MakeMetric("reaction", FetchReaction, map[string]string{"unit": "pH"})
}
