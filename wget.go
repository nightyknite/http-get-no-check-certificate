package main

import (
	"crypto/tls"
	"flag"
	"fmt"
	"io"
	"net/http"
	"os"
	"path"
)

func main() {

	var filename, string
	flag.StringVar(&filename, "o", "", "output-document")
	flag.Parse()
	url := flag.Args()[0]
	if len(filename) == 0 {
		_, filename = path.Split(url)
	}

	transport := &http.Transport{
		TLSClientConfig: &tls.Config{InsecureSkipVerify: true},
	}

	client := &http.Client{
		Transport: transport,
	}

	response, err := client.Get(url)
	if err != nil {
		panic(err)
	}
	defer response.Body.Close()

	file, err := os.Create(filename)
	if err != nil {
		panic(err)
	}
	defer file.Close()

	n, err := io.Copy(file, response.Body)
	if err != nil {
		panic(err)
	}

	fmt.Println(n, "bytes downloaded.")

}
