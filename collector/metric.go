package collector

type Metric struct {
	Measurement string
	Tags        map[string]string
	Handler     func() (interface{}, error)
}

func MakeMetric(measurement string, handler func() (interface{}, error), tags map[string]string) Metric {
	return Metric{
		Measurement: measurement,
		Handler:     handler,
		Tags:        tags,
	}
}

func (m *Metric) GetCurrentData() (interface{}, error) {
	return m.Handler()
}
