package reciever

import (
	"fmt"
	"net/http"
	"os/exec"
	"strconv"
	"time"

	"github.com/gorilla/mux"
	log "github.com/sirupsen/logrus"
)

type Reciever struct {
	port string
}

var file string = "instructions.txt"

func MakeReciever(ip string, port int) Reciever {
	return Reciever{
		port: strconv.Itoa(port),
	}
}

func TemperatureHandler(w http.ResponseWriter, r *http.Request) {
	log.Info("Endpoint Hit: TemperatureHandler")

	// if r.URL.Path != "/" {
	// 	http.Error(w, "404 not found.", http.StatusNotFound)
	// 	return
	// }

	switch r.Method {
	case "GET":
		log.Info("GET current Temperature")
	case "POST":
		// Call ParseForm() to parse the raw query and update r.PostForm and r.Form.
		if err := r.ParseForm(); err != nil {
			fmt.Fprintf(w, "ParseForm() err: %v", err)
			return
		}
		fmt.Fprintf(w, "Post from website! r.PostFrom = %v\n", r.PostForm)
		newTemperature := r.FormValue("temp_value")
		log.Info("New temperature: " + newTemperature)
		fmt.Fprintf(w, "New temperature = %s\n", newTemperature)
		// TempCheck
		cmd := exec.Command("tempUp > " + file)
		b, err := cmd.CombinedOutput()
		if err != nil {
			log.Printf("Running command failed with error:  %v", err)
		}
		fmt.Printf("%s\n", string(b))
	default:
		fmt.Fprintf(w, "Sorry, only GET and POST methods are supported.")
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

func (rec *Reciever) Run() {
	r := mux.NewRouter()
	r.HandleFunc("/temperature", TemperatureHandler)
	r.HandleFunc("/humidity", HumidityHandler)
	r.HandleFunc("/food", FoodHandler)
	cmd := exec.Command("python instruction.py")
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
