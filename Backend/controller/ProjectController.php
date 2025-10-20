<?php

namespace Backend\controller;

use PDOException;

class ProjectController extends BaseController
{
    private $pdo;
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function index()
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM projects");
            $stmt->execute();
            $projects = $stmt->fetchAll();
            $this->response($projects);
        } catch (PDOException $e) {
            die("ERROR: " . $e->getMessage());
        }
    }

    public function store($data)
    {
        try {
            $stmt = $this->pdo->prepare('INSERT INTO projects (name, description, tag, image) VALUES (:name, :description, :tag, :image)');
            $stmt->execute([
                'name' => $data['name'],
                'description' => $data['description'],
                'tag' => $data['tag'],
                'image' => $data['image']
            ]);
            $this->response(['message' => 'Project created successfully'], 201);
        } catch (PDOException $e) {
            die("ERROR: " . $e->getMessage());
        }
    }

    public function update($data, $id)
    {
        try {
            $stmt = $this->pdo->prepare('UPDATE projects SET name= :name, description= :description, tag= :tag, image= :image');
            $stmt->execute([
                'name' => $data['name'],
                'description' => $data['description'],
                'tag' => $data['tag'],
                'image' => $data['image'],
                'id' => $id,
            ]);
            $this->response(['message' => 'Project Updated Successfully']);
        } catch (PDOEXCEPTION $e) {
            die("ERROR: " . $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $stmt = $this->pdo->prepare('DELETE projects Where id= :id');
            $stmt->execute(['id' => $id]);
            $this->response(['message' => 'Project Deleted Successfully']);
        } catch (PDOException $e) {
            die("ERROR: " . $e->getMessage());
        }
    }
}