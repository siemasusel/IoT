package receiver

import (
	"fmt"
	"html/template"
	"net/http"
)

func Run() {
	fmt.Println("Hello, world from reciever.")
}

func show(w http.ResponseWriter, r *http.Request) {
	if r.Method == "GET" {
		t, _ := template.ParseFiles("show.gtpl")
		t.Execute(w, nil)
	} else {
		r.ParseForm()
		fmt.Println(r.Form["task"])
	}
}

func main() {
	http.HandleFunc("/show", show)
	http.ListenAndServe(":9000", nil)
}
