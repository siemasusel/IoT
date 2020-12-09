package reciever

import (
	"fmt"
	"net/http"
	"strconv"
	"time"

	"github.com/gorilla/mux"
	log "github.com/sirupsen/logrus"
)

type Reciever struct {
	port string
}

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
	default:
		fmt.Fprintf(w, "Sorry, only GET and POST methods are supported.")
	}
}

func (rec *Reciever) Run() {
	r := mux.NewRouter()
	r.HandleFunc("/temperature", TemperatureHandler)
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
