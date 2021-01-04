package receiver

import (
	"fmt"
	"io/ioutil"
	"net/http"
	"os/exec"
	"strconv"
	"time"

	"github.com/gorilla/mux"
	log "github.com/sirupsen/logrus"
)

type Receiver struct {
	port string
}

func MakeReceiver(ip string, port int) Receiver {
	return Receiver{
		port: strconv.Itoa(port),
	}
}

func TemperatureHandler(w http.ResponseWriter, r *http.Request) {
	log.Info("Endpoint Hit: TemperatureHandler")

	switch r.Method {
	case "GET":
		log.Info("GET current Temperature")
	case "POST":
		// Call ParseForm() to parse the raw query and update r.PostForm and r.Form.
		if err := r.ParseForm(); err != nil {
			fmt.Fprintf(w, "ParseForm() err: %v", err)
			return
		}
		newTemperatureStr := r.FormValue("temp_value")
		log.Info("New temperature: " + newTemperatureStr)
		newTemperature, err := strconv.ParseFloat(newTemperatureStr, 64)
		checkFatal(err)
		currentTemperature, err := getCurrentTemperature()
		checkFatal(err)
		getTemperatureOutput(currentTemperature, newTemperature)

		fmt.Fprintf(w, "New temperature = %s\n", newTemperatureStr)
	default:
		fmt.Fprintf(w, "Sorry, only GET and POST methods are supported.")
	}
}

func getCurrentTemperature() (float64, error) {
	content, err := ioutil.ReadFile("/var/sensors/DHT22_temp.txt")
	if err != nil {
		log.Fatal(err)
	}
	return strconv.ParseFloat(string(content), 64)
}

func getTemperatureOutput(currentTemp float64, newTemp float64) {
	file := "/var/sensors/instructions.txt"
	if currentTemp < newTemp {
		log.Info("Heat")
		cmd := exec.Command("temp_high > " + file)
		b, err := cmd.CombinedOutput()
		if err != nil {
			log.Printf("Running command failed with error:  %v", err)
		}
		fmt.Printf("%s\n", string(b))
	} else if currentTemp > newTemp {
		log.Info("Cool")
		cmd := exec.Command("temp_low > " + file)
		b, err := cmd.CombinedOutput()
		if err != nil {
			log.Printf("Running command failed with error:  %v", err)
		}
		fmt.Printf("%s\n", string(b))
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
		// Call ParseForm() to parse the raw query and update r.PostForm and r.Form.
		if err := r.ParseForm(); err != nil {
			fmt.Fprintf(w, "ParseForm() err: %v", err)
			return
		}
		fmt.Fprintf(w, "Post from website! r.PostFrom = %v\n", r.PostForm)
		newHumidity := r.FormValue("humidity_value")
		log.Info("New humidity: " + newHumidity)
		fmt.Fprintf(w, "New humidity = %s\n", newHumidity)
	default:
		fmt.Fprintf(w, "Sorry, only GET and POST methods are supported.")
	}
}

func getCurrentHumidity() (float64, error) {
	content, err := ioutil.ReadFile("/var/sensors/DHT22_humidity.txt")
	if err != nil {
		log.Fatal(err)
	}
	return strconv.ParseFloat(string(content), 64)
}

func getHumidityOutput(currentHumidity float64, newHumidity float64) {
	if currentHumidity < newHumidity {
		log.Info("Too dry")
	} else if currentHumidity > newHumidity {
		log.Info("Too wet")
	} else {
		log.Info("Humidity OK")
	}
}

func FoodHandler(w http.ResponseWriter, r *http.Request) {
	log.Info("Endpoint Hit: FoodHandler")

	switch r.Method {
	case "GET":
		log.Info("Last feeding: ")
	case "POST":
		// Call ParseForm() to parse the raw query and update r.PostForm and r.Form.
		if err := r.ParseForm(); err != nil {
			fmt.Fprintf(w, "ParseForm() err: %v", err)
			return
		}
		fmt.Fprintf(w, "Post from website! r.PostFrom = %v\n", r.PostForm)
		newFeed := r.FormValue("feed_value")
		log.Info("Feed the animal: " + newFeed)
		fmt.Fprintf(w, "Feed the animal = %s\n", newFeed)
		file := "/var/sensors/instructions.txt"
		cmd := exec.Command("feed > " + file)
		b, err := cmd.CombinedOutput()
		if err != nil {
			log.Printf("Running command failed with error:  %v", err)
		}
		fmt.Printf("%s\n", string(b))
	default:
		fmt.Fprintf(w, "Sorry, only GET and POST methods are supported.")
	}
}

func (rec *Receiver) Run() {
	r := mux.NewRouter()
	r.HandleFunc("/temperature", TemperatureHandler)
	r.HandleFunc("/humidity", HumidityHandler)
	r.HandleFunc("/food", FoodHandler)
	cmd := exec.Command("python /var/instructions/instruction.py")
	b, err := cmd.CombinedOutput()
	if err != nil {
		log.Printf("Failed to run the script with error:  %v", err)
	}
	fmt.Printf("%s\n", string(b))
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

// func show(w http.ResponseWriter, r *http.Request) {
// 	if r.Method == "GET" {
// 		t, _ := template.ParseFiles("show.gtpl")
// 		t.Execute(w, nil)
// 	} else {
// 		r.ParseForm()
// 		fmt.Println(r.Form["task"])
// 	}
// }

func checkFatal(err error) {
	if err != nil {
		log.Fatal(err)
	}
}
