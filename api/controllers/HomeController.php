<?php

namespace api\controllers;

use api\DB_Connection\DataBaseConn;

class HomeController {

    private array $request;
    public function __construct (array $request)
    {
        $this->request = $request;
        $this->data_conn = new DataBaseConn();
    }

    public function get_data () : array {
        $this->data_conn->connect();

        $book = $this->data_conn->select("book");
        $dvd = $this->data_conn->select("DVD");
        $furniture = $this->data_conn->select("furniture");

        $this->data_conn->close_conn();

        return $this->fill_data_type([
            [$book, "book"],
            [$dvd, "dvd"],
            [$furniture, "furniture"]
        ]);
    }

    private function fill_data_type (array $dataArray) : array {
        $filledData = [];
        foreach ($dataArray as $data){
            foreach ($data["0"] as $element) {
                $element["type"] = $data["1"];
                if($data["1"] === "furniture")
                    $element["dimension"] = $element["width"] . "x" . $element["length"] . "x" . $element["height"];

                $filledData[] = $element;
            }
        }
        return $filledData;
    }

}