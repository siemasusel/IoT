package collector

type Metric struct {
	Name    string
	Tags    map[string]string
	Handler func() (interface{}, error)
}

func MakeMetric(name string, handler func() (interface{}, error), tags map[string]string) Metric {
	return Metric{
		Name:    name,
		Handler: handler,
		Tags:    tags,
	}
}

func (m *Metric) GetCurrentData() (interface{}, error) {
	return m.Handler()
}
