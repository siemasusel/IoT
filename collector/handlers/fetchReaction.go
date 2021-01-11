package handlers

import (
	"io/ioutil"
	"log"
	"strings"

	"github.com/siemasusel/IoT/collector"
)

func FetchReaction() (interface{}, error) {
	content, err := ioutil.ReadFile("/var/sensors/ph.txt")
	if err != nil {
		log.Fatal(err)
	}
	return strings.TrimSuffix(string(content), "\n"), nil
}

func MakeReactionMetric() collector.Metric {
	return collector.MakeMetric("reaction", FetchReaction, map[string]string{"unit": "pH"})
}
