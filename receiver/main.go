package receiver

import (
	"encoding/json"
	"fmt"
	"io/ioutil"
	"net/http"
	"strconv"
	"strings"
	"time"

	"github.com/gorilla/mux"
	log "github.com/sirupsen/logrus"
)

type Receiver struct {
	port string
}

type TempValue struct {
	Value string `json:"tempValue"`
}

type HumidityValue struct {
	Value string `json:"humidityValue"`
}

type FeedValue struct {
	Value string `json:"feedValue"`
}

func MakeReceiver(ip string, port int) Receiver {
	return Receiver{
		port: strconv.Itoa(port),
	}
}

func printToFile(fileName string, text string) {
	err := ioutil.WriteFile(fileName, []byte(text), 0666)
	if err != nil {
		log.Fatal(err)
	}
}

func TemperatureHandler(w http.ResponseWriter, r *http.Request) {
	log.Info("Endpoint Hit: TemperatureHandler")
	switch r.Method {
	case "GET":
		log.Info("GET current Temperature")
	case "POST":
		var temperature TempValue

		// Try to decode the request body into the struct. If there is an error,
		// respond to the client with the error message and a 400 status code.
		err := json.NewDecoder(r.Body).Decode(&temperature)
		if err != nil {
			log.Fatal("TemperatureHandler" + err.Error())
			http.Error(w, err.Error(), http.StatusBadRequest)
			return
		}
		log.Info("New temperature: " + temperature.Value)
		newTemperature, err := strconv.ParseFloat(temperature.Value, 64)
		checkFatal(err)
		currentTemperature, err := getCurrentTemperature()
		checkFatal(err)
		getTemperatureOutput(currentTemperature, newTemperature)

		// fmt.Fprintf(w, "New temperature = %s\n", temperature.Value)
	default:
		log.Info("Sorry, only GET and POST methods are supported.")
		fmt.Fprintf(w, "Sorry, only GET and POST methods are supported.")
	}
}

func getCurrentTemperature() (float64, error) {
	content, err := ioutil.ReadFile("/var/sensors/DHT22_temp.txt")
	if err != nil {
		log.Fatal(err)
	}
	return strconv.ParseFloat(strings.TrimSuffix(string(content), "\n"), 64)
}

func getTemperatureOutput(currentTemp float64, newTemp float64) {
	file := "/var/sensors/temp.txt"
	if currentTemp < newTemp {
		log.Info("Heat")
		printToFile(file, "temp_high")
	} else if currentTemp > newTemp {
		log.Info("Cool")
		printToFile(file, "temp_low")
	} else {
		log.Info("temperature OK")
	}
}

func HumidityHandler(w http.ResponseWriter, r *http.Request) {
	log.Info("Endpoint Hit: HumidityHandler")

	switch r.Method {
	case "GET":
		log.Info("GET current Humidity")
	case "POST":
		var humidity HumidityValue

		// Try to decode the request body into the struct. If there is an error,
		// respond to the client with the error message and a 400 status code.
		err := json.NewDecoder(r.Body).Decode(&humidity)
		if err != nil {
			log.Fatal("HumidityHandler" + err.Error())
			http.Error(w, err.Error(), http.StatusBadRequest)
			return
		}
		log.Info("New humidity: " + humidity.Value)
		newHumidity, err := strconv.ParseFloat(humidity.Value, 64)
		checkFatal(err)
		currentHumidity, err := getCurrentHumidity()
		checkFatal(err)
		getHumidityOutput(currentHumidity, newHumidity)
	default:
		log.Info("Sorry, only GET and POST methods are supported.")
		fmt.Fprintf(w, "Sorry, only GET and POST methods are supported.")
	}
}

func getCurrentHumidity() (float64, error) {
	content, err := ioutil.ReadFile("/var/sensors/DHT22_humidity.txt")
	if err != nil {
		log.Fatal(err)
	}
	return strconv.ParseFloat(strings.TrimSuffix(string(content), "\n"), 64)
}

func getHumidityOutput(currentHumidity float64, newHumidity float64) {
	file := "/var/sensors/humidity.txt"
	if currentHumidity < newHumidity {
		log.Info("high")
		printToFile(file, "hum_high")
	} else if currentHumidity > newHumidity {
		log.Info("low")
		printToFile(file, "hum_low")
	} else {
		log.Info("temperature OK")
	}
}

func FoodHandler(w http.ResponseWriter, r *http.Request) {
	log.Info("Endpoint Hit: FoodHandler")

	switch r.Method {
	case "GET":
		log.Info("Last feeding: ")
	case "POST":
		var feed FeedValue

		// Try to decode the request body into the struct. If there is an error,
		// respond to the client with the error message and a 400 status code.
		log.Info(r.Body)
		err := json.NewDecoder(r.Body).Decode(&feed)
		if err != nil {
			http.Error(w, err.Error(), http.StatusBadRequest)
			return
		}
		// fmt.Fprintf(w, "Post from website! JSON feed = %v\n", feed.Value)

		newFeed := feed.Value
		log.Info("Feed the animal: " + newFeed)
		// fmt.Fprintf(w, "Feed the animal = %s\n", newFeed)
		file := "/var/sensors/instructions.txt"
		printToFile(file, "feed")
	default:
		log.Info("Sorry, only GET and POST methods are supported.")
		fmt.Fprintf(w, "Sorry, only GET and POST methods are supported.")
	}
}

func (rec *Receiver) Run() {
	r := mux.NewRouter()
	r.HandleFunc("/temperature", TemperatureHandler)
	r.HandleFunc("/humidity", HumidityHandler)
	r.HandleFunc("/food", FoodHandler)
	// http.Handle("/", r)
	log.Info("Starting server for HTTP POST on port " + rec.port + "...")

	srv := &http.Server{
		Handler: r,
		Addr:    "0.0.0.0:" + rec.port,
		// Good practice: enforce timeouts for servers you create!
		WriteTimeout: 15 * time.Second,
		ReadTimeout:  15 * time.Second,
	}
	log.Fatal(srv.ListenAndServe())
}

func checkFatal(err error) {
	if err != nil {
		log.Fatal(err)
	}
}
