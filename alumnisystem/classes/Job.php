<?php
class Job {
    private $conn;
    private $table_name = "jobs";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function createJob($jobData) {
        // Implementation for creating a job post
            // Check if required fields are set
            if (!isset($jobData['job_title'], $jobData['job_description'], $jobData['company_name'])) {
                throw new Exception("All fields are required.");
            }
    
            // Sanitize input data
            $jobTitle = htmlspecialchars(strip_tags($jobData['job_title']));
            $jobDescription = htmlspecialchars(strip_tags($jobData['job_description']));
            $companyName = htmlspecialchars(strip_tags($jobData['company_name']));
    
            // Insert into database
            $query = "INSERT INTO " . $this->table_name . " (job_title, job_description, company_name) VALUES (:job_title, :job_description, :company_name)";
            $stmt = $this->conn->prepare($query);
    
            // Bind values
            $stmt->bindParam(":job_title", $jobTitle);
            $stmt->bindParam(":job_description", $jobDescription);
            $stmt->bindParam(":company_name", $companyName);
    
            if ($stmt->execute()) {
                return true;
            } else {
                throw new Exception("Unable to create job post.");
            }
    }

    public function getJobs() {
        // Implementation for retrieving all job posts
        $query = "SELECT job_title, job_description, company_name FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteJob($jobId) {
        // Implementation for deleting a job post
    }
}
?>