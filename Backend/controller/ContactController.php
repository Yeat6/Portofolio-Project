<?php

namespace Backend\Controller;

use PDOException;

class ContactController extends BaseController
{

    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function index()
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM contacts");
            $stmt->execute();
            $contacts = $stmt->fetchAll();
            $this->response($contacts);
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function store($data)
    {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO contacts (name, email, message) VALUES (:name, :email, :message)");
            $stmt->execute([
                'name' => $data['name'],
                'email' => $data['email'],
                'message' => $data['message'],
            ]);
            $this->response(['message' => 'Message Created Successfully'], 201);
        } catch (PDOException $e) {
            die("ERROR: " . $e->getMessage());
        }
    }

    public function update($data, $id)
    {
        try {
            $stmt = $this->pdo->prepare("UPDATE contacts SET name= :name, email= :email, message= :message");
            $stmt->execute([
                'name' => $data['name'],
                'email' => $data['email'],
                'message' => $data['message'],
                'id' => $id,
            ]);
            $this->response(['message' => 'Message Updated Successfully']);
        } catch (PDOException $e) {
            die("ERROR: " . $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $stmt = $this->pdo->prepare("DELETE contacts WHERE id= :id");
            $stmt->execute(['id' => $id]);
            $this->response(['message' => 'Message Deleted Successfuly']);
        } catch (PDOException $e) {
            die("ERROR: " . $e->getMessage());
        }
    }
}