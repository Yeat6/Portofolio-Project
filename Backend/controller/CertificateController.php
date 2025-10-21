<?php

namespace Backend\controller;

use PDOException;

class CertificateController extends BaseController
{

    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function index()
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM certificates");
            $stmt->execute();
            $certificates = $stmt->fetchAll();
            $this->response($certificates);
        } catch (PDOException $e) {
            die("ERROR:" . $e->getMessage());
        }
    }

    public function store($data)
    {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO certificates (title, description, issuer, issue_date, expiry_date, url, image)
            VALUES (:title, :decription, :issuer, :issue_date, :expiry_date, :url, :image)");
            $stmt->execute([
                'title' => $data['title'],
                'description' => $data['description'],
                'issuer' => $data['issuer'],
                'issue_date' => $data['issue_date'],
                'expiry_date' => $data['expiry_date'],
                'url' => $data['url'],
                'image' => $data['image'],
            ]);
            $this->response(['message' => "Certificate Created Successfully"], 201);
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function update($data, $id)
    {
        try {
            $stmt = $this->pdo->prepare("UPDATE certificates SET title= :title, description= :description, issuer= :issuer, issue_date= :issue_date,
            expiry_date= :expiry_date, url= :url, image= :image");
            $stmt->execute([
                'title' => $data['title'],
                'description' => $data['description'],
                'issuer' => $data['issuer'],
                'issue_date' => $data['issue_date'],
                'expiry_date' => $data['expiry_date'],
                'url' => $data['url'],
                'image' => $data['image'],
                'id' => $id,
            ]);
            $this->response(['message' => "Certificate Updated Successfully"]);
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $stmt = $this->pdo->prepare("DELETE certificates WHERE id= :id");
            $stmt->execute(['id' => $id]);
            $this->response(['message' => "Certificate Deleted Successfully"]);
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }
}